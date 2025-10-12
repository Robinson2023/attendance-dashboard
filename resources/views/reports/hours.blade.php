@extends('layouts.app')

@section('content')
    
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reporte de Horas por Proyecto
        </h2>
   

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @foreach($data as $project)
                <div class="bg-white shadow-md rounded p-6 mb-6">
                    <h3 class="text-lg font-bold mb-4">{{ $project['name'] }}</h3>

                    <table class="min-w-full border border-gray-200 mb-4">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">Empleado</th>
                                <th class="px-4 py-2 border">Horas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($project['employees'] as $employee)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $employee['name'] }}</td>
                                    <td class="px-4 py-2 border">{{ $employee['hours'] }}</td>
                                </tr>
                            @endforeach
                            <tr class="bg-gray-50 font-bold">
                                <td class="px-4 py-2 border">TOTAL</td>
                                <td class="px-4 py-2 border">{{ $project['total'] }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Contenedor para la gráfica -->
                    <canvas id="chart-{{ $loop->index }}" height="100"></canvas>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Librería de Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        @foreach($data as $project)
            new Chart(document.getElementById("chart-{{ $loop->index }}"), {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_column($project['employees'], 'name')) !!},
                    datasets: [{
                        label: 'Horas trabajadas',
                        data: {!! json_encode(array_column($project['employees'], 'hours')) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    }]
                }
            });
        @endforeach
    </script>
@endsection
