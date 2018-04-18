@extends('layouts.master')

@section('title', 'History Kendaraan | ')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/step.css').'?v='.time() }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-datepicker3.min.css').'?v='.time() }}">
@endsection

@section('content')
    <div class="box box-primary col-md-12">
        <div class="box-header h3">
            History Kendaraan
            @if(Auth::user()->hasRole('admin'))
            <a href="{{ route('check.create') }}" class="btn">
                <span class="icon"><i class="fa fa-plus"></i></span>
                <span>Input Data Baru</span>
            </a>
            @endif
            <a href="{{ route('cetak_history') }}" class="btn">
                <span class="icon"><i class="fa fa-print"></i></span>
                <span>Cetak Data</span>
            </a>
        </div>
        <div class="box-body">

            <table class="table table-responsive table-striped table-bordered">
                <tr>
                    <th>No.Kendaraan</th>
                    <th>Nama Pemilik</th>
                    <th>Jenis Kendaraan</th>
                    <th>Tanggal</th>
                    <th>Nama Penguji</th>
                    <th>Status</th>
                    <th width="216">Action</th>
                </tr>
                @foreach($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->no_kendaraan }}</td>
                    <td>{{ strtoupper($vehicle->nama) }}</td>
                    <td>{{ $vehicle->merk_tipe_tahun }}</td>
                    <td>{{ date('d/m/Y', strtotime( $vehicle->created_at)) }}</td>
                    <td>{{ strtoupper($vehicle->nama_penguji) }}</td>
                    @if($vehicle->status == 1)
                        <td><a class="text-green text-bold">Lulus</a></td>
                    @else
                        <td><a class="text-bold text-danger">Tidak Lulus</a></td>
                    @endif
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{ route('cetak', $vehicle->id) }}">
                            <span class="icon"><i class="fa fa-print"></i></span>
                            <span>Cetak</span>
                        </a>
                    @if($vehicle->status == 0)
                        <a class="btn btn-success btn-xs" href="{{ route('check.edit', $vehicle->id) }}">
                            <span class="icon"><i class="fa fa-check"></i></span>
                            <span>Update</span>
                        </a>
                    @endif
                        @if(Auth::user()->hasRole('admin'))
                        <a class="btn btn-danger btn-xs" href="{{ route('check.destroy', $vehicle->id) }}"
                           onclick="event.preventDefault(); document.getElementById('delete-form-{{$vehicle->id}}').submit();">
                            <span class="icon"><i class="fa fa-remove"></i></span>
                            <span>Delete</span>
                        </a>

                        <form id="delete-form-{{$vehicle->id}}" action="{{ route('check.destroy', $vehicle->id) }}" method="POST" style="display: none;">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach

            </table>

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