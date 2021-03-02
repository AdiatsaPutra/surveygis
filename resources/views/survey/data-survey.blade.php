@extends('layouts.app')

@section('content')

<div class="container-fluid mt-5 mb-5" style="overflow-x:auto;">
    <table>
        <tr>
            <th style="min-width: 180px;">No.</th>
            <th style="min-width: 180px;">Lattitude</th>
            <th style="min-width: 180px;">Longtitude</th>
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
            <th style="min-width: 180px;">Gambar 1</th>
            <th style="min-width: 180px;">Gambar 2</th>
            <th style="min-width: 180px;">Actions</th>
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
            <td>{{ $data->telp1 }}</td>
            <td>{{ $data->pic2 }}</td>
            <td>{{ $data->telp2 }}</td>
            <td>{{ $data->namasurveyor }}</td>
            <td>{{ $data->tanggal }}</td>
            <td><img src="{{ url($imgpath) }}" style="width: 180px;" alt=""></td>
            <td><img src="{{ url($imgpath2) }}" style="width: 180px;" alt=""></td>
            <td><button class="btn btn-warning">Edit</button>
            <form method="post" action="/delete/{{ $data->id }}">
                @method('delete')
                @csrf
                <button class="btn btn-danger" onclick="return confirm('Yakin akan menghapus post ini ?')"
                        type="submit">Delete</button></td>
            </form>
            @empty
            <p>Data Sedang Kosong</p>
            @endforelse
        </tr>
    </table>
</div>

@endsection
