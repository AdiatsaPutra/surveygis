@extends('layouts.app')

@section('content')

<div class="container-fluid mt-5 mb-5" style="overflow-x:auto;">
    <table>
        <tr>
            <th style="min-width: 180px;">No.</th>
            <th style="min-width: 180px;">Lattitude</th>
            <th style="min-width: 180px;">Last Name</th>
            <th style="min-width: 180px;">Points</th>
            <th style="min-width: 180px;">Points</th>
            <th style="min-width: 180px;">Points</th>
            <th style="min-width: 180px;">Points</th>
            <th style="min-width: 180px;">Points</th>
            <th style="min-width: 180px;">Points</th>
            <th style="min-width: 180px;">Points</th>
            <th style="min-width: 180px;">Points</th>
            <th style="min-width: 180px;">Points</th>
            <th style="min-width: 180px;">Points</th>
            <th style="min-width: 180px;">Points</th>
            <th style="min-width: 180px;">Points</th>
            <th style="min-width: 180px;">Points</th>
            <th style="min-width: 180px;">Points</th>
            <th style="min-width: 180px;">Points</th>
            <th style="min-width: 180px;">Points</th>
        </tr>
        @forelse ($survey as $data)
        <tr>
        @php
        $imgpath = Storage::url('images/'.$data->fotolokasi1);
        $imgpath2 = Storage::url('images/'.$data->fotolokasi2);
        @endphp
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->lattitude }}</td>
            <td>{{ $data->longtitude }}</td>
            <td>{{ $data->namalokasi }}</td>
            <td>{{ $data->kategori }}</td>
            <td>{{ $data->rt }}</td>
            <td>{{ $data->rw }}</td>
            <td>{{ $data->kelurahan }}</td>
            <td>{{ $data->kecamatan }}</td>
            <td>{{ $data->pic1 }}</td>
            <td>{{ $data->pic2 }}</td>
            <td>{{ $data->telp1 }}</td>
            <td>{{ $data->telp2 }}</td>
            <td>{{ $data->namasurveyor }}</td>
            <td>{{ $data->tanggal }}</td>
            <td><img src="{{ url($imgpath) }}" style="width: 180px;" alt=""></td>
            <td><img src="{{ url($imgpath2) }}" style="width: 180px;" alt=""></td>
            <td><button class="btn btn-warning">Edit</button></td>
            <td><button class="btn btn-danger">Delete</button></td>
            @empty
            <p>Data Sedang Kosong</p>
            @endforelse
        </tr>
    </table>
</div>

@endsection
