<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    public function validation()
    {
        $validate = [
            'disease_history' => 'required|string',
            'current_symptoms' => 'required|string'
        ];

        return $validate;
    }

    public function doctor () {
        return $this->belongsTo(Medical::class, 'doctor_id', 'id');
    }
}
