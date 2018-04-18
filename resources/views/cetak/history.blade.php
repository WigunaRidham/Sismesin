
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')Sistem Informasi Monitoring dan Perencanaan Uji Kelayakan Pada Kendaraan Bermotor </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('css/app.css'.'?v='.time()) }}">
    <style>
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
            padding: 0;
            line-height: 1.6;
        }
        p, div, td{
            margin:0;
            font-size: 12pt;
        }
    </style>
</head>
<body>
<div class="box-body">
    <div class="h2 text-center">History Kendaraan</div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <table class="table table-responsive table-striped table-bordered">
                <tr>
                    <th>No.Kendaraan</th>
                    <th>Nama Pemilik</th>
                    <th>Jenis Kendaraan</th>
                    <th>Tanggal</th>
                    <th>Nama Penguji</th>
                    <th>Status</th>
                </tr>
                @foreach($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->no_kendaraan }}</td>
                        <td>{{ strtoupper($vehicle->nama) }}</td>
                        <td>{{ $vehicle->merk_tipe_tahun }}</td>
                        <td>{{ $vehicle->created_at }}</td>
                        <td>{{ strtoupper($vehicle->nama_penguji) }}</td>
                        @if($vehicle->status == 1)
                            <td><a class="text-green text-bold">Lulus</a></td>
                        @else
                            <td><a class="text-bold text-danger">Tidak Lulus</a></td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
</div>
<script>window.print()</script>
</body>
</html>
