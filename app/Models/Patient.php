<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];

    // អ្នកជំងឺស្ថិតនៅសាខាណា
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // ប្រវត្តិព្យាបាលទាំងអស់របស់អ្នកជំងឺ
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    // កាលវិភាគវះកាត់របស់អ្នកជំងឺ
    public function surgeries()
    {
        return $this->hasMany(Surgery::class);
    }

    // កំណត់ត្រាថែទាំរបស់អ្នកជំងឺ
    public function nursingLogs()
    {
        return $this->hasMany(NursingLog::class);
    }

    // វិក្កយបត្ររបស់អ្នកជំងឺ
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}

