@extends('layouts.app')

@section('content')
<div class="map-location container-fluid">
    <div class="row mb-3">
        <h3 class="font-weight-bold">Masukkan Data Survey Lokasi</h3>
    </div>
    <div class="row">
        <div class="col-md-4 mb-5">
            <form method="post" action="/add-data" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-sm-6">
                         <div class="mb-1">
                            <label for="lattitude" class="form-label">Lattitude</label>
                            <input type="text" class="form-control" placeholder="Masukkan Lattitude" name="lat"
                                id="lat">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label class="form-label">Longtitude</label>
                            <input type="text" class="form-control" placeholder="Masukkan Longtitude" name="lng"
                                id="lng">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <label class="form-label">Nama Lokasi</label>
                            <input type="text" class="form-control" placeholder=" Masukan Nama lokasi" name="namalokasi">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <label class="form-label">Kategori</label>
                            <input type="text" class="form-control" placeholder=" Masukan Jenis Lokasi" name="kategori">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label class="form-label">RT</label>
                            <input type="text" class="form-control" placeholder="Masukkan RT" name="rt">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label class="form-label">RW</label>
                            <input type="text" class="form-control" placeholder="Masukkan RW" name="rw">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <label class="form-label">Kelurahan</label>
                            <input type="text" class="form-control" placeholder=" Masukan Kelurahan" name="kelurahan">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" placeholder=" Masukan Kecamatan" name="kecamatan">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label class="form-label">PIC 1</label>
                            <input type="text" class="form-control" placeholder="Masukkan PIC 1" name="pic1">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label class="form-label">Telepon</label>
                            <input type="text" class="form-control" placeholder="Masukan Telepon" name="telp1">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label class="form-label">PIC 2</label>
                            <input type="text" class="form-control" placeholder="Masukkan PIC 2" name="pic2">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label class="form-label">Telepon</label>
                            <input type="text" class="form-control" placeholder="Masukan Telepon" name="telp2">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <input type="hidden" class="form-control" value="{{ Auth::user()->name }}" name="namasurveyor">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <label class="form-label">Tanggal Disurvey</label>
                            <input type="text" class="form-control" id="tgl" name="tgl">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <label class="form-label">Foto Lokasi</label>
                            <input type="file" class="form-control" id="foto" onchange="preview()" name="foto1">
                            <img id="frame" src="" width="100px" height="100px"/>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-1">
                             <label class="form-label">Foto Lokasi 2</label>
                            <input type="file" class="form-control" id="foto" onchange="preview2()" name="foto2">
                            <img id="frame2" src="" width="100px" height="100px"/>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button class="btn btn-primary btn-block mt-3" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <div id='map' style='width: 100%; height: 80vh;'></div>
        </div>
    </div>
</div>

{{-- 
    mapboxgl.accessToken = 'pk.eyJ1IjoiYWRpYXRzYSIsImEiOiJja2w1eWhlOXMxcHdxMnBvZXVkcmhnaXF6In0.kZ56zJwTnSp0r5VH3cIKEg';
    var map = new mapboxgl.Map({
        container: 'map',
        center: defaultLocation,
        zoom: 15,

    }); --}}

@push('scripts')
<script>

    // Initialize Mapbox View
    navigator.geolocation.getCurrentPosition( function(position) {

    // Default Lokasi Map
        var lng = position.coords.longitude;
        var lat = position.coords.latitude;                    
        const defaultLocation = [lng, lat];

        mapboxgl.accessToken = 'pk.eyJ1IjoiYWRpYXRzYSIsImEiOiJja2w1eWhlOXMxcHdxMnBvZXVkcmhnaXF6In0.kZ56zJwTnSp0r5VH3cIKEg';

        var map = new mapboxgl.Map({
            container: 'map',          
            center: [ lng, lat ],
            zoom: 12
        });

        // Set Map Style
    map.setStyle('mapbox://styles/mapbox/satellite-streets-v11');

    // Add Map Controller
    map.addControl(new mapboxgl.GeolocateControl({
  positionOptions: {
    enableHighAccuracy: true
  },
    trackUserLocation: true
}));

    // Get Latittude Longitude
    map.on('click', function (e) {
        const latittude = e.lngLat.lat;
        const longtitude = e.lngLat.lng;

        document.getElementById('lat').value = latittude;
        document.getElementById('lng').value = longtitude;

    });

    const geoJson = {
        "type": "FeatureCollection",
        "features": [
            {
            "type": "Feature",
            "geometry": {
                "coordinates": [
                "110.36774955397762",
                "-7.824041452653281"
                ],
                "type": "Point"
            },
            "properties": {
                "locationId": 29,
                "namalokasi": "Rumah saya Edit",
                "image": "https://i0.wp.com/www.amazine.co/wp-content/uploads/2013/04/Gurita.jpg?resize=610%2C424",
                "image2": "https://i0.wp.com/www.amazine.co/wp-content/uploads/2013/04/Gurita.jpg?resize=610%2C424",
                "tipelokasi": "oke mantap Edit"
            }
            },
        ]
    }

    // Add Marker
    const addMarkers = () => {
        geoJson.features.forEach((location) => {
            const {
                geometry,
                properties
            } = location;
            const {
                message,
                iconSize,
                locationId,
                namalokasi,
                image,
                image2,
                tipelokasi
            } = properties;

            // Create a marker
            var el = document.createElement('div');
            el.className = 'marker' + locationId;
            el.id = locationId;
            el.style.backgroundImage =
                'url(https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-512.png)';
            el.style.backgroundSize = 'cover';
            el.style.width = '50px';
            el.style.height = '50px';


            let content = `<div style="overflow-y: auto; max-height:400px;width:100%;">
                    <table class="table table-sm mt-2">
                         <tbody>
                            <tr>
                                <td>Nama Lokasi</td>
                                <td>${namalokasi}</td>
                            </tr>
                            <tr>
                                <td>Foto 1</td>
                                <td><img src="${image}" loading="lazy" class="img-fluid"/></td>
                            </tr>
                            <tr>
                                <td>Foto 2</td>
                                <td><img src="${image2}" loading="lazy" class="img-fluid"/></td>
                            </tr>
                            <tr>
                                <td>Tipe Lokasi</td>         
                                <td>${tipelokasi}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>`;

            let popup = new mapboxgl.Popup({
                offset: 25
            }).setHTML(content).setMaxWidth("400px");

            // Add to the map
            new mapboxgl.Marker(el)
                .setLngLat(defaultLocation)
                .setPopup(popup)
                .addTo(map);
        });
    }

    // Call Add Markers
    addMarkers();
    });

    function preview() {
        frame.src=URL.createObjectURL(event.target.files[0]);
    }

    function preview2() {
        frame2.src=URL.createObjectURL(event.target.files[0]);
    }
    
    date = new Date();
    hari = date.getDay();
    tanggal = date.getDate();
    bulan = date.getMonth();
    tahun = date.getFullYear();
    hariIndonesia = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
    bulanIndonesia = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    var formattedTanggal = hariIndonesia[hari] + ', ' + tanggal + ' ' + bulanIndonesia[bulan] + ' ' + tahun;
    document.getElementById('tgl').value = formattedTanggal;

</script>
@endpush
@endsection
