<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    public function checks() {
        return $this->hasMany(Check::class);
    }
}
