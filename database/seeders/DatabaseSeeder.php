<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Department;
use App\Models\User;
use App\Models\Patient;
use App\Models\Equipment;
use App\Models\MedicalRecord;
use App\Models\ShiftHandover;
use App\Models\Surgery;
use App\Models\NursingLog;
use App\Models\Meeting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $branchPhnomPenh = Branch::create([
            'name' => 'មន្ទីរពេទ្យស្មាតឃែរ សាខាកណ្តាល (ភ្នំពេញ)',
            'location' => 'រាជធានីភ្នំពេញ',
            'contact_number' => '023 888 999',
        ]);

        $branchSiemReap = Branch::create([
            'name' => 'មន្ទីរពេទ្យស្មាតឃែរ សាខាសៀមរាប',
            'location' => 'ខេត្តសៀមរាប',
            'contact_number' => '063 777 888',
        ]);

        $deptOPD = Department::create([
            'branch_id' => $branchPhnomPenh->id,
            'name' => 'ផ្នែកពិគ្រោះជំងឺក្រៅ (OPD)',
            'description' => 'ពិនិត្យ និងព្យាបាលជំងឺក្រៅទូទៅ',
        ]);

        $deptER = Department::create([
            'branch_id' => $branchPhnomPenh->id,
            'name' => 'ផ្នែកសង្គ្រោះបន្ទាន់ (Emergency Room - ER)',
            'description' => 'សង្គ្រោះអ្នកជំងឺបន្ទាន់ ២៤/៧',
        ]);

        $deptSurgery = Department::create([
            'branch_id' => $branchPhnomPenh->id,
            'name' => 'ផ្នែកវះកាត់ (Surgery)',
            'description' => 'ប្រតិបត្តិការវះកាត់ និងថែទាំក្រោយវះកាត់',
        ]);

        $deptNursing = Department::create([
            'branch_id' => $branchPhnomPenh->id,
            'name' => 'ផ្នែកគិលានុបដ្ឋាយិកា (Nursing)',
            'description' => 'ការថែទាំអ្នកជំងឺ និងគ្រប់គ្រងឱសថ',
        ]);

        $admin = User::create([
            'branch_id' => $branchPhnomPenh->id,
            'department_id' => null,
            'name' => 'អ្នកគ្រប់គ្រងប្រព័ន្ធ (Admin)',
            'email' => 'admin@smartcare.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone_number' => '012 111 222',
        ]);

        $doctorOPD = User::create([
            'branch_id' => $branchPhnomPenh->id,
            'department_id' => $deptOPD->id,
            'name' => 'វេជ្ជបណ្ឌិត សុខ ចាន់ថា',
            'email' => 'doctor.opd@smartcare.com',
            'password' => Hash::make('password123'),
            'role' => 'doctor',
            'phone_number' => '012 333 444',
        ]);

        $doctorSurgeon = User::create([
            'branch_id' => $branchPhnomPenh->id,
            'department_id' => $deptSurgery->id,
            'name' => 'វេជ្ជបណ្ឌិត កែវ វិចិត្រ (គ្រូពេទ្យវះកាត់)',
            'email' => 'surgeon@smartcare.com',
            'password' => Hash::make('password123'),
            'role' => 'doctor',
            'phone_number' => '012 555 666',
        ]);

        $nurse1 = User::create([
            'branch_id' => $branchPhnomPenh->id,
            'department_id' => $deptNursing->id,
            'name' => 'គិលានុបដ្ឋាយិកា គឹម សុផល',
            'email' => 'nurse1@smartcare.com',
            'password' => Hash::make('password123'),
            'role' => 'nurse',
            'phone_number' => '012 777 888',
        ]);

        $nurse2 = User::create([
            'branch_id' => $branchPhnomPenh->id,
            'department_id' => $deptNursing->id,
            'name' => 'គិលានុបដ្ឋាយិកា លី ស្រីម៉ុច',
            'email' => 'nurse2@smartcare.com',
            'password' => Hash::make('password123'),
            'role' => 'nurse',
            'phone_number' => '012 999 000',
        ]);

        $patient1 = Patient::create([
            'branch_id' => $branchPhnomPenh->id,
            'name' => 'ស៊ន វណ្ណៈ',
            'gender' => 'male',
            'date_of_birth' => '1992-05-15',
            'phone_number' => '097 111 2233',
            'address' => 'ខណ្ឌទួលគោក រាជធានីភ្នំពេញ',
        ]);

        $patient2 = Patient::create([
            'branch_id' => $branchPhnomPenh->id,
            'name' => 'មាស សុខា',
            'gender' => 'female',
            'date_of_birth' => '1988-10-20',
            'phone_number' => '088 444 5566',
            'address' => 'ខណ្ឌចំការមន រាជធានីភ្នំពេញ',
        ]);

        ShiftHandover::create([
            'branch_id' => $branchPhnomPenh->id,
            'from_user_id' => $nurse1->id,
            'to_user_id' => $nurse2->id,
            'handover_notes' => 'អ្នកជំងឺ ស៊ន វណ្ណៈ ផ្ញើតាមដានសម្ពាធឈាមរៀងរាល់ ២ម៉ោងម្តង និងបានផ្តល់ថ្នាំរួចរាល់នៅម៉ោង ៨ព្រឹក។',
            'handover_time' => now(),
        ]);

        MedicalRecord::create([
            'branch_id' => $branchPhnomPenh->id,
            'patient_id' => $patient1->id,
            'doctor_id' => $doctorOPD->id,
            'symptoms' => 'ក្តៅខ្លួនខ្លាំង ក្អក និងឈឺក្បាលរយៈពេល ២ថ្ងៃ',
            'physical_examination' => 'សីតុណ្ហភាព ៣៨.៥°C សម្ពាធឈាម ១២០/៨០ mmHg',
            'treatment_plan' => 'ផ្តល់ថ្នាំប៉ារ៉ាសេតាម៉ុល និងថ្នាំប្រឆាំងមេរោគ អោយសម្រាកព្យាបាលនៅផ្ទះ ៣ថ្ងៃ',
            'record_type' => 'OPD',
        ]);

        Equipment::create([
            'branch_id' => $branchPhnomPenh->id,
            'department_id' => $deptER->id,
            'name' => 'ម៉ាស៊ីនជំនួយដកដង្ហើម (Ventilator Model-X)',
            'status' => 'functional',
            'last_checked_at' => now(),
        ]);

        Equipment::create([
            'branch_id' => $branchPhnomPenh->id,
            'department_id' => $deptSurgery->id,
            'name' => 'អំពូលភ្លើងបន្ទប់វះកាត់ (Surgical Light System)',
            'status' => 'functional',
            'last_checked_at' => now(),
        ]);

        Surgery::create([
            'branch_id' => $branchPhnomPenh->id,
            'patient_id' => $patient2->id,
            'surgeon_id' => $doctorSurgeon->id,
            'room_number' => 'OR-102',
            'scheduled_at' => now()->addDays(2),
            'pre_surgery_assessment' => 'អ្នកជំងឺបានពិនិត្យឈាម និងអេកូបង្ហើយ រួចរាល់សម្រាប់ដំណើរការវះកាត់។',
            'status' => 'pending',
        ]);

        NursingLog::create([
            'branch_id' => $branchPhnomPenh->id,
            'patient_id' => $patient1->id,
            'nurse_id' => $nurse1->id,
            'medication_setup' => 'រៀបចំសេរ៉ូម និងថ្នាំ Paracetamol 500mg',
            'monitoring_notes' => 'សីតុណ្ហភាពថយចុះមកត្រឹម ៣៧.២°C ស្ថានភាពអ្នកជំងឺធូរស្រាល',
            'admin_tasks' => 'កត់ត្រាចូលប្រព័ន្ធ និងសហការជាមួយផ្នែក OPD',
        ]);

        Meeting::create([
            'branch_id' => $branchPhnomPenh->id,
            'title' => 'ប្រជុំពិភាក្សាក្រុមការងារគ្រូពេទ្យប្រចាំសប្តាហ៍',
            'description' => 'ពិភាក្សាអំពីករណីជំងឺធ្ងន់ធ្ងរ និងការបែកចែកវេនការងារថ្មី',
            'meeting_at' => now()->addDays(1),
        ]);

        \App\Models\Invoice::create([
            'invoice_number' => 'INV-' . date('Ymd') . '-1001',
            'branch_id' => $branchPhnomPenh->id,
            'patient_id' => $patient1->id,
            'medical_record_id' => null,
            'total_amount' => 45.00,
            'discount' => 5.00,
            'final_amount' => 40.00,
            'payment_status' => 'paid',
            'payment_method' => 'ABA / KHQR',
            'notes' => 'ថ្លៃពិគ្រោះជំងឺក្រៅ OPD និងថ្នាំពេទ្យ',
        ]);
    }

}
