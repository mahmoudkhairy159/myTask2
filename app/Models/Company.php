<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function notes()
    {
        return $this->morphMany(Note::class, 'notable');
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
