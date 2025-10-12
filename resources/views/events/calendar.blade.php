@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-indigo-700">📅 Calendario de Eventos</h1>

    <!-- Contenedor del calendario -->
    <div id="calendar" class="bg-white rounded-lg shadow-md p-4" style="min-height: 600px;"></div>
</div>

@php
    // Preparar los datos en PHP
    $calendarEvents = $events->map(function ($e) {
        return [
            'title' => $e->title,
            'start' => $e->event_date,
            'description' => $e->description,
            'color' => match($e->category ?? 'general') {
                'visita' => '#4CAF50',
                'entrega' => '#2196F3',
                'cronograma' => '#FF9800',
                default => '#9C27B0',
            },
        ];
    });
@endphp
@endsection


@push('scripts')
<!-- FullCalendar -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    // Validar si existe el contenedor
    if (!calendarEl) {
        console.error("❌ No se encontró el div con id='calendar'");
        return;
    }

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        height: 700,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        events: @json($calendarEvents),
        eventClick: function(info) {
            const event = info.event;
            Swal.fire({
                title: `📌 ${event.title}`,
                html: `
                    <p><strong>📅 Fecha:</strong> ${event.start.toLocaleDateString()}</p>
                    <p><strong>📝 Descripción:</strong> ${event.extendedProps.description ?? 'Sin descripción'}</p>
                `,
                icon: 'info',
                confirmButtonText: 'Cerrar'
            });
        }
    });

    calendar.render();
});
</script>
@endpush
