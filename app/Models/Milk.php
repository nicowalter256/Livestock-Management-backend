<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milk extends Model
{
    use HasFactory;

    protected $fillable = [
        'milking_date', 'total_milk', 'description', 'cattle_id'
    ];
}
