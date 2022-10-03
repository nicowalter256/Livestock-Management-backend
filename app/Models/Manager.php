<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Manager extends Authenticatable
{
    use  HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email', 'phone_contact', 'password', 'firstname', 'lastname', 'business_name'
    ];

    protected $hidden = ['email_verified_at', 'phone_verified_at', 'password', 'created_at', 'deleted_at', 'updated_at'];


    /**
     * Encrypt the customer password before saving
     * @param String $password Password to be encrypted
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password, [
            'rounds' => 12,
        ]);
    }
}
