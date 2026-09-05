<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Surgery extends Model
{
    protected $fillable = [
        'branch_id',
        'patient_id',
        'surgeon_id',
        'room_number',
        'scheduled_at',
        'pre_surgery_assessment',
        'status',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    /**
     * អ្នកជំងឺដែលត្រូវទទួលការវះកាត់
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * គ្រូពេទ្យវះកាត់
     */
    public function surgeon(): BelongsTo
    {
        return $this->belongsTo(User::class, 'surgeon_id');
    }

    /**
     * សាខាមន្ទីរពេទ្យ
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}

