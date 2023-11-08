<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function notes()
    {
        return $this->morphMany(Note::class, 'notable');
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function getFullnameAttribute()
    {
        return $this->attributes['firstName'] . ' ' . $this->attributes['lastName'];
    }
}
