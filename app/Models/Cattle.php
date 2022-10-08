<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CattleBreed;
use Carbon\Carbon;

class Cattle extends Model
{
    use HasFactory;

    protected $casts = [
        'gender' => 'string',
    ];
    protected $appends = ['age'];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['date_of_birth'])->age;
    }

    public function getCattleImageAttribute($value)
    {
        return  asset($value);
    }
    public function getGenderAttribute($value)
    {
        return  ucfirst($value);
    }
    public function breed()
    {
        return $this->belongsTo(CattleBreed::class, 'cattle_breed_id');
    }
}
