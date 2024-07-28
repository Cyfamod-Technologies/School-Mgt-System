<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lga extends Model
{
    use HasFactory;

     // Define the name of the table associated with this model.
     protected $table = 'lgas';

     // An LGA belongs to a state.
     public function state()
     {
         return $this->belongsTo(State::class);
     }
}
