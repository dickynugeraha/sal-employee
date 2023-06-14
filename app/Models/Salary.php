<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        "employee_id",
        "total_salary",
        "month",
        "year",
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
