<?php

namespace App\Http\Controllers;

use App\Check;
use App\Step;
use App\Test;
use App\TestingPerson;
use App\TestResult;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChecksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->hasRole('user')){
            return redirect('/');
        }
        $vehicles = DB::table('vehicles')
            ->join('testing_persons', 'vehicles.id', '=', 'testing_persons.vehicle_id')
            ->join('tests', 'vehicles.id', '=', 'tests.vehicle_id')
            ->select('vehicles.*', 'testing_persons.nama as nama_penguji', 'tests.completed as status')
            ->get();


        return view('checks.index', ['vehicles'=>$vehicles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasRole('admin')){
            return redirect('/');
        }
        $steps = Step::all();

        return view('checks.createcheck', ['steps'=>$steps]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->hasRole('admin')){
            return redirect('/');
        }


        $this->validate($request,[
            'nama' => "required|min:3|max:50",
            'alamat' => "required|min:3",
            'no_landasan' => "required|max:25",
            'no_mesin' => "required|max:20|unique:vehicles",
            'no_kendaraan' => "required|max:10|unique:vehicles",
            'merk_tipe_tahun' => "required|max:20",
            'jenis_kendaraan' => "required|max:20",
            'bahan_bakar' => "required|max:15",
            'nama_tester' => "required|min:3|max:50",
            'nip' => "required|min:3|max:25",
            'jabatan' => "required|max:20",
        ]);

        $kendaraan = new Vehicle();
        $kendaraan->nama = $request->nama;
        $kendaraan->alamat = $request->alamat;
        $kendaraan->no_landasan = $request->no_landasan;
        $kendaraan->no_mesin = $request->no_mesin;
        $kendaraan->no_kendaraan = $request->no_kendaraan;
        $kendaraan->merk_tipe_tahun = $request->merk_tipe_tahun;
        $kendaraan->jenis_kendaraan = $request->jenis_kendaraan;
        $kendaraan->bahan_bakar = $request->bahan_bakar;
        $kendaraan->save();

        $tester = new TestingPerson();
        $tester->vehicle_id = $kendaraan->id;
        $tester->nama = $request->nama_tester;
        $tester->nip = $request->nip;
        $tester->jabatan = $request->jabatan;
        $tester->save();

        $urutantest = new Test();
        $urutantest->vehicle_id = $kendaraan->id;
        // sementara sampe step diisi
        $urutantest->completed = 0;
        $urutantest->save();

        $counter = 0;
        foreach ($request->step as $key => $values){
            foreach ($values as $val){
                $result = new TestResult();
                $result->check_id = $val;
                $result->test_id = $urutantest->id;
                $result->save();

                // tambah counter setiap simpan data
                $counter++;
            }
        }

        if($counter == 56){
            $urutantest->completed = 1;
            $urutantest->save();
        }
        session()->flash('notif', 'Sukses, data telah tersimpan.');

        return redirect()->route('check.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasRole('admin')){
            return redirect('/');
        }
        $vehicle = Vehicle::findOrFail($id);
        $tester = TestingPerson::where('vehicle_id', $id)->firstOrFail();
        $test = Test::where('vehicle_id', $id)->firstOrFail();
        $testResult = TestResult::where('test_id', $test->id)->get();
        $steps = Step::all();
        return view('checks.updatecheck',
            [
                'vehicle'   => $vehicle,
                'tester'    => $tester,
                'test'      => $test,
                'testResult'=> $testResult,
                'steps'     => $steps
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasRole('admin')){
            return redirect('/');
        }
        $kendaraan = Vehicle::findOrFail($id);
        $this->validate($request,[
            'nama' => "required|min:3|max:50",
            'alamat' => "required|min:3",
            'no_landasan' => "required|max:25",
            'no_mesin' => "required|max:20|unique:vehicles,no_mesin,".$kendaraan->id,
            'no_kendaraan' => "required|max:10|unique:vehicles,no_kendaraan,".$kendaraan->id,
            'merk_tipe_tahun' => "required|max:20",
            'jenis_kendaraan' => "required|max:20",
            'bahan_bakar' => "required|max:15",
            'nama_tester' => "required|min:3|max:50",
            'nip' => "required|min:3|max:25",
            'jabatan' => "required|max:20",
        ]);

        $kendaraan->nama = $request->nama;
        $kendaraan->alamat = $request->alamat;
        $kendaraan->no_landasan = $request->no_landasan;
        $kendaraan->no_mesin = $request->no_mesin;
        $kendaraan->no_kendaraan = $request->no_kendaraan;
        $kendaraan->merk_tipe_tahun = $request->merk_tipe_tahun;
        $kendaraan->jenis_kendaraan = $request->jenis_kendaraan;
        $kendaraan->bahan_bakar = $request->bahan_bakar;
        $kendaraan->save();

        $tester = TestingPerson::where('vehicle_id', $id)->firstOrFail();
        $tester->vehicle_id = $kendaraan->id;
        $tester->nama = $request->nama_tester;
        $tester->nip = $request->nip;
        $tester->jabatan = $request->jabatan;
        $tester->save();

        $urutantest = Test::where('vehicle_id', $id)->firstOrFail();
        $urutantest->vehicle_id = $kendaraan->id;
        // sementara sampe step diisi
        $urutantest->completed = 0;
        $urutantest->save();

        if(isset($request->step))
        {
            foreach ($request->step as $key => $values){
                foreach ($values as $val){
                    $result = new TestResult();
                    $result->check_id = $val;
                    $result->test_id = $urutantest->id;
                    $result->save();
                }
            }
        }

        $testResult = TestResult::where('test_id', $urutantest->id)->get();
        if(count($testResult) == 56)
        {
            $urutantest->completed = 1;
            $urutantest->save();
        }

        session()->flash('notif', 'Sukses, update data berhasil.');

        return redirect()->route('check.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasRole('admin')){
            return redirect('/');
        }
        // delete tabel vehicle
        DB::table('vehicles')->where('id', $id)->delete();
        // delete table testing person
        DB::table('testing_persons')->where('vehicle_id', $id)->delete();
        // get id from test
        $Test = Test::where('vehicle_id', $id)->first()->id;
        DB::table('test_results')->where('test_id', $Test)->delete();
        DB::table('tests')->where('vehicle_id', $id)->delete();

        session()->flash('notif', 'Sukses, data berhasil dihapus.');
        return redirect()->route('check.index');
    }
}
