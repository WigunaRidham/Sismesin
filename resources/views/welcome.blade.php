@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-4">
            @if (Auth::check())
            <div class="box box-primary col-md-12">
                <div class="box-header h4">
                    <strong>Cek Status Kendaraan</strong>
                </div>
                <div class="box-body">
                    <form method="post" action="{{ route('find') }}">
                        {{ csrf_field() }}
                        <label for="no_kendaraan">Masukkan Plat Nomer</label>
                        <div class="form-group">
                            <input id="no_kendaraan" type="text" class="form-control" name="no_kendaraan"
                                   value="{{ old('no_kendaraan') }}" placeholder="Plat Nomer" required autofocus>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary pull-right col-md-4" type="submit">Pencarian</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
            <div class="box box-primary col-md-12">
                @if (!Auth::check())
                <div class="box-header h4">
                    <strong>Login </strong>
                </div>
                @endif
                <div class="box-body">
                    @if (!Auth::check())
                    <form action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary col-md-4 pull-right">Login</button>
                        </div>
                    </form>
                    @else
                        <span class="h4 text-success">Halo {{Auth::user()->name}}, anda berhasil login.</span>
                        <br><br>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-primary col-md-12" style="min-height: 500px">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div>&nbsp;</div>
                            <img src="{{ asset('images/dishub.png') }}"
                                 alt="Dinas Perhubungan" height="120" style="margin-left: px;">
                        </div>
                        <div class="col-md-10 text-center h3" style="font-weight: 400;">
                            <p><strong class="h2">Pemerintah Kota Depok</strong> Dinas Perhubungan</p>
                            <p>Unit Pelaksana <strong>Teknis Pengujian</strong></p>
                            <p style="font-size: 13pt; margin-top: 30px;">
                                <span class="icon"><i class="fa fa-map-marker"></i></span>
                                <span>Jalan Jatimulya Kecamatan</span>
                            </p>
                        </div>
                    </div>
                    <hr style="border-top: #818d93; border: 1px solid #676767;">
                    <div class="col-md-12 no-margin" id="search-result">
                        @if(isset($vehicle))
                            <p class="h3 no-margin">
                                <strong>Hasil Pencarian</strong>
                            </p>

                            <br>
                            @if($message !== "")
                            <div class="h4 text-center">
                                <span class="text-danger">{!! $message !!}</span>
                            </div>
                            @endif
                            <br>
                            @if(count($vehicle) == 0)
                                <p class="h4 text-warning">
                                    <span class="icon"><i class="fa fa-warning"></i></span>
                                    <strong>Pencarian tidak ditemukan</strong>
                                </p>
                            @else
                                @foreach($vehicle as $knd)
                                <div class="form-group">
                                    <label for="nama" class="col-md-3">Nama Pemilik </label> :
                                    <strong>{{ ucwords($knd->nama) }}</strong>
                                </div>
                                <div class="form-group">
                                    <label for="plat" class="col-md-3">Plat Nomer</label> :
                                    <strong>{{ strtoupper($knd->no_kendaraan) }}</strong>
                                </div>

                                <div class="form-group">
                                    <label for="date" class="col-md-3">Tanggal Uji</label> :
                                    <strong>{{ date('d-m-Y', strtotime( $knd->created_at)) }}</strong>
                                </div>
                                <div class="form-group">
                                    <label for="uji" class="col-md-3">Nama Penguji</label> :
                                    <strong>{{ ucwords($knd->nama_penguji) }}</strong>
                                </div>
                                <div class="form-group">
                                    <div class="callout callout-{{ $knd->status == 0 ? 'warning':'success' }}">
                                        <p class="text-center h1 no-margin">{{ $knd->status == 0 ? 'Tidak Lulus': 'Lulus'}}</p>
                                    </div>
                                    @if($knd->status == 0 && count($notComplete) > 0)
                                        <p><strong>Bagian yang belum lulus</strong></p>
                                        <div class="row">
                                        @foreach($notComplete as $notcpl)
                                            <div class="col-md-4"><li>{{ ucwords($notcpl->name) }}</li></div>
                                        @endforeach
                                        </div>
                                    @endif
                                </div>
                                @if (Auth::check())
                                    @if($knd->status == 0)
                                        <a class="btn btn-danger col-md-3" href="{{ route('check.edit', $knd->id) }}">
                                            <span class="icon pull-left"><i class="fa fa-check"></i></span> Pengecekan Ulang
                                        </a>
                                    @endif
                                @endif
                                <a class="btn btn-success pull-right col-md-2" href="{{ route('cetak', $knd->id) }}">
                                    <span class="icon pull-left"><i class="fa fa-print"></i></span> Cetak
                                </a>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="row">--}}
        {{--<div class="col-lg-8">--}}
            {{--<section id="boxes">--}}
                {{--<p>--}}
                    {{--Lorem ipsum--}}
                {{--</p>--}}
            {{--</section>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
