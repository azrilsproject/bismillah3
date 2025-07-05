<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Required meta tags --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- Title --}}
    <title>Laporan Barang Keluar</title>
    
    {{-- custom style --}}
    <style type="text/css">
        body,
        html {
            font-family: sans-serif;
            font-size: 12px;
            color: #29343d;
        }

        table, th, td {
            border: 1px solid #dee2e6;
            border-collapse: collapse;
        }

        th, td {
            padding: 3px 2px;
        }

        hr {
            color: #dee2e6;
        }
    </style>
</head>

<body>
    {{-- logo dan judul laporan --}}
    <div style="display: flex; align-items: center; margin-bottom: 20px; height: 60px;">
        <div style="flex-shrink:0; display: flex; align-items: center;">
            <img src="{{ public_path('images/arsen1.jpeg') }}" alt="Logo" style="height:55px;">
        </div>
    <div style="text-align:center;margin-bottom:5px">
        <h3 style="margin-bottom:10px">LAPORAN DATA BARANG KELUAR</h3>
        <span>Tanggal {{ Carbon\Carbon::parse(request('tgl_awal'))->translatedFormat('j F Y') . ' s.d. ' . Carbon\Carbon::parse(request('tgl_akhir'))->translatedFormat('j F Y') }}</span>
    </div>

    <hr style="margin-bottom:10px">

    {{-- tabel tampil data --}}
    <table style="width:100%">
        <thead style="background-color: #23A9E1; color:rgb(247, 247, 247)">
            <th>No</th>
            <th>Tanggal</th>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Serial Number</th>
            <th>Jumlah Keluar</th>
            <th>Satuan</th>
            <th>Lokasi Pengambilan</th>
            <th>Penanggung Jawab</th>
        </thead>
        <tbody>
        @php
            $no = 1;
        @endphp
        @forelse ($barangKeluar as $data)
            {{-- jika data ada, tampilkan data --}}
            <tr>
                <td width="30" align="center">{{ $no++ }}</td>
                <td width="80" align="center">{{ Carbon\Carbon::parse($data->tanggal)->translatedFormat('j F Y') }}</td>
                <td width="80" align="center">{{ $data->barang_id }}</td>
                <td width="100" align ="align">{{ $data->nama_barang }}</td>
                <td width="100" align="center">{{ $data->sn }}</td>
                <td width="50" align="center">{{ $data->jumlah_keluar }}</td>
                <td width="50" align="center">{{ $data->nama_satuan }}</td>
                <td width="100" align="center">{{ $data->lokasi_pengambilan }}</td>
                <td width="100" align="center">{{ $data->penanggung_jawab }}</td>
            </tr>
        @empty
            {{-- jika data tidak ada, tampilkan pesan data tidak tersedia --}}
            <tr>
                <td align="center" colspan="6">Tidak ada data tersedia.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top: 25px; text-align: right">..............................., {{ Carbon\Carbon::now()->translatedFormat('j F Y') }}</div>
</body>

</html>
