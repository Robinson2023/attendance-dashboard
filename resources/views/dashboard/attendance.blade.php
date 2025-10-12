@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-4">
    Asistencias del {{ \Carbon\Carbon::parse($desde)->format('d/m/Y') }} 
    al {{ \Carbon\Carbon::parse($hasta)->format('d/m/Y') }}
</h2>

<!-- Filtros -->
<form method="GET" action="{{ route('attendance.index') }}" class="mb-6 flex gap-4 items-end flex-wrap">
    <!-- Filtro empleado -->
    <div>
        <label for="employee" class="block text-sm font-medium text-gray-700">Empleado</label>
        <select name="employee" id="employee" class="border rounded px-2 py-1">
            <option value="">Todos</option>
            @foreach($employees as $emp)
                <option value="{{ $emp->id }}" {{ request('employee')==$emp->id?'selected':'' }}>
                    {{ $emp->first_name }} {{ $emp->last_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Filtro rango de fechas -->
    <div>
        <label for="desde" class="block text-sm font-medium text-gray-700">Desde</label>
        <input type="date" name="desde" value="{{ $desde }}" class="border rounded px-2 py-1">
    </div>
    <div>
        <label for="hasta" class="block text-sm font-medium text-gray-700">Hasta</label>
        <input type="date" name="hasta" value="{{ $hasta }}" class="border rounded px-2 py-1">
    </div>

    <!-- Filtro permiso descontable -->
    <div>
        <label for="permission" class="block text-sm font-medium text-gray-700">Permiso descontable</label>
        <select name="permission" id="permission" class="border rounded px-2 py-1">
            <option value="">Todos</option>
            <option value="1" {{ request('permission')=='1'?'selected':'' }}>Sí</option>
            <option value="0" {{ request('permission')=='0'?'selected':'' }}>No</option>
        </select>
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">Aplicar filtros</button>
    </div>
</form>

<!-- Gráfico -->
<canvas id="attendanceChart" width="800" height="400" class="mb-6"></canvas>

<!-- Tabla de asistencias -->
<table class="min-w-full border">
    <thead class="bg-gray-200">
        <tr>
            <th>Fecha</th>
            <th>Empleado</th>
            <th>Estado</th>
            <th>Hora Entrada</th>
            <th>Hora Salida</th>
            <th>Horas Trabajadas</th>
            <th>Horas Extras</th>
            <th>Deducción</th>
            <th>Pago Día</th>
            <th>Permiso Descontable</th>
        </tr>
    </thead>

    <tbody>
        @php $totals = []; @endphp
        @forelse($register as $r)
            @php
                $emp = $r['employee'];
                if(!isset($totals[$emp])) $totals[$emp] = ['worked_hours'=>0,'extra_hours'=>0,'deduction'=>0,'payment'=>0];
                $totals[$emp]['worked_hours'] += $r['worked_hours'];
                $totals[$emp]['extra_hours']  += $r['extra_hours'];
                $totals[$emp]['deduction']    += $r['deduction'];
                $totals[$emp]['payment']      += $r['payment'];
            @endphp
            <tr>
                <td>{{ \Carbon\Carbon::parse($r['fecha'])->format('d/m/Y') }}</td>
                <td>{{ $r['employee'] }}</td>
                <td>
                    @if($r['status']=='on_time') 🟢 A tiempo
                    @elseif($r['status']=='late') 🟡 Tarde
                    @else 🔴 Ausente
                    @endif
                </td>
                <td>{{ $r['hora'] ?? '-' }}</td>
                <td>{{ $r['hora_salida'] ?? '-' }}</td>
                <td>{{ $r['worked_hours'] }}</td>
                <td>{{ $r['extra_hours'] }}</td>
                <td>{{ number_format($r['deduction'],2) }}</td>
                <td>{{ number_format($r['payment'],2) }}</td>
                <td>
                    <input type="checkbox" class="permission-checkbox" data-id="{{ $r['id'] ?? '' }}"
                        {{ $r['permission_descontable'] ? 'checked':'' }}>
                </td>
            </tr>
        @empty
            <tr><td colspan="10" class="text-center py-2">No hay registros.</td></tr>
        @endforelse
    </tbody>

    <tfoot>
        @foreach($totals as $emp => $sum)
            <tr class="font-bold text-center bg-gray-100">
                <td colspan="5">Totales {{ $emp }}</td>
                <td>{{ $sum['worked_hours'] }}</td>
                <td>{{ $sum['extra_hours'] }}</td>
                <td>{{ number_format($sum['deduction'],2) }}</td>
                <td>{{ number_format($sum['payment'],2) }}</td>
                <td>-</td>
            </tr>
        @endforeach
    </tfoot>
</table>

<!-- Chart.js -->
<script>
const allRecords = @json($register);
const fechas = [...new Set(allRecords.map(r=>r.fecha))].sort();
const employees = [...new Set(allRecords.map(r=>r.employee))];

const datasets = employees.map(emp=>{
    const data = fechas.map(f=>{
        const rec = allRecords.find(r=>r.employee===emp && r.fecha===f);
        if(!rec) return 0;
        if(rec.permission_descontable) return -1; // día con permiso descontable
        return rec.status==='on_time'?2:(rec.status==='late'?1:0);
    });
    return {
        label:emp,
        data:data,
        fill:false,
        borderColor:'#'+Math.floor(Math.random()*16777215).toString(16),
        tension:0.1
    };
});

new Chart(document.getElementById('attendanceChart'),{
    type:'line',
    data:{labels:fechas.map(f=>new Date(f).toLocaleDateString()),datasets:datasets},
    options:{
        responsive:true,
        plugins:{
            title:{
                display:true,
                text:'Asistencia diaria por empleado (2=A tiempo,1=Tarde,0=Ausente,-1=Permiso)'
            },
            legend:{position:'top'}
        },
        scales:{
            y:{
                beginAtZero:true,
                ticks:{
                    stepSize:1,
                    callback:value=>{
                        if(value===2) return 'A tiempo';
                        if(value===1) return 'Tarde';
                        if(value===0) return 'Ausente';
                        if(value===-1) return 'Permiso';
                    }
                }
            }
        }
    }
});

// AJAX permisos
document.querySelectorAll('.permission-checkbox').forEach(cb=>{
    cb.addEventListener('change',function(){
        fetch('/attendances/permission/'+this.dataset.id,{
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            body:JSON.stringify({descontable:this.checked?1:0})
        }).then(res=>res.json()).then(data=>{
            if(data.success) Swal.fire({
                icon:'success',
                title:'Actualizado',
                text:data.message,
                timer:1500,
                showConfirmButton:false
            });
        });
    });
});
</script>

@endsection
