<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    // Define the name of the table associated with this model.
    protected $table = 'users';

    // A user belongs to a blood group.
    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class, 'bg_id');
    }

    // A user belongs to a state.
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    // A user belongs to an LGA.
    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }

    // A user belongs to a country.
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // A user has one user type.
    public function userType()
    {
        return $this->belongsTo(UserType::class, 'usertype_id');
    }
}
