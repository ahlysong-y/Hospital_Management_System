<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalRecord extends Model
{
    protected $fillable = [
        'branch_id',
        'patient_id',
        'doctor_id',
        'symptoms',
        'physical_examination',
        'treatment_plan',
        'record_type',
    ];

    /**
     * អ្នកជំងឺដែលជាម្ចាស់សំណុំរឿង
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * គ្រូពេទ្យដែលបានពិនិត្យ និងកត់ត្រា
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    /**
     * សាខាមន្ទីរពេទ្យ
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}

