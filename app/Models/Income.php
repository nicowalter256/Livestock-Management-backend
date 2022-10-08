<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IncomeType;

class Income extends Model
{
    use HasFactory;

    public function incomeTypes()
    {
        return $this->belongsTo(IncomeType::class, 'income_type_id');
    }
}
