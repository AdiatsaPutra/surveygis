@extends('layouts.app')

@section('content')

<div class="container-fluid mt-5 mb-5" style="overflow-x:auto;">
    @if(!$survey->isEmpty())
    <form action="{{ url()->current() }}">
        <div class="row mb-3">
            <div class="btn-group">
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="Cari Data , Keyword (Nama/Kategori/Kelurahan/RW)" name="keyword">
                </div>
                <div class="col-2">
                    <button id="btnsearch" class="btn btn-primary" type="submit">Search</button>
                </div>
                <div class="col-2">
                    <a id="btntambah" href="{{ route('home') }}" class="btn btn-danger" type="submit">Tambah Data</a>
                </div>
            </div>
        </div>
    </form>
    @else
    <div class="row text-center mb-5">
        <h3 class="font-weight-bold">Belum Ada Data</h3>
    </div>
    @endif
    <table>
        @if(!$survey->isEmpty())
        <tr>
            <th style="min-width: 180px;">No.</th>
            <th style="min-width: 180px;">Nama Lokasi</th>
            <th style="min-width: 180px;">Kategori</th>
            <th style="min-width: 180px;">RT</th>
            <th style="min-width: 180px;">RW</th>
            <th style="min-width: 180px;">Kelurahan</th>
            <th style="min-width: 180px;">Kecamatan</th>
            <th style="min-width: 180px;">PIC 1</th>
            <th style="min-width: 180px;">No Telp PIC 1</th>
            <th style="min-width: 180px;">PIC 2</th>
            <th style="min-width: 180px;">No Telp PIC 2</th>
            <th style="min-width: 180px;">Surveyor</th>
            <th style="min-width: 180px;">Tanggal Survey</th>
            <th style="min-width: 180px;">Lattitude</th>
            <th style="min-width: 180px;">Longtitude</th>
            <th style="min-width: 180px;">Gambar 1</th>
            <th style="min-width: 180px;">Gambar 2</th>
            <th style="min-width: 180px;">Actions</th>
        </tr>
        @else

        @endif
        @forelse ($survey as $data)
        <tr>
            @php
            $imgpath = Storage::url('images/'.$data->fotolokasi1);
            $imgpath2 = Storage::url('images/'.$data->fotolokasi2);
            @endphp
            <td>{{ $loop->iteration + $survey->firstItem() - 1 }}</td>
            <td>{{ $data->namalokasi }}</td>
            <td>{{ $data->kategori }}</td>
            <td>{{ $data->rt }}</td>
            <td>{{ $data->rw }}</td>
            <td>{{ $data->kelurahan }}</td>
            <td>{{ $data->kecamatan }}</td>
            <td>{{ $data->pic1 }}</td>
            <td>{{ $data->telp1 }}</td>
            <td>{{ $data->pic2 }}</td>
            <td>{{ $data->telp2 }}</td>
            <td>{{ $data->namasurveyor }}</td>
            <td>{{ $data->tanggal }}</td>
            <td>{{ $data->lattitude }}</td>
            <td>{{ $data->longtitude }}</td>
            <td><img src="{{ url($imgpath) }}" style="width: 100px;" alt=""></td>
            <td><img src="{{ url($imgpath2) }}" style="width: 100px;" alt=""></td>
            <td>
                <div class="row">
                    <div class="col-4">
                        <form action="/cetak/{{ $data->id }}">
                            <button class="btn btn-primary">
                                Cetak
                            </button>
                        </form>
                    </div>
                    <div class="col-4">
                        <form action="/edit-data/{{ $data->id }}">
                            <button type="submit" class="btn btn-warning">
                                Edit
                            </button>
                        </form>
                    </div>
                    <div class="col-4">
                        <form method="post" action="/delete/{{ $data->id }}">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger" onclick="return confirm('Yakin akan menghapus data ini ?')"
                                type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </td>
            @empty
            <div class="row justify-content-center">
                <img class="img-fluid" src="{{ asset('img/nodata.jpg') }}">
            </div>
            @endforelse
        </tr>
    </table>
</div>
{!! $survey->links() !!}

@push('scripts')
<script>
    // Initialize Mapbox View
    navigator.geolocation.getCurrentPosition(function (position) {

        // Default Lokasi Map
        var lng = position.coords.longitude;
        var lat = position.coords.latitude;
        const defaultLocation = [lng, lat];

        mapboxgl.accessToken =
            'pk.eyJ1IjoiYWRpYXRzYSIsImEiOiJja2w1eWhlOXMxcHdxMnBvZXVkcmhnaXF6In0.kZ56zJwTnSp0r5VH3cIKEg';

        var map = new mapboxgl.Map({
            container: 'map',
            center: [lng, lat],
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
            "features": [{
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
            }, ]
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
        frame.src = URL.createObjectURL(event.target.files[0]);
    }

    function preview2() {
        frame2.src = URL.createObjectURL(event.target.files[0]);
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
