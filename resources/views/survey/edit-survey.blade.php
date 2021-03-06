@extends('layouts.app')

@section('content')
<div class="map-location container-fluid">
    <div class="row mt-5 mb-3">
        <h3 class="font-weight-bold">Edit Data Survey Lokasi</h3>
    </div>
    <div class="row">
        <div class="col-md-4 mb-5">
            <form method="POST" action="/edit-data/{{ $survey->id }}" enctype="multipart/form-data">
            <div class="form-group">
              @csrf
              @method('PUT')
                <div class="row">
                    <div class="col-sm-6">
                         <div class="mb-1">
                            <label for="lattitude" class="form-label">Lattitude</label>
                            <input type="text" class="form-control" placeholder="Masukkan Lattitude" name="lat"
                                id="lat" value= "{{ $survey->lattitude }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label class="form-label">Longtitude</label>
                            <input type="text" class="form-control" placeholder="Masukkan Longtitude" name="lng"
                                id="lng" value= "{{ $survey->longtitude }}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <label class="form-label">Nama Lokasi</label>
                            <input type="text" class="form-control" placeholder=" Masukan Nama lokasi" name="namalokasi" value= "{{ $survey->namalokasi }}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <label class="form-label">Kategori</label>
                            <input type="text" class="form-control" placeholder=" Masukan Jenis Lokasi" name="kategori" value= "{{ $survey->kategori }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label class="form-label">RT</label>
                            <input type="text" class="form-control" placeholder="Masukkan RT" name="rt" value= "{{ $survey->rt }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label class="form-label">RW</label>
                            <input type="text" class="form-control" placeholder="Masukkan RW" name="rw" value= "{{ $survey->rw }}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <label class="form-label">Kelurahan</label>
                            <input type="text" class="form-control" placeholder=" Masukan Kelurahan" name="kelurahan" value= "{{ $survey->kelurahan }}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" placeholder=" Masukan Kecamatan" name="kecamatan" value= "{{ $survey->kecamatan }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label class="form-label">PIC 1</label>
                            <input type="text" class="form-control" placeholder="Masukkan PIC 1" name="pic1" value= "{{ $survey->pic1 }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label class="form-label">Telepon</label>
                            <input type="text" class="form-control" placeholder="Masukan Telepon" name="telp1" value= "{{ $survey->telp1 }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label class="form-label">PIC 2</label>
                            <input type="text" class="form-control" placeholder="Masukkan PIC 2" name="pic2" value= "{{ $survey->pic2 }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label class="form-label">Telepon</label>
                            <input type="text" class="form-control" placeholder="Masukan Telepon" name="telp2" value= "{{ $survey->telp2 }}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <input type="hidden" class="form-control" value="{{ Auth::user()->name }}" name="namasurveyor" value= "{{ $survey->namasurveyor }}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <label class="form-label">Tanggal Disurvey</label>
                            <input type="text" class="form-control" id="tgl" name="tgl" value= "{{ $survey->tgl }}">
                        </div>
                    </div>
                    @php
                    $imgpath = Storage::url('images/'.$survey->fotolokasi1);
                    $imgpath2 = Storage::url('images/'.$survey->fotolokasi2);
                    @endphp
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <label class="form-label">Foto Lokasi</label>
                            <input type="file" class="form-control" id="foto" onchange="preview()" name="foto1">
                            <img src="{{ url($imgpath) }}" style="width: 100px;" alt="">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-1">
                             <label class="form-label">Foto Lokasi 2</label>
                            <input type="file" class="form-control" id="foto" onchange="preview2()" name="foto2">
                            <img src="{{ url($imgpath2) }}" style="width: 100px;" alt="">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button class="btn btn-primary btn-block mt-3" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        <div class="col-md-8">
            <div id='map' style='width: 100%; height: 80vh;'></div>
        </div>
</div>

@push('scripts')
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiYWRpYXRzYSIsImEiOiJja2w1eWhlOXMxcHdxMnBvZXVkcmhnaXF6In0.kZ56zJwTnSp0r5VH3cIKEg';
        var map = new mapboxgl.Map({
            container: 'map', // nama container id untuk memuat map, di sini ada pada baris ke-16
            style: 'mapbox://styles/mapbox/satellite-streets-v11', // stylesheet location, menentukan tampilan map
            center: [110.4188121, -7.259209], // starting position [lng, lat]
            zoom: 12 // starting zoom
        });

        map.on('style.load', function() {
        map.on('click', function(e) {
            var coordinates = e.lngLat;
            
            new mapboxgl.Popup()
            .setLngLat(coordinates)
            .setHTML('you clicked here: <br/>' + coordinates)
            .addTo(map);
            });       
        });

    // Add Map Controller
    map.addControl(new mapboxgl.GeolocateControl({
    positionOptions: {
        enableHighAccuracy: true
    },
        trackUserLocation: true
    }));

    map.addControl(new mapboxgl.NavigationControl());

    // Get Latittude Longitude
    map.on('click', function (e) {
        const latittude = e.lngLat.lat;
        const longtitude = e.lngLat.lng;
        
        document.getElementById('lat').value = latittude;
        document.getElementById('lng').value = longtitude;

    });
    
    function preview() {
        frame.src=URL.createObjectURL(event.target.files[0]);
    }

    function preview2() {
        frame2.src=URL.createObjectURL(event.target.files[0]);
    }
    
    date = new Date();
    hari = date.getDay();
    bulan = date.getMonth();
    tahun = date.getFullYear();
    hariIndonesia = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
    bulanIndonesia = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    console.log(hari)
    var formattedTanggal = hariIndonesia[hari - 1] + ', ' + hari + ' ' + bulanIndonesia[bulan] + ' ' + tahun;
    document.getElementById('tgl').value = formattedTanggal;
    console.log(formattedTanggal)
</script>
@endpush
@endsection