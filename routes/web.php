<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClientController;

// Strona główna
Route::get('/', function () {
    return view('welcome'); // Strona powitalna
})->name('home');

// Logowanie i wylogowanie
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login-form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rejestracja użytkownika
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register-form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Panel administratora
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard'); // Widok dashboardu admina
    })->name('admin');

    Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles'); // Endpoint tylko dla admina
});

// Panel pracownika
Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/employee', function () {
        return view('employee.dashboard'); // Widok dashboardu pracownika
    })->name('employee');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('employee.appointments'); // Pracownik widzi wizyty
});

// Panel klienta
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client', [ClientController::class, 'index'])->name('client.dashboard');
    Route::get('/client/appointments', [ClientController::class, 'showAppointments'])->name('client.appointments');
    Route::get('/client/appointments/create', [ClientController::class, 'createAppointment'])->name('client.appointments.create');
    Route::post('/client/appointments/store', [ClientController::class, 'storeAppointment'])->name('client.appointments.store');
    Route::get('/client/appointments/{appointment}/edit', [ClientController::class, 'editAppointment'])->name('client.appointments.edit');
    Route::put('/client/appointments/{appointment}', [ClientController::class, 'updateAppointment'])->name('client.appointments.update');
    Route::delete('/client/appointments/{appointment}', [ClientController::class, 'destroyAppointment'])->name('client.appointments.destroy');
});

// Ogólnodostępne API
Route::get('/users', [UserController::class, 'index'])->name('api.users');
Route::get('/services', [ServiceController::class, 'index'])->name('api.services');
Route::get('/employees', [EmployeeController::class, 'index'])->name('api.employees');
