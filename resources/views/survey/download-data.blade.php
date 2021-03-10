<html>
    <head>
        <title></title>
    </head>
    <body>
        <table id="example">
            <tr>
                <th style="min-width: 10px;">No.</th>
                <th id="name_col_head" style="min-width: 180px;">Nama Lokasi</th>
                <th id="kategori_col_head" style="min-width: 100px;">Kategori</th>
                <th id="rt_col_head" style="min-width: 100px;">RT</th>
                <th id="rw_col_head" style="min-width: 100px;">RW</th>
                <th id="kelurahan_col_head" style="min-width: 100px;">Kelurahan</th>
                <th id="kecamatan_col_head" style="min-width: 100px;">Kecamatan</th>
                <th id="pic_1_col_head" style="min-width: 100px;">PIC 1</th>
                <th id="no_telp_pic_1_col_head" style="min-width: 180px;">No Telp PIC 1</th>
                <th id="pic_2_col_head" style="min-width: 100px;">PIC 2</th>
                <th id="no_telp_pic_2_col_head" style="min-width: 180px;">No Telp PIC 2</th>
                <th id="surveyor_col_head" style="min-width: 100px;">Surveyor</th>
                <th id="tanggal_col_head" style="min-width: 180px;">Tanggal Survey</th>
                <th id="lattitude_col_head" style="min-width: 100px;">Lattitude</th>
                <th id="longtitude_col_head" style="min-width: 100px;">Longtitude</th>
                <th id="img1_col_head" style="min-width: 180px;">Gambar</th>
            </tr>
            @foreach ($survey as $data)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td class="name_col">{{ $data->namalokasi }}</td>
                <td class="kategori_col">{{ $data->kategori }}</td>
                <td class="rt_col">{{ $data->rt }}</td>
                <td class="rw_col">{{ $data->rw }}</td>
                <td class="kelurahan_col">{{ $data->kelurahan }}</td>
                <td class="kecamatan_col">{{ $data->kecamatan }}</td>
                <td class="pic_1_col">{{ $data->pic1 }}</td>
                <td class="no_telp_pic_1_col">{{ $data->telp1 }}</td>
                <td class="pic_2_col">{{ $data->pic2 }}</td>
                <td class="no_telp_pic_2_col">{{ $data->telp2 }}</td>
                <td class="surveyor_col">{{ $data->namasurveyor }}</td>
                <td class="tanggal_col">{{ $data->tanggal }}</td>
                <td class="lattitude_col">{{ $data->lattitude }}</td>
                <td class="longtitude_col">{{ $data->longtitude }}</td>
            </tr>
            @endforeach
        </table>
            @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
                crossorigin="anonymous">
            </script>
            @endpush
    </body>
</html>