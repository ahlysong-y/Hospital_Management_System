<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * បង្ហាញទំព័រកំណត់ប្រព័ន្ធ ( Display System Settings Page )
     */
    public function index()
    {
        $settings = [
            'hospital_name'          => Setting::get('hospital_name', 'មន្ទីរពេទ្យស្មាតឃែរ (SmartCare Hospital)'),
            'hospital_phone'         => Setting::get('hospital_phone', '023 888 999 / 012 111 222'),
            'hospital_email'         => Setting::get('hospital_email', 'info@smartcare-hospital.com'),
            'hospital_address'       => Setting::get('hospital_address', 'មហាវិថីព្រះមុនីវង្ស រាជធានីភ្នំពេញ ព្រះរាជាណាចក្រកម្ពុជា'),
            'emergency_contact'      => Setting::get('emergency_contact', '119 / 012 999 888'),
            'currency_symbol'        => Setting::get('currency_symbol', '$'),
            'exchange_rate'          => Setting::get('exchange_rate', '4100'),
            'tax_percentage'         => Setting::get('tax_percentage', '0'),
            'invoice_footer_note'    => Setting::get('invoice_footer_note', 'សូមអរគុណសម្រាប់ការជឿទុកចិត្តលើសេវាថែទាំសុខភាពរបស់មន្ទីរពេទ្យស្មាតឃែរ!'),
            'enable_surgery_alerts'  => Setting::get('enable_surgery_alerts', '1'),
            'enable_handover_alerts' => Setting::get('enable_handover_alerts', '1'),
            'enable_equipment_alerts'=> Setting::get('enable_equipment_alerts', '1'),
        ];

        $branches = Branch::with('departments')->get();
        $departments = Department::with('branch')->get();

        return view('settings.index', compact('settings', 'branches', 'departments'));
    }

    /**
     * រក្សាទុក ឬ ធ្វើបច្ចុប្បន្នភាពការកំណត់ប្រព័ន្ធ ( Update System Settings )
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'hospital_name'          => ['nullable', 'string', 'max:255'],
            'hospital_phone'         => ['nullable', 'string', 'max:255'],
            'hospital_email'         => ['nullable', 'email', 'max:255'],
            'hospital_address'       => ['nullable', 'string', 'max:500'],
            'emergency_contact'      => ['nullable', 'string', 'max:255'],
            'currency_symbol'        => ['nullable', 'string', 'max:10'],
            'exchange_rate'          => ['nullable', 'numeric', 'min:0'],
            'tax_percentage'         => ['nullable', 'numeric', 'min:0', 'max:100'],
            'invoice_footer_note'    => ['nullable', 'string', 'max:1000'],
            'enable_surgery_alerts'  => ['nullable', 'boolean'],
            'enable_handover_alerts' => ['nullable', 'boolean'],
            'enable_equipment_alerts'=> ['nullable', 'boolean'],
        ]);

        // Process checkboxes that might not be sent when unchecked
        $checkboxes = ['enable_surgery_alerts', 'enable_handover_alerts', 'enable_equipment_alerts'];
        foreach ($checkboxes as $cb) {
            $validated[$cb] = $request->has($cb) ? '1' : '0';
        }

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('settings.index')
            ->with('success', 'បានធ្វើបច្ចុប្បន្នភាពការកំណត់ប្រព័ន្ធដោយជោគជ័យ!');
    }
}
