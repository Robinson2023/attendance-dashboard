<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WorkLogController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\AttendanceDashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\MealExpenseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('auth.login'); // 👈 Muestra tu login directamente
});

Route::resource('contracts', ContractController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/asistencias/mapa', [\App\Http\Controllers\AttendanceMapController::class, 'index'])
        ->name('attendance.map');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('employees', EmployeeController::class);

Route::resource('projects', ProjectController::class)->except(['show']);

Route::resource('worklogs', WorkLogController::class)->except(['show']);

Route::get('/worklogs/report', [App\Http\Controllers\WorkLogController::class, 'report'])
     ->name('worklogs.report');

Route::resource('contracts', ContractController::class);

Route::get('/projects/financial', [ProjectController::class, 'financial'])
    ->name('projects.financial');

Route::resource('attendances', AttendanceController::class);
Route::get('/attendance', [AttendanceDashboardController::class, 'index'])->name('attendance.index');


Route::get('payroll', [PayrollController::class, 'index'])->name('payroll.index');
Route::post('payroll/generate/{date}', [PayrollController::class, 'generateDaily'])
        ->name('payroll.generate');

Route::get('/dashboard/attendance',
[AttendanceDashboardController::class, 'index'])
->name('dashboard.attendance');

Route::resource('materials', MaterialController::class);

Route::resource('transports', TransportController::class)->except(['show', 'edit', 'update']);

Route::resource('meals', MealExpenseController::class)->except(['show', 'edit', 'update']);

Route::get('/calendar', [EventController::class, 'calendar'])->name('events.calendar');
Route::resource('events', EventController::class);

Route::post('/events/store-ajax', [App\Http\Controllers\EventController::class, 'storeAjax'])->name('events.storeAjax');

Route::post('/attendances/permission/{id}', [AttendanceDashboardController::class, 'updatePermission'])
    ->name('attendances.permission.update');

require __DIR__.'/auth.php';
