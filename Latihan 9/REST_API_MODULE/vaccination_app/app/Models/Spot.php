<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;

    public function spotVaccine () {
        return $this->hasMany(SpotVaccine::class, 'spot_id', 'id');
    }

    public function vaccination(){
        return $this->hasMany(Vaccination::class, 'spot_id', 'id');
    }

}
