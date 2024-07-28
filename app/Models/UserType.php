<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

     // Define the name of the table associated with this model.
     protected $table = 'usertypes';

     // A user type can be assigned to many users.
     public function users()
     {
         return $this->hasMany(User::class);
     }
}
