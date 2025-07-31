@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
        <div class="card-body p-md-5">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h2 class="card-title text-primary fw-bold mb-2">{{ $laporan->judul }}</h2>
                    <p class="card-text text-muted mb-0">Status:
                        <span class="badge {{ $laporan->status == 'selesai' ? 'bg-success' : ($laporan->status == 'proses' ? 'bg-warning text-dark' : 'bg-info') }} rounded-pill px-3 py-2 text-uppercase fw-normal">
                            {{ $laporan->status }}
                        </span>
                    </p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <p class="text-muted mb-0">Dilaporkan pada: <span class="realtime-time" data-timestamp="{{ $laporan->created_at->toISOString() }}">{{ $laporan->created_at->format('d M Y, H:i') }}</span></p>
                </div>
            </div>

            <hr class="my-4">

            <h4 class="text-secondary mb-3">Deskripsi Laporan</h4>
            <p class="card-text text-dark-emphasis mb-4 lead">{{ $laporan->deskripsi }}</p>

            @if($laporan->foto)
                <div class="mb-4 text-center">
                    <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Laporan" class="img-fluid rounded shadow-sm" style="max-height: 400px; object-fit: cover;">
                </div>
            @endif

            <h4 class="text-secondary mb-3">Lokasi Kejadian</h4>
            <div id="map" class="rounded shadow-sm mb-5" style="height: 350px; width: 100%;"></div>

            <h4 class="text-secondary mb-3">Tanggapan Resmi</h4>
            @forelse($laporan->tanggapans as $tanggapan)
                <div class="card mb-3 shadow-sm border-0 bg-light">
                    <div class="card-body">
                        <p class="card-text"><strong>{{ $tanggapan->admin->name }}:</strong> {{ $tanggapan->isi_tanggapan }}</p>
                        <small class="text-muted float-end realtime-time" data-timestamp="{{ $tanggapan->created_at->toISOString() }}">{{ $tanggapan->created_at->format('d M Y, H:i') }}</small>
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center" role="alert">
                    Belum ada tanggapan untuk laporan ini.
                </div>
            @endforelse

            @if(Auth::check() && Auth::id() === $laporan->user_id)
                <hr class="my-4">
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('laporan.edit', $laporan) }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Edit Laporan</a>
                    <form action="{{ route('laporan.destroy', $laporan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Hapus Laporan</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script type="module">
    import dayjs from 'https://cdn.skypack.dev/dayjs';
    import relativeTime from 'https://cdn.skypack.dev/dayjs/plugin/relativeTime';
    import 'https://cdn.skypack.dev/dayjs/locale/id';

    dayjs.extend(relativeTime);
    dayjs.locale('id');

    function updateTimes() {
        document.querySelectorAll('.realtime-time').forEach(el => {
            const timestamp = el.dataset.timestamp;
            el.textContent = dayjs(timestamp).fromNow();
        });
    }

    setInterval(updateTimes, 5000); // Update every 5 seconds
    updateTimes(); // Initial update
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var latitude = {{ $laporan->latitude }};
        var longitude = {{ $laporan->longitude }};

        // Initialize the map only if the map element exists
        var mapElement = document.getElementById('map');
        if (mapElement) {
            var map = L.map('map').setView([latitude, longitude], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Lokasi Laporan')
                .openPopup();

            // Invalidate map size on window resize to ensure responsiveness
            window.addEventListener('resize', function() {
                map.invalidateSize();
            });
        }
    });
</script>

<style>
    /* Custom styles for a cleaner look */
    body {
        background-color: #f0f2f5; /* Light gray background */
    }
    .card.shadow-lg {
        border-radius: 1rem; /* More rounded corners */
    }
    .card-title.fw-bold {
        font-size: 2.25rem; /* Larger title */
    }
    .card-text.lead {
        font-size: 1.15rem; /* Slightly larger description text */
        line-height: 1.7; /* Better readability */
    }
    .badge {
        font-weight: 600; /* Bolder badge text */
    }
    .badge.bg-success {
        background-color: #28a745 !important;
    }
    .badge.bg-warning {
        background-color: #ffc107 !important;
        color: #343a40 !important; /* Darker text for warning badge */
    }
    .badge.bg-info {
        background-color: #17a2b8 !important;
    }
    .img-fluid.rounded.shadow-sm {
        transition: transform 0.3s ease-in-out;
    }
    .img-fluid.rounded.shadow-sm:hover {
        transform: scale(1.02); /* Slight zoom on hover */
    }
    #map {
        transition: all 0.3s ease-in-out;
    }
    #map:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important; /* Add shadow on hover */
    }
    .alert-info {
        background-color: #e2f3f9;
        border-color: #bee5eb;
        color: #0c5460;
    }
</style>
@endsection