@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Mapa de Asistencia - Hoy</h1>
    <div id="map" style="height: 500px;" class="rounded shadow"></div>
</div>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Inicializar mapa centrado en Colombia
    var map = L.map('map').setView([4.6, -74.1], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Datos pasados desde Laravel a JS
    const attendances = @json($attendances);

    attendances.forEach(a => {
        if(a.latitud && a.longitud){
            const popup = `<strong>${a.user.name}</strong><br>
                           ${a.type.toUpperCase()}<br>
                           ${a.hora}`;
            L.marker([a.latitud, a.longitud])
             .addTo(map)
             .bindPopup(popup);
        }
    });
});
</script>
@endsection
