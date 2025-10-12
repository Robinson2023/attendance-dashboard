@extends('layouts.app')

@section('content')
        <h2 class="text-xl font-bold">📊 Reportes de Horas</h2>
    

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Gráfico: Horas por empleado -->
        <div class="bg-white p-4 shadow rounded">
            <h3 class="text-lg font-semibold mb-2">Horas por Empleado</h3>
            <canvas id="chartEmployees"></canvas>
        </div>

        <!-- Gráfico: Horas por proyecto -->
        <div class="bg-white p-4 shadow rounded">
            <h3 class="text-lg font-semibold mb-2">Horas por Proyecto</h3>
            <canvas id="chartProjects"></canvas>
        </div>

        <!-- Gráfico: Horas por fecha -->
        <div class="bg-white p-4 shadow rounded col-span-1 md:col-span-2">
            <h3 class="text-lg font-semibold mb-2">Horas por Fecha</h3>
            <canvas id="chartDates"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Horas por empleado
        new Chart(document.getElementById('chartEmployees'), {
            type: 'bar',
            data: {
                labels: @json($labelsEmployees),
                datasets: [{
                    label: 'Horas',
                    data: @json($dataEmployees),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            }
        });

        // Horas por proyecto
        new Chart(document.getElementById('chartProjects'), {
            type: 'bar',
            data: {
                labels: @json($labelsProjects),
                datasets: [{
                    label: 'Horas',
                    data: @json($dataProjects),
                    backgroundColor: 'rgba(255, 159, 64, 0.6)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            }
        });

        // Horas por fecha
        new Chart(document.getElementById('chartDates'), {
            type: 'line',
            data: {
                labels: @json($labelsDates),
                datasets: [{
                    label: 'Horas',
                    data: @json($dataDates),
                    fill: true,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.3
                }]
            }
        });
    </script>
@endsection
