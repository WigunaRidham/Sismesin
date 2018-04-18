
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
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="text-center h3 no-margin">Pemerintah Kota Depok</div>
        <div class="text-center h4">Dinas Perhubungan</div>
        <div class="text-center h4">Unit Pelaksana Teknis Pengujian</div>
        <br>
        <div class="row">
            <div class="col-md-4 col-sm-4 pull-right">
                <p>Kepada, </p>
                <p>Yth {{ strtoupper($vehicle->nama) }}</p>
                <p>Nomer Kendaraan : {{ strtoupper($vehicle->no_kendaraan) }}</p>
                <p>Jenis :  {{ strtoupper($vehicle->jenis_kendaraan) }}</p>
            </div>
        </div>


        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <p>Yang bertanda tangan dibawah ini</p>
                <table class="table no-border">
                    <tr><th width="140"></th><th></th></tr>
                    <tr>
                        <td>Nama</td>
                        <td> : {{ strtoupper($tester->nama) }}</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td> : {{ strtoupper($tester->nip) }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td> : {{ $tester->jabatan }}</td>
                    </tr>

                    <tr><td></td><td></td></tr>
                    <tr>
                        <td>Berdasarkan</td>
                        <td> : 1. Undang Undang No. 22 Tahun 2009
                            <br>
                            2. Peraturan Pemerintah No. 55 TH 2012
                        </td>
                    </tr>
                </table>
                @if($test->completed == 0)
                    <p>Ternyata pada kendaraan bermotor saudara terdapat kekurangan kelengkapan
                    dan persyaratan teknis layak jalan antara lain sebagai berikut :</p>
                    <div class="row">
                        @foreach($notComplete as $notC)
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <li>{{$notC->name}}</li>
                            </div>
                        @endforeach
                    </div>
                    <br>
                    <p>Untuk itu saudara agar segera melengkapi kekurangan tersebut.</p>
                @elseif($test->completed == 1)
                    <p style="text-align: justify">
                        Hasil pengujian kendaraan motor saudara telah memenuhi persyaratan layak jalan.
                        Sehingga telah dinyatakan layak untuk beroperasi.
                    </p>
                @endif
                <br>
                <p>Demikian atas perhatiannya disampaikan terima kasih.</p>
                <br><br><br><br>

                <div class="col-xs-4 pull-right">
                    <p class="text-center">Penguji Penyelia</p>
                    <br><br>
                    <p></p>
                    <p class="text-center"><u>{{ strtoupper($tester->nama) }}</u></p>
                    <p class="text-center">NIP. {{ $tester->nip }}</p>
                </div>
            </div>
        </div>

        {{--{{ $test }}--}}

        {{--<br>--}}
        {{--{{ $tester }}--}}
    </div>
</div>
<script>window.print()</script>
</body>
</html>
