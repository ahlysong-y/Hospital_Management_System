<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'branch_id',
        'patient_id',
        'medical_record_id',
        'total_amount',
        'discount',
        'final_amount',
        'payment_status',
        'payment_method',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'discount'     => 'decimal:2',
        'final_amount'  => 'decimal:2',
    ];

    /**
     * អ្នកជំងឺដែលត្រូវបង់ប្រាក់
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * សាខាមន្ទីរពេទ្យ
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * សំណុំរឿងពិគ្រោះជំងឺ (បើមាន)
     */
    public function medicalRecord(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
