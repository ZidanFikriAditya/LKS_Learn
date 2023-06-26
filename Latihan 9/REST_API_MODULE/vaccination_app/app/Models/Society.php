<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    use HasFactory;

    function regional()
    {
        return $this->belongsTo(Regional::class, 'regional_id', 'id');
    }
}
