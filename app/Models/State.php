<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

     // Define the name of the table associated with this model.
     protected $table = 'states';

     // A state can have many local government areas (LGAs).
     public function lgas()
     {
         return $this->hasMany(Lga::class);
     }
}
