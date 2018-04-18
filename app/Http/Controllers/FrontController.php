<?php

namespace App\Http\Controllers;

use App\Check;
use App\Test;
use App\TestingPerson;
use App\TestResult;
use App\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function findVehicle(Request $request)
    {
        $this->validate($request,[
            'no_kendaraan' => "required"
        ]);
        $nomer = $request->no_kendaraan;
        $vehicle = DB::table('vehicles')
            ->where('no_kendaraan', $nomer)
            ->join('testing_persons', 'vehicles.id', '=', 'testing_persons.vehicle_id')
            ->join('tests', 'vehicles.id', '=', 'tests.vehicle_id')
            ->select('vehicles.*', 'testing_persons.nama as nama_penguji', 'tests.completed as status')
            ->limit(1)
            ->get();

        $kendaraan = Vehicle::where('no_kendaraan', $request->no_kendaraan)->first();

        $notComplete="";
        $message="";
        if(count($kendaraan) > 0)
        {
            $test = Test::where('vehicle_id',$kendaraan->id)->first();
            $testResult = TestResult::where('test_id', $test->id)->get();

            $check = Check::all();
            $notComplete = array();
            foreach ($check as $cek){
                if(!$testResult->contains('check_id', $cek->id)){
                    $notComplete[] = $cek;
                }
            }

            $now = Carbon::now();

            $created = new Carbon($vehicle[0]->created_at);
            $diff = $created->diffInDays($now);
            $tgl = $created->addDays(7)->format('d-m-Y');

            if($test->completed == 0 && $diff > 7)
            {
                $denda = ($diff - 7) * 3000;
                $message = "Batas waktu pengecekan telah lewat dari " .($diff - 7)." hari terhitung sejak tanggal ". $tgl.
                    ", dikenakan Denda Sebesar Rp. ".$denda.
                    "<br/>".
                    "Harap lakukan pengecekan ulang segera.";
            }

        }
        return view('welcome', ['vehicle'=> $vehicle, 'notComplete'=>$notComplete, 'message' => $message]);
    }

    public function cetakLaporan($id)
    {
        $kendaraan = Vehicle::where('id', $id)->first();
        $test = Test::where('vehicle_id', $id)->first();
        $tester = TestingPerson::where('vehicle_id', $id)->first();

        if(count($kendaraan) > 0) {
            $test = Test::where('vehicle_id', $kendaraan->id)->first();
            $testResult = TestResult::where('test_id', $test->id)->get();

            $check = Check::all();
            $notComplete = array();
            foreach ($check as $cek) {
                if (!$testResult->contains('check_id', $cek->id)) {
                    $notComplete[] = $cek;
                }
            }
        }
        return view('cetak.cetaklaporan', ['vehicle'=> $kendaraan, 'test'=>$test, 'tester'=>$tester, 'notComplete'=>$notComplete]);
    }

    public function cetakHistory()
    {
        $vehicles = DB::table('vehicles')
            ->join('testing_persons', 'vehicles.id', '=', 'testing_persons.vehicle_id')
            ->join('tests', 'vehicles.id', '=', 'tests.vehicle_id')
            ->select('vehicles.*', 'testing_persons.nama as nama_penguji', 'tests.completed as status')
            ->get();
        return view('cetak.history', ['vehicles'=>$vehicles]);
    }
}
