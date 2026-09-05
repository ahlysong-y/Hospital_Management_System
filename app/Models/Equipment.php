<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    // កំណត់ឈ្មោះតារាងអោយត្រូវគ្នាជាមួយ Migration
    protected $table = 'equipments';

    protected $guarded = [];

    // ឧបករណ៍ស្ថិតនៅសាខាណា
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // ឧបករណ៍ស្ថិតនៅផ្នែកណា
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
