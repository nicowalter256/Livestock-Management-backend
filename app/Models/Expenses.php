<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExpenseTypes;

class Expenses extends Model
{
    use HasFactory;

    public function expenseTypes()
    {
        return $this->belongsTo(ExpenseTypes::class, 'expense_type_id');
    }
}
