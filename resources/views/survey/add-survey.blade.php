@extends('layouts.app')

@section('content')
<div class="map-location container-fluid">
    <div class="row mt-5 mb-3">
        <h3 class="font-weight-bold">Masukkan Data Survey Lokasi</h3>
    </div>
    <div class="row">
        <div class="col-md-4 mb-5">
            <form method="post" action="/add-data" enctype="multipart/form-data" name="myForm" onsubmit="">
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
                            <input type="text" class="form-control" placeholder=" Masukan Nama lokasi"
                                name="namalokasi">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label">Kategori</label>
                        <div class="mb-1">
                            <div class="input-group">
                                <select class="form-select" aria-label="Default select example" name="kategori">
                                    <option selected>-- Pilih Kategori --</option>
                                    <option value="Balai RW">Balai RW</option>
                                    <option value="Balai RK">Balai RK</option>
                                    <option value="Balai Warga">Balai Warga</option>
                                    <option value="Fasum">Fasum</option>
                                    <option value="Tempat Ibadah">Tempat Ibadah</option>
                                    <option value="RTHP">RTHP</option>
                                    <option value="Rumah Warga">Rumah Warga</option>
                                    <option value="Tempat Aktivitas Warga Lain">Tempat Aktivitas Warga Lain</option>
                                </select>
                            </div>
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
                    <div class="col-sm-6">
                        <div class="form-group mb-1">
                            <label for="kecamatan">Pilih Kecamatan:</label>
                            <select name="kecamatan" class="form-control">
                                <option value="">--- Pilih Kecamatan ---</option>
                                @foreach ($countries as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-1">
                            <label for="kelurahan">Pilih Kelurahan:</label>
                            <select name="kelurahan" class="form-control">
                                <option>--Kelurahan--</option>
                            </select>
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
                            <input type="hidden" class="form-control" value="{{ Auth::user()->name }}"
                                name="namasurveyor">
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
                            <label class="form-label">Masukkan Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto[]" multiple>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <button type="submit" class="btn btn-block btn-primary">Tambahkan Data</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <div id='map' style='width: 100%; height: 80vh;'></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    jQuery(document).ready(function ()
      {
              jQuery('select[name="kecamatan"]').on('change',function(){
                 var kecamatanID = jQuery(this).val();
                 if(kecamatanID)
                 {
                    jQuery.ajax({
                       url : 'dropdownlist/kelurahan/' +kecamatanID,
                       type : "GET",
                       dataType : "json",
                       success:function(data)
                       {
                          jQuery('select[name="kelurahan"]').empty();
                          jQuery.each(data, function(key,value){
                             $('select[name="kelurahan"]').append('<option value="'+ key +'">'+ value +'</option>');
                          });
                       }
                    });
                 }
                 else
                 {
                    $('select[name="kelurahan"]').empty();
                 }
              });
      });
      
    function required() {
        var namalokasi = document.forms["myForm"]["namalokasi"].value;
        if (namalokasi == "") {
            alert("Nama Lokasi Tidak Boleh Kosong!");
            return false;
        }
        var rt = document.forms["myForm"]["rt"].value;
        if (rt == "") {
            alert("RT Tidak Boleh Kosong!");
            return false;
        }
        var rw = document.forms["myForm"]["rw"].value;
        if (rw == "") {
            alert("RW Tidak Boleh Kosong!");
            return false;
        }
        var kelurahan = document.forms["myForm"]["kelurahan"].value;
        if (kelurahan == "") {
            alert("Kelurahan Tidak Boleh Kosong!");
            return false;
        }
        var kecamatan = document.forms["myForm"]["kecamatan"].value;
        if (kecamatan == "") {
            alert("Kecamatan Tidak Boleh Kosong!");
            return false;
        }
        var pic1 = document.forms["myForm"]["pic1"].value;
        if (pic1 == "") {
            alert("Pic1 Tidak Boleh Kosong!");
            return false;
        }
        var telp1 = document.forms["myForm"]["telp1"].value;
        if (telp1 == "") {
            alert("Nomor Telepon Tidak Boleh Kosong!");
            return false;
        }

    }

    mapboxgl.accessToken = 'pk.eyJ1IjoiYWRpYXRzYSIsImEiOiJja2w1eWhlOXMxcHdxMnBvZXVkcmhnaXF6In0.kZ56zJwTnSp0r5VH3cIKEg';
    var map = new mapboxgl.Map({
        container: 'map', // nama container id untuk memuat map, di sini ada pada baris ke-16
        style: 'mapbox://styles/mapbox/satellite-streets-v11', // stylesheet location, menentukan tampilan map
        center: [110.4188121, -7.259209], // starting position [lng, lat]
        zoom: 12 // starting zoom
    });

    map.on('style.load', function () {
        map.on('click', function (e) {
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
        frame.src = URL.createObjectURL(event.target.files[0]);
    }

    function preview2() {
        frame2.src = URL.createObjectURL(event.target.files[0]);
    }

    var tanggallengkap = new String();
    var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
    namahari = namahari.split(" ");
    var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
    namabulan = namabulan.split(" ");
    var tgl = new Date();
    var hari = tgl.getDay();
    var tanggal = tgl.getDate();
    var bulan = tgl.getMonth();
    var tahun = tgl.getFullYear();
    tanggallengkap = namahari[hari] + ", " + tanggal + " " + namabulan[bulan] + " " + tahun;
    console.log(tanggallengkap);
    document.getElementById('tgl').value = tanggallengkap;

    function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
        frame2.src = URL.createObjectURL(event.target.files[1]);
        frame3.src = URL.createObjectURL(event.target.files[2]);
        frame4.src = URL.createObjectURL(event.target.files[3]);
        frame5.src = URL.createObjectURL(event.target.files[4]);
        frame6.src = URL.createObjectURL(event.target.files[5]);
        frame7.src = URL.createObjectURL(event.target.files[6]);
        frame8.src = URL.createObjectURL(event.target.files[7]);
        frame9.src = URL.createObjectURL(event.target.files[8]);
        frame10.src = URL.createObjectURL(event.target.files[9]);

        // ini komen 
    }

</script>
@endpush
@endsection