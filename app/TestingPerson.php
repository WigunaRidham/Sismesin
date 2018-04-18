<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestingPerson extends Model
{
    protected $table = 'testing_persons';
    //


    public function Vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
