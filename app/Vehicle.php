<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'nama',
        'alamat',
        'no_landasan',
        'no_mesin',
        'no_kendaraan',
        'merk_tipe_tahun',
        'jenis_kendaraan',
        'bahan_bakar',
    ];

    public function TestingPerson()
    {
        return $this->belongsTo(TestingPerson::class, 'testing_persons');
    }
}
