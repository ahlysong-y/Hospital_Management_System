<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftHandover extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * ទំនាក់ទំនងទៅកាន់បុគ្គលិកដែលជាអ្នកប្រគល់វេន (from_user_id)
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
     * ទំនាក់ទំនងទៅកាន់បុគ្គលិកដែលជាអ្នកទទួលវេន (to_user_id)
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    /**
     * ទំនាក់ទំនងទៅកាន់សាខាមន្ទីរពេទ្យ (branch_id)
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
