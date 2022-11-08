<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cattle;

class Milk extends Model
{
    use HasFactory;

    protected $fillable = [
        'milking_date', 'total_milk', 'description', 'cattle_id', 'id'
    ];

    public function cattle()
    {
        return $this->belongsTo(Cattle::class, 'cattle_id');
    }
}
