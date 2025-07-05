<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Required meta tags --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- Title --}}
    <title>Laporan Stok Barang</title>
    
    {{-- custom style --}}
    <style type="text/css">
        body,
        html {
            font-family: sans-serif;
            font-size: 12px;
            color: #29343d;
        }

        table, th, td {
            border: 2px solid #dee2e6;
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
    <div style="display: flex; align-items: center; margin-bottom: 20px; height: 70px;">
        <div style="flex-shrink:0; display: flex; align-items: center;">
            <img src="{{ public_path('images/arsen1.jpeg') }}" alt="Logo" style="height:55px;">
        </div>
        <div style="flex:1; text-align:center; display: flex; align-items: center; justify-content: center; height: 100%;">
            @if (request('stok') == 'Seluruh')
                <h3 style="margin:0; font-size: 16px;">
                    LAPORAN STOK SELURUH BARANG
                </h3>
            @else
                <h3 style="margin:0; font-size: 16px;">
                    LAPORAN STOK BARANG YANG MENCAPAI BATAS MINIMUM
                </h3>
            @endif
        </div>
    </div>
<!-- <body>
    {{-- judul laporan --}}
    <div style="text-align:center;margin-bottom:20px">
       @if (request('stok') == 'Seluruh')
            <h3 style="margin-bottom:10px">
                LAPORAN STOK SELURUH BARANG
            </h3>
        @else
            <h3 style="margin-bottom:10px">
                LAPORAN STOK BARANG YANG MENCAPAI BATAS MINIMUM
            </h3>
        @endif
    </div> -->

    <hr style="margin-bottom:10px">

    {{-- tabel tampil data --}}
    <table style="width:100%">
        <thead style="background-color: #23A9E1; color:rgb(247, 247, 247)">
            <th>No</th>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <!-- <th>Serial Number</th> -->
            <th>Jenis Barang</th>
            <th>Stok Masuk</th>
            <th>Stok Keluar</th>
            <th>Total Stok</th>
            <th>Satuan</th>
            <th>Lokasi</th>
        </thead>
        <tbody>
        @php
            $no = 1;
        @endphp
        @forelse ($barang as $data)
            {{-- jika data ada, tampilkan data --}}
            <tr>
                <td width="30" align="center">{{ $no++ }}</td>
                <td width="80" align="center">{{ $data->id }}</td>
                <td width="100">{{ $data->nama_barang }}</td>
                <!-- <td width="100" align="center">
                     @foreach($data->barang_masuk as $masuk)
                    {{ $masuk->serial_number }}<br>
                    @endforeach                                    
                </td>  -->
                <td width="100" align="center">{{ $data->jenis->nama_jenis }}</td>
                <td width="70" align="center">
                    {{ $data->barang_masuk->sum('jumlah_masuk') }}</td>
                <td width="70" align="center">
                    {{ $data->barang_keluar->sum('jumlah_keluar') }}</td>
                <td width="70" align="center">{{ $data->stok }}</td>
                <td width="100" align="center">{{ $data->satuan->nama_satuan }}</td>
                <td width="100" align="center">{{ $data->lokasi_barang}}</td>
               
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
