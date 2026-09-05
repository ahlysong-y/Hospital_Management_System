<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}


