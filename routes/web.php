<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Dashboard (protected by auth & verified)
Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes - EVENT MANAGEMENT (Permission-Based)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // Event Export - Butuh Permission Spesifik
    Route::get('/events/export/excel', [\App\Http\Controllers\Admin\EventController::class, 'exportExcel'])
        ->middleware('permission:export_events')
        ->name('events.export.excel');
    
    Route::get('/events/export/pdf', [\App\Http\Controllers\Admin\EventController::class, 'exportPdf'])
        ->middleware('permission:export_events')
        ->name('events.export.pdf');
    
    // Event CRUD - Per Action Permission
    Route::get('/events', [\App\Http\Controllers\Admin\EventController::class, 'index'])
        ->middleware('permission:view_events')
        ->name('events.index');
    
    Route::get('/events/create', [\App\Http\Controllers\Admin\EventController::class, 'create'])
        ->middleware('permission:create_events')
        ->name('events.create');
    
    Route::post('/events', [\App\Http\Controllers\Admin\EventController::class, 'store'])
        ->middleware('permission:create_events')
        ->name('events.store');
    
    Route::get('/events/{event}', [\App\Http\Controllers\Admin\EventController::class, 'show'])
        ->middleware('permission:view_events')
        ->name('events.show');
    
    Route::get('/events/{event}/edit', [\App\Http\Controllers\Admin\EventController::class, 'edit'])
        ->middleware('permission:edit_events')
        ->name('events.edit');
    
    Route::put('/events/{event}', [\App\Http\Controllers\Admin\EventController::class, 'update'])
        ->middleware('permission:edit_events')
        ->name('events.update');
    
    Route::delete('/events/{event}', [\App\Http\Controllers\Admin\EventController::class, 'destroy'])
        ->middleware('permission:delete_events')
        ->name('events.destroy');

    // Registration Export - Butuh Permission Spesifik
    Route::get('registrations/export/excel', [\App\Http\Controllers\Admin\RegistrationController::class, 'exportExcel'])
        ->middleware('permission:export_registrations')
        ->name('registrations.export.excel');
    
    Route::get('registrations/export/pdf', [\App\Http\Controllers\Admin\RegistrationController::class, 'exportPdf'])
        ->middleware('permission:export_registrations')
        ->name('registrations.export.pdf');

    // Registration Management - Per Action Permission
    Route::get('registrations', [\App\Http\Controllers\Admin\RegistrationController::class, 'index'])
        ->middleware('permission:view_registrations')
        ->name('registrations.index');
    
    Route::get('registrations/{registration}', [\App\Http\Controllers\Admin\RegistrationController::class, 'show'])
        ->middleware('permission:view_registrations')
        ->name('registrations.show');
    
    Route::post('registrations/{registration}/approve', [\App\Http\Controllers\Admin\RegistrationController::class, 'approve'])
        ->middleware('permission:approve_registrations')
        ->name('registrations.approve');
    
    Route::post('registrations/{registration}/reject', [\App\Http\Controllers\Admin\RegistrationController::class, 'reject'])
        ->middleware('permission:reject_registrations')
        ->name('registrations.reject');
});

// Admin Routes - USER & ROLE MANAGEMENT (Super Admin Only)
Route::middleware(['auth', 'verified', 'role:super_admin'])->prefix('admin')->name('admin.')->group(function () {
    // User Management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    
    // Role Management
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
});

// Admin Routes - PAYMENT MANAGEMENT (Permission-Based)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // Payment Export - Butuh Permission Spesifik
    Route::get('payments/export/excel', [\App\Http\Controllers\Admin\PaymentController::class, 'exportExcel'])
        ->middleware('permission:export_payments')
        ->name('payments.export.excel');
    
    Route::get('payments/export/pdf', [\App\Http\Controllers\Admin\PaymentController::class, 'exportPdf'])
        ->middleware('permission:export_payments')
        ->name('payments.export.pdf');

    // Payment Management - Per Action Permission
    Route::get('payments', [\App\Http\Controllers\Admin\PaymentController::class, 'index'])
        ->middleware('permission:view_payments')
        ->name('payments.index');
    
    Route::get('payments/{payment}', [\App\Http\Controllers\Admin\PaymentController::class, 'show'])
        ->middleware('permission:view_payments')
        ->name('payments.show');
    
    Route::post('payments/{payment}/verify', [\App\Http\Controllers\Admin\PaymentController::class, 'verify'])
        ->middleware('permission:verify_payments')
        ->name('payments.verify');
    
    Route::post('payments/{payment}/reject', [\App\Http\Controllers\Admin\PaymentController::class, 'reject'])
        ->middleware('permission:verify_payments')
        ->name('payments.reject');
});

// Participant Routes
Route::middleware(['auth', 'verified', 'role:participant'])->prefix('participant')->name('participant.')->group(function () {
    // Events
    Route::get('events', [\App\Http\Controllers\Participant\EventController::class, 'index'])->name('events.index');
    Route::get('events/{event}', [\App\Http\Controllers\Participant\EventController::class, 'show'])->name('events.show');
    
    // Registrations
    Route::get('registrations', [\App\Http\Controllers\Participant\RegistrationController::class, 'index'])->name('registrations.index');
    Route::get('registrations/create/{event}', [\App\Http\Controllers\Participant\RegistrationController::class, 'create'])->name('registrations.create');
    Route::post('registrations/store/{event}', [\App\Http\Controllers\Participant\RegistrationController::class, 'store'])->name('registrations.store');
    Route::get('registrations/{registration}', [\App\Http\Controllers\Participant\RegistrationController::class, 'show'])->name('registrations.show');
    Route::get('registrations/{registration}/payment', [\App\Http\Controllers\Participant\RegistrationController::class, 'payment'])->name('registrations.payment');
    Route::post('registrations/{registration}/checkout', [\App\Http\Controllers\Participant\RegistrationController::class, 'checkout'])->name('registrations.checkout');
});

require __DIR__.'/auth.php';
