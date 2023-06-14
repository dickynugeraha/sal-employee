<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        "nik",
        "name",
        "email",
        "address",
        "age",
        "bank",
        "no_rekening",
        "basic_salary",
        "photo",
        "position_id",
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function salary()
    {
        return $this->hasMany(Salary::class);
    }
}
