<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('admin/profile', [AdminController::class, 'admin_profile']);
    Route::post('admin_profile/update', [AdminController::class, 'update']);

    Route::get('admin/users', [AdminController::class, 'admin_users']);

    Route::get('admin/users/add', [AdminController::class, 'admin_add_users']);
    Route::post('admin/users/add', [AdminController::class, 'admin_add_users_store']);

    Route::get('admin/users/view/{id}', [AdminController::class, 'view']);
    Route::get('admin/users/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/users/edit/{id}', [AdminController::class, 'edit_post']);
    Route::get('admin/users/delete/{id}', [AdminController::class, 'admin_soft_delete']);

    Route::get('admin/email/compose', [EmailController::class, 'email_compose']);
    Route::get('admin/email/sent', [EmailController::class, 'email_sent']);
    Route::get('admin/email_sent', [EmailController::class, 'email_sent_delete']);
    Route::get('admin/email/read/{id}', [EmailController::class, 'email_read']);
    Route::get('admin/email/read_delete/{id}', [EmailController::class, 'email_read_delete']);
    Route::post('admin/email/post', [EmailController::class, 'email_post']);

});

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');

});

Route::get('set_new_password/{token}', [AdminController::class, 'set_new_password']);
Route::post('set_new_password/{token}', [AdminController::class, 'set_new_password_post']);

Route::get('admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
