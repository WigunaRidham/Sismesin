@extends('layouts.master')

@section('title', '| Create')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/step.css').'?v='.time() }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-datepicker3.min.css').'?v='.time() }}">
@endsection

@section('content')
    <div class="box box-primary col-md-10 col-md-offset-1">
        <div class="box-header h3 text-center">Form Pengecekan Data Kendaraan</div>
        <div class="box-body">
            @if($errors->all())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li><strong>{{ $error }}</strong></li>
                    @endforeach
                </div>
            @endif
            <div class="stepwizard {{--col-md-offset-3--}}">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                        <p>Step 1</p>
                    </div>
                    @foreach($steps as $step)
                        <div class="stepwizard-step">
                            <a href="#step-{{$loop->iteration + 1}}" type="button"
                               class="btn btn-default btn-circle" disabled="disabled">
                                {{ $loop->iteration + 1 }}
                            </a>
                            <p>Step {{ $loop->iteration + 1}}</p>
                        </div>
                    @endforeach
                    {{--<div class="stepwizard-step">--}}
                    {{--<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>--}}
                    {{--<p>Step 2</p>--}}
                    {{--</div>--}}
                </div>
            </div>

            <form role="form" action="{{ route('check.store') }}" method="post">
                {{ csrf_field() }}

                <div class="row setup-content" id="step-1">
                    <div class="col-xs-12 margin-bottom">
                        <h4 class="text-center">Step 1 Form Pengujian Berkala Kendaraan Bermotor</h4>
                        <div class="col-md-12" style="border-color: #d0d3d7;">
                            <div class="header margin-bottom text-black" style="margin-left: 10px">
                                <h4>Data Kendaraan</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-md-12 no-padding">
                                    <label class="control-label col-md-4">Nama Pemilik <a style="text-decoration:none;font-size: 1em">*</a></label>
                                    <div class="col-md-8">
                                        <input maxlength="50" minlength="3" type="text" required="required" name="nama"
                                               class="form-control" placeholder="Masukkan Nama Pemilik" />
                                    </div>
                                </div>
                                <div class="form-group col-md-12 no-padding">
                                    <label class="control-label col-md-4">Alamat <a style="text-decoration:none;font-size: 1em">*</a></label>
                                    <div class="col-md-8">
                                <textarea maxlength="255" minlength="3" type="text" required="required" name="alamat"
                                          class="form-control" rows="3" placeholder="Masukan Alamat" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 no-padding">
                                    <label class="control-label col-md-4">No. Landasan <a style="text-decoration:none;font-size: 1em">*</a></label>
                                    <div class="col-md-8">
                                        <input maxlength="25" minlength="3" type="text" required="required" name="no_landasan"
                                               class="form-control" placeholder="Masukkan Nomer Landasan" />
                                    </div>
                                </div>
                                <div class="form-group col-md-12 no-padding">
                                    <label class="control-label col-md-4">No. Mesin <a style="text-decoration:none;font-size: 1em">*</a></label>
                                    <div class="col-md-8">
                                        <input maxlength="20" minlength="17" type="text" required="required" name="no_mesin"
                                               class="form-control" placeholder="Masukkan Nomer Mesin" />
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-md-12 no-padding">
                                    <label class="control-label col-md-4">No. Kendaraan <a style="text-decoration:none;font-size: 1em">*</a></label>
                                    <div class="col-md-8">
                                        <input maxlength="10" minlength="5" type="text" required="required" name="no_kendaraan"
                                               class="form-control" placeholder="Masukkan Nomer Kendaraan" />
                                    </div>
                                </div>
                                <div class="form-group col-md-12 no-padding">
                                    <label class="control-label col-md-4">Merk <a style="text-decoration:none;font-size: 1em">*</a></label>
                                    <div class="col-md-8">
                                        <input maxlength="20" minlength="3" type="text" required="required" name="merk_tipe_tahun"
                                               class="form-control" placeholder="Masukkan Merk/Tipe/Tahun" />
                                    </div>
                                </div>
                                <div class="form-group col-md-12 no-padding">
                                    <label class="control-label col-md-4">Jenis Kendaraan <a style="text-decoration:none;font-size: 1em">*</a></label>
                                    <div class="col-md-8">
                                        <select name="jenis_kendaraan" id="jenis_kendaraan" required class="form-control">
                                            <option value="Pick Up">Pickup</option>
                                            <option value="Mikrolet">Mikrolet</option>
                                        </select>
                                        {{--<input maxlength="20" minlength="3" type="text" required="required" name="jenis_kendaraan"--}}
                                               {{--class="form-control" placeholder="Masukkan Jenis Kendaraan" />--}}
                                    </div>
                                </div>
                                <div class="form-group col-md-12 no-padding">
                                    <label class="control-label col-md-4">Bahan Bakar <a style="text-decoration:none;font-size: 1em">*</a></label>
                                    <div class="col-md-8">
                                        <input maxlength="15" minlength="3" type="text" required="required" name="bahan_bakar"
                                               class="form-control" placeholder="Masukkan Bahan Bakar" />
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <hr style="border-color: #ddd;" />
                            <div class="header margin-bottom text-black" style="margin-left: 10px">
                                <h4>Penanggung Jawab Pengujian</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-md-12 no-padding">
                                    <label class="control-label col-md-3">Nama <a style="text-decoration:none;font-size: 1em">*</a></label>
                                    <div class="col-md-9">
                                        <input maxlength="50" minlength="3" type="text" required="required" name="nama_tester"
                                               class="form-control" placeholder="Masukkan Nama Penguji"/>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 no-padding">
                                    <label class="control-label col-md-3">NIP <a style="text-decoration:none;font-size: 1em">*</a></label>
                                    <div class="col-md-9">
                                        <input maxlength="25" minlength="3" type="text" required="required" name="nip"
                                               class="form-control" placeholder="Masukkan NIP"/>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 no-padding">
                                    <label class="control-label col-md-3">Jabatan <a style="text-decoration:none;font-size: 1em">*</a></label>
                                    <div class="col-md-9">
                                        <input maxlength="20" minlength="3" type="text" required="required" name="jabatan"
                                               class="form-control" placeholder="Masukkan Jabatan"  />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-info">
                                    <h4 class=""><strong>Perhatian!</strong></h4>
                                    <hr style="margin: 12px 0">
                                    <p>Untuk kelengkapan data dan proses penyimpanan data, maka</p>
                                    <p>Bagian bertanda <code>*</code> harus diisi.</p>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 clearfix" style="padding-bottom: 20px">
                            <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">
                                <span>Next</span>
                                <span class="icon">
                                <i class="fa fa-arrow-right"></i>
                            </span>
                            </button>
                        </div>
                    </div>
                </div>

                @foreach($steps as $step)
                    <div class="row setup-content" id="step-{{$loop->iteration +1}}">
                        <div class="col-md-12">
                            <p class="text-center text-uppercase h4 margin-bottom">
                                Step {{$loop->iteration +1}} {{ $step->name }}
                            </p>
                            @php
                                $len = count($step->checks()->get());
                            @endphp

                            @if ($len <= 8)
                                @foreach($step->checks()->get() as $check)
                                    <div class="col-md-6 col-md-offset-5">
                                        <div class="form-group h4 font-light">
                                            <input type="checkbox" name="step[{{ $step->id }}][]" value="{{ $check->id }}" id="steps-{{ $check->id }}"/>
                                            <label style="font-weight: 400;" for="steps-{{ $check->id }}">{{ ucwords($check->name) }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @foreach($step->checks()->get()->chunk(ceil($len/2)) as $check_c)
                                    <div class="col-md-6">
                                        @foreach($check_c as $check)
                                            @if($loop->parent->iteration == 1)
                                                <div class="col-md-7 col-md-offset-5">
                                                    <div class="form-group h4">
                                                        <input type="checkbox" name="step[{{ $step->id }}][]" value="{{ $check->id }}" id="steps-{{ $check->id }}"/>
                                                        <label class="control-label" style="font-weight: 400;" for="steps-{{ $check->id }}">{{ ucwords($check->name) }}</label>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-7 col-md-offset-1">
                                                    <div class="form-group h4">
                                                        <input type="checkbox" name="step[{{ $step->id }}][]" value="{{ $check->id }}" id="steps-{{ $check->id }}"/>
                                                        <label class="control-label" style="font-weight: 400;" for="steps-{{ $check->id }}">{{ ucwords($check->name) }}</label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            @endif

                            <div class="col-md-12">
                                @if($loop->last)
                                    <button class="btn btn-success btn-lg pull-right" type="submit">
                                        <span class="icon"><i class="fa fa-save"></i></span>
                                        <span>Simpan</span>
                                    </button>
                                @else
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">
                                        <span>Next</span>
                                        <span class="icon"><i class="fa fa-arrow-right"></i></span>
                                    </button>
                                @endif
                                <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">
                                    <span class="icon"><i class="fa fa-arrow-left"></i></span>
                                    <span>Back</span>
                                </button>
                            </div>
                            <div class="clearfix" style="padding-bottom: 10px"></div>
                        </div>
                    </div>
                @endforeach
            </form>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/step.js'.'?v='.time()) }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('#datepicker').datepicker();
    </script>
@endsection