<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class AdminStaff extends Authenticatable
{
    use  HasApiTokens, HasFactory, Notifiable;

    protected $hidden = [
        'password'
    ];
}
