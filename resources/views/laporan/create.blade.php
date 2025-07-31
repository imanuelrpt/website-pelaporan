@extends('layouts.app')

@section('content')
<div class="report-container">
    <div class="report-header">
        <div class="header-content">
            <h1><i class="bi bi-megaphone"></i> Buat Laporan Baru</h1>
            <p class="subtitle">Bantu kami menjaga lingkungan dengan melaporkan masalah yang Anda temui</p>
        </div>
        <div class="header-icon">
            <i class="bi bi-pin-map"></i>
        </div>
    </div>

    <div class="report-card">
        <form method="POST" action="{{ route('laporan.store') }}" enctype="multipart/form-data" class="report-form">
            @csrf
            
            <div class="form-map-container">
                <!-- Left Column - Form -->
                <div class="form-column">
                    <!-- Judul Laporan -->
                    <div class="form-section">
                        <div class="section-header">
                            <i class="bi bi-card-heading"></i>
                            <h3>Judul Laporan</h3>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" name="judul" class="form-control" id="judulInput" placeholder=" " required>
                            <label for="judulInput">Masukkan judul laporan Anda</label>
                            <div class="form-icon">
                                <i class="bi bi-pencil-square"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-section">
                        <div class="section-header">
                            <i class="bi bi-text-paragraph"></i>
                            <h3>Deskripsi Lengkap</h3>
                        </div>
                        <div class="form-floating mb-4">
                            <textarea name="deskripsi" class="form-control" id="deskripsiInput" placeholder=" " style="height: 120px" required></textarea>
                            <label for="deskripsiInput">Jelaskan masalah secara detail</label>
                            <div class="form-icon">
                                <i class="bi bi-text-left"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Foto -->
                    <div class="form-section">
                        <div class="section-header">
                            <i class="bi bi-camera"></i>
                            <h3>Foto Pendukung</h3>
                        </div>
                        <div class="file-upload-wrapper mb-4">
                            <label for="fotoUpload" class="upload-area">
                                <div class="upload-content">
                                    <i class="bi bi-cloud-arrow-up"></i>
                                    <p>Seret & lepas foto atau <span>klik untuk memilih</span></p>
                                    <small>Format: JPG, PNG (Maks. 5MB)</small>
                                </div>
                                <input type="file" name="foto" id="fotoUpload" accept="image/*">
                            </label>
                            <div class="image-preview" id="imagePreview">
                                <img src="" alt="Preview" class="preview-image" id="previewImage">
                                <button type="button" class="btn-remove-image" id="removeImage">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Map -->
                <div class="map-column">
                    <div class="form-section">
                        <div class="section-header">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Lokasi Kejadian</h3>
                        </div>
                        <div class="map-instructions mb-2">
                            <i class="bi bi-info-circle"></i>
                            <p>Klik pada peta atau geser pin untuk memilih lokasi</p>
                        </div>
                        <div id="map"></div>
                        <div class="coordinates-display">
                            <div class="coord-item">
                                <span>Latitude:</span>
                                <span id="latDisplay">-6.2000</span>
                            </div>
                            <div class="coord-item">
                                <span>Longitude:</span>
                                <span id="lngDisplay">106.8000</span>
                            </div>
                        </div>
                        <input type="hidden" id="latitude" name="latitude" value="-6.2">
                        <input type="hidden" id="longitude" name="longitude" value="106.8">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-send-check"></i> Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize map
    var map = L.map('map').setView([-6.2, 106.8], 13);
    
    // Fix map display issues
    setTimeout(function() {
        map.invalidateSize();
    }, 100);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 18
    }).addTo(map);

    // Custom marker icon
    var greenIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var marker = L.marker([-6.2, 106.8], {
        draggable: true,
        icon: greenIcon
    }).addTo(map);

    // Update location when marker is dragged
    marker.on('dragend', function(e) {
        updateLocation(e.target.getLatLng());
    });

    // Update location when map is clicked
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        updateLocation(e.latlng);
    });

    function updateLocation(latlng) {
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;
        document.getElementById('latDisplay').textContent = latlng.lat.toFixed(4);
        document.getElementById('lngDisplay').textContent = latlng.lng.toFixed(4);
    }

    // Image preview functionality
    const fotoUpload = document.getElementById('fotoUpload');
    const previewImage = document.getElementById('previewImage');
    const imagePreview = document.getElementById('imagePreview');
    const removeImage = document.getElementById('removeImage');

    fotoUpload.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                imagePreview.style.display = 'flex';
            }
            reader.readAsDataURL(file);
        }
    });

    removeImage.addEventListener('click', function() {
        fotoUpload.value = '';
        previewImage.src = '';
        imagePreview.style.display = 'none';
    });
});
</script>
@endsection

