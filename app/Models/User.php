<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'branch_id',
        'department_id',
        'name',
        'email',
        'password',
        'role',
        'phone_number',
        'profile_photo',
    ];

    // ទំនាក់ទំនង៖ User ស្ថិតនៅសាខាណា
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // ទំនាក់ទំនង៖ User ស្ថិតនៅផ្នែកណា
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // ទំនាក់ទំនង៖ គ្រូពេទ្យពិនិត្យជំងឺបានច្រើនដង
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'doctor_id');
    }

    // ទំនាក់ទំនង៖ គ្រូពេទ្យវះកាត់
    public function surgeries()
    {
        return $this->hasMany(Surgery::class, 'surgeon_id');
    }

    // ឈ្មោះតួនាទី (Role Title Translated)
    public function getRoleNameAttribute()
    {
        return match(strtolower($this->role ?? '')) {
            'admin' => __('អ្នកគ្រប់គ្រងប្រព័ន្ធ'),
            'doctor' => __('វេជ្ជបណ្ឌិត / គ្រូពេទ្យ'),
            'nurse' => __('គិលានុបដ្ឋាយិកា'),
            'pharmacist' => __('ឱសថការី'),
            'receptionist' => __('បុគ្គលិកទទួលភ្ញៀវ'),
            'accountant' => __('គណនេយ្យករ'),
            default => __('បុគ្គលិកសុខាភិបាល'),
        };
    }

    // អាសយដ្ឋាន URL រូបថត Profile (ឬ Fallback Avatar ស្អាត)
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->profile_photo)) {
            return asset('storage/' . $this->profile_photo);
        }

        if (strtolower($this->role ?? '') === 'doctor') {
            return asset('images/doctor-avatar.png');
        }

        return asset('images/default-avatar.png');
    }
}
