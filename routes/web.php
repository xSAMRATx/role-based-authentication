<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/welcome', function () {
    return view('welcome');
});

// default routes
Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role->first()->name;
        return match ($role) {
            'admin' => redirect()->route('dashboard.admin'),
            'hr manager' => redirect()->route('dashboard.hr'),
            'employee' => redirect()->route('dashboard.employee'),
            default => redirect()->route('dashboard'),
        };
    }
    return redirect()->route('manual.login.form');
});

// Common dashboard
Route::middleware('auth')
    ->get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// Role-specific dashboards
Route::middleware(['auth', 'role:admin'])
    ->get('/dashboard/admin', [DashboardController::class, 'admin'])
    ->name('dashboard.admin');

Route::middleware(['auth', 'role:hr manager'])
    ->get('/dashboard/hr', [DashboardController::class, 'hr'])
    ->name('dashboard.hr');

Route::middleware(['auth', 'role:employee'])
    ->get('/dashboard/employee', [DashboardController::class, 'employee'])
    ->name('dashboard.employee');


// Guest Routes
Route::middleware('guest')->group(function () {
    // register
    Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('manual.register.form');
    Route::post('register', [RegisterController::class, 'register'])->name('register');

    // login
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('manual.login.form');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});

// logout
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:admin,hr manager,employee'])->group(function () {
    Route::get('my-profile', [EmployeeController::class, 'myProfile'])->name('myProfile');
});

Route::middleware(['auth', 'role:admin,hr manager'])->group(function () {
    Route::resource('employees', EmployeeController::class);
    Route::resource('tasks', TaskController::class)->except(['show']);
});

Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('my-tasks', [TaskController::class, 'myTasks'])->name('myTasks');
});



