<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. តារាងសាខាមន្ទីរពេទ្យ (Branches)
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->string('contact_number')->nullable();
            $table->timestamps();
        });

        // 2. តារាងផ្នែកការងារ (Departments) - OPD, ER, Surgeon, Nursing
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // e.g., 'OPD', 'Emergency Room', 'Surgery', 'Nursing'
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 3. បន្ថែម Column ទៅលើតារាងបុគ្គលិកដែលមានស្រាប់ (Users / Staffs)
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->after('branch_id')->constrained()->nullOnDelete();
            $table->string('role')->default('doctor')->after('password'); // e.g., 'doctor', 'nurse', 'admin', 'receptionist'
            $table->string('phone_number')->nullable()->after('role');
        });

        // 4. តារាងអ្នកជំងឺ (Patients)
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('date_of_birth')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });

        // 5. តារាងរបាយការណ៍ប្រគល់វេនការងារ (Shift Handovers)
        Schema::create('shift_handovers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('from_user_id')->constrained('users')->cascadeOnDelete(); // អ្នកប្រគល់វេន
            $table->foreignId('to_user_id')->constrained('users')->cascadeOnDelete();   // អ្នកទទួលវេន
            $table->text('handover_notes')->nullable(); // កំណត់ត្រាប្រគល់វេន
            $table->timestamp('handover_time');
            $table->timestamps();
        });

        // 6. តារាងសំណុំរឿង និងប្រវត្តិព្យាបាលអ្នកជំងឺ (Medical Records / OPD)
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained('users')->cascadeOnDelete(); // គ្រូពេទ្យពិនិត្យ
            
            $table->text('symptoms')->nullable(); // ពិនិត្យសំណុំរឿង/រោគសញ្ញា
            $table->text('physical_examination')->nullable(); // ពិនិត្យរាងកាយ
            $table->text('treatment_plan')->nullable(); // កែសម្រួលការព្យាបាល
            $table->string('record_type')->default('OPD'); // OPD ឬ ទូទៅ
            $table->timestamps();
        });

        // 7. តារាងឧបករណ៍ពេទ្យ (Equipments)
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete(); // ឧទាហរណ៍៖ ឧបករណ៍នៅផ្នែក ER
            $table->string('name'); // ឈ្មោះឧបករណ៍សង្គ្រោះជីវិត/វេជ្ជសាស្ត្រ
            $table->string('status')->default('functional'); // ស្ថានភាព៖ functional, maintenance, critical
            $table->timestamp('last_checked_at')->nullable(); // ពិនិត្យឧបករណ៍
            $table->timestamps();
        });

        // 8. តារាងគ្រប់គ្រងការវះកាត់ (Surgeries)
        Schema::create('surgeries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('surgeon_id')->constrained('users')->cascadeOnDelete(); // គ្រូពេទ្យវះកាត់
            
            $table->string('room_number'); // ត្រៀមបន្ទប់វះកាត់
            $table->dateTime('scheduled_at'); // កាលវិភាគវះកាត់
            $table->text('pre_surgery_assessment')->nullable(); // សួរសុខទុក្ខមុនវះកាត់
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending'); // ចាប់ផ្តើមប្រតិបត្តិការ
            $table->timestamps();
        });

        // 9. តារាងកំណត់ត្រាថែទាំរបស់គិលានុបដ្ឋាយិកា (Nursing Logs)
        Schema::create('nursing_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('nurse_id')->constrained('users')->cascadeOnDelete(); // គិលានុបដ្ឋាយិកា
            
            $table->text('medication_setup')->nullable(); // ការរៀបចំឱសថ និងឧបករណ៍
            $table->text('monitoring_notes')->nullable(); // ការចុះថែទាំ និងតាមដានអ្នកជំងឺ
            $table->text('admin_tasks')->nullable(); // កិច្ចសហការ និងការងាររដ្ឋបាល
            $table->timestamps();
        });

        // 10. តារាងប្រជុំពិភាក្សា (Meetings)
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->string('title'); // ឧទាហរណ៍៖ ប្រជុំពិភាក្សាការព្យាបាល
            $table->text('description')->nullable();
            $table->dateTime('meeting_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
        Schema::dropIfExists('nursing_logs');
        Schema::dropIfExists('surgeries');
        Schema::dropIfExists('equipments');
        Schema::dropIfExists('medical_records');
        Schema::dropIfExists('shift_handovers');
        Schema::dropIfExists('patients');
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropForeign(['department_id']);
            $table->dropColumn(['branch_id', 'department_id', 'role', 'phone_number']);
        });

        Schema::dropIfExists('departments');
        Schema::dropIfExists('branches');
    }
};