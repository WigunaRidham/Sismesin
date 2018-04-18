<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    public function step() {
        return $this->belongsTo(Check::class);
    }
}
