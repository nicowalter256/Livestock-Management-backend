<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cattle;
use Carbon\Carbon;

class Inserminate extends Model
{
    use HasFactory;

    public function cattle()
    {
        return $this->belongsTo(Cattle::class, 'cattle_id');
    }

    protected $appends = ['expected_birth'];

    public function getExpectedBirthAttribute()
    {
        $date = Carbon::parse($this->attributes['insemination_date']);
        $daysToAdd = 283;
        $date = $date->addDays($daysToAdd);
        return $date;
    }
}
