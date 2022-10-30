<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cattle;

class Calfs extends Model
{
    use HasFactory;


    public function cattle()
    {
        return $this->belongsTo(Cattle::class);
    }

    public function getCattleImageAttribute($value)
    {
        return  asset($value);
    }
}