<style>
    :root {
        --primary-color: #198754;
        --secondary-color: #146c43;
        --accent-color: #20c997;
        --light-bg: #f8f9fa;
        --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .report-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .report-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 25px 30px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: var(--card-shadow);
    }

    .report-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .report-header h1 i {
        margin-right: 12px;
    }

    .subtitle {
        font-size: 1rem;
        opacity: 0.9;
        margin: 0;
    }

    .header-icon i {
        font-size: 3rem;
        opacity: 0.2;
    }

    .report-card {
        background-color: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: var(--card-shadow);
    }

    .form-map-container {
        display: flex;
        gap: 30px;
    }

    .form-column {
        flex: 1;
        min-width: 0;
    }

    .map-column {
        flex: 1;
        min-width: 0;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .section-header i {
        font-size: 1.4rem;
        color: var(--primary-color);
        margin-right: 12px;
    }

    .section-header h3 {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
        color: var(--secondary-color);
    }

    .form-floating {
        position: relative;
    }

    .form-floating .form-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
    }

    .form-control {
        height: 50px;
        border-radius: 8px;
        padding-left: 15px;
        border: 1px solid #ddd;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }

    textarea.form-control {
        min-height: 120px;
        padding-top: 15px;
    }

    .file-upload-wrapper {
        position: relative;
    }

    .upload-area {
        display: block;
        border: 2px dashed #ddd;
        border-radius: 8px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .upload-area:hover {
        border-color: var(--primary-color);
        background-color: rgba(25, 135, 84, 0.03);
    }

    .upload-content i {
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 10px;
    }

    .upload-content p {
        margin-bottom: 5px;
        color: #555;
    }

    .upload-content p span {
        color: var(--primary-color);
        font-weight: 600;
    }

    .upload-content small {
        color: #888;
        font-size: 0.8rem;
    }

    #fotoUpload {
        display: none;
    }

    .image-preview {
        display: none;
        position: relative;
        margin-top: 15px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #eee;
        justify-content: center;
        align-items: center;
        max-height: 200px;
    }

    .preview-image {
        max-width: 100%;
        max-height: 200px;
        object-fit: contain;
    }

    .btn-remove-image {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: rgba(255, 0, 0, 0.7);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .btn-remove-image:hover {
        background-color: rgba(255, 0, 0, 0.9);
    }

    #map {
        height: 100%;
        min-height: 400px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .map-instructions {
        display: flex;
        align-items: center;
        background-color: rgba(25, 135, 84, 0.1);
        padding: 8px 12px;
        border-radius: 6px;
        margin-bottom: 10px;
    }

    .map-instructions i {
        color: var(--primary-color);
        margin-right: 8px;
    }

    .map-instructions p {
        margin: 0;
        font-size: 0.9rem;
        color: #555;
    }

    .coordinates-display {
        display: flex;
        gap: 20px;
        background-color: #f8f9fa;
        padding: 10px 15px;
        border-radius: 6px;
        font-size: 0.9rem;
        margin-top: 15px;
    }

    .coord-item {
        display: flex;
        gap: 5px;
    }

    .coord-item span:first-child {
        font-weight: 600;
        color: var(--secondary-color);
    }

    .form-actions {
        margin-top: 30px;
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-submit:hover {
        background-color: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 992px) {
        .form-map-container {
            flex-direction: column;
        }
        
        #map {
            min-height: 350px;
        }
    }

    @media (max-width: 768px) {
        .report-header {
            flex-direction: column;
            text-align: center;
            padding: 20px;
        }

        .header-icon {
            margin-top: 15px;
        }

        .header-icon i {
            font-size: 2.5rem;
        }

        .report-card {
            padding: 20px;
        }

        .coordinates-display {
            flex-direction: column;
            gap: 5px;
        }
    }

    @media (max-width: 576px) {
        .report-container {
            padding: 15px;
        }

        .report-header h1 {
            font-size: 1.5rem;
        }

        .section-header h3 {
            font-size: 1.1rem;
        }
    }
</style>
@endsection