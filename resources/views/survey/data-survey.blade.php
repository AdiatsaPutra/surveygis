@extends('layouts.app')

@section('content')

<div class="container-fluid mt-5 mb-5" style="overflow-x:auto;">
    @if(!$survey->isEmpty())
    <form action="{{ url()->current() }}">
        <div class="row mb-3">
            <div class="btn-group">
                <div class="col-6">
                    <input type="text" class="form-control"
                        placeholder="Cari Data , Keyword (Nama/Kategori/Kelurahan/RW)" name="keyword">
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

</script>
@endpush

@endsection
