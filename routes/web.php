<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ShiftHandoverController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\SurgeryController;
use App\Http\Controllers\NursingLogController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CalendarController;

/*
|--------------------------------------------------------------------------
| Web Routes - SmartCare Hospital Management System
|--------------------------------------------------------------------------
*/

// Language Switcher Route
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

// Redirect ពី Homepage ទៅកាន់ Dashboard ឬ Login
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    // 0. Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Calendar & Real-Time Clock (កាលវិភាគ & នាឡិកា)
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');

    // Profile Management (Admin / User Profile)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/photo', [ProfileController::class, 'destroyPhoto'])->name('profile.photo.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // System Settings (ការកំណត់ប្រព័ន្ធ)
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // 1. គ្រប់គ្រងអ្នកជំងឺ (Patient Management)
    Route::resource('patients', PatientController::class);

    // 2. គ្រប់គ្រងការប្រគល់-ទទួលវេន (Shift Handovers)
    Route::resource('handovers', ShiftHandoverController::class);

    // 3. ពិគ្រោះជំងឺក្រៅ (OPD Medical Records)
    Route::resource('medical-records', MedicalRecordController::class);

    // 4. ប្រតិបត្តិការ និងកាលវិភាគវះកាត់ (Surgery Management)
    Route::resource('surgeries', SurgeryController::class);
    Route::patch('surgeries/{surgery}/status', [SurgeryController::class, 'updateStatus'])->name('surgeries.update-status');

    // 5. កំណត់ត្រាថែទាំរបស់គិលានុបដ្ឋាយិកា (Nursing Logs)
    Route::resource('nursing-logs', NursingLogController::class);

    // 6. ផ្នែកសង្គ្រោះបន្ទាន់ និងឧបករណ៍ពេទ្យ (ER & Equipment Management)
    Route::resource('equipments', EquipmentController::class);
    Route::patch('equipments/{equipment}/status', [EquipmentController::class, 'updateStatus'])->name('equipments.update-status');

    // 7. ចេញវិក្កយបត្រ និងទូទាត់ប្រាក់ (Billing & Invoices)
    Route::resource('invoices', InvoiceController::class);
    Route::patch('invoices/{invoice}/status', [InvoiceController::class, 'updateStatus'])->name('invoices.update-status');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Laravel Breeze / Fortify)
|--------------------------------------------------------------------------
*/
if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}
