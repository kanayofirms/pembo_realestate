<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserTimeController;
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

    Route::post('admin/users/update', [AdminController::class, 'admin_users_update']);
    Route::get('admin/users/changeStatus', [AdminController::class, 'admin_users_changeStatus']);

    Route::get('admin/email/compose', [EmailController::class, 'email_compose']);
    Route::get('admin/email/sent', [EmailController::class, 'email_sent']);
    Route::get('admin/email_sent', [EmailController::class, 'email_sent_delete']);
    Route::get('admin/email/read/{id}', [EmailController::class, 'email_read']);
    Route::get('admin/email/read_delete/{id}', [EmailController::class, 'email_read_delete']);
    Route::post('admin/email/post', [EmailController::class, 'email_post']);

    Route::get('admin/my_profile', [AdminController::class, 'my_profile']);
    Route::post('admin/my_profile/update', [AdminController::class, 'my_profile_update']);

    // User Week Start
    Route::get('admin/week', [UserTimeController::class, 'week_list']);
    Route::get('admin/week/add', [UserTimeController::class, 'week_add']);
    Route::post('admin/week/add', [UserTimeController::class, 'week_store']);
    Route::get('admin/week/edit/{id}', [UserTimeController::class, 'week_edit']);
    Route::post('admin/week/edit/{id}', [UserTimeController::class, 'week_update']);
    Route::get('admin/week/delete/{id}', [UserTimeController::class, 'week_delete']);
    // User Week End

    // Week Time Start
    Route::get('admin/week_time', [UserTimeController::class, 'week_time_list']);
    Route::get('admin/week_time/add', [UserTimeController::class, 'week_time_add']);
    Route::post('admin/week_time/add', [UserTimeController::class, 'week_time_store']);
    Route::get('admin/week_time/edit/{id}', [UserTimeController::class, 'week_time_edit']);
    Route::post('admin/week_time/edit/{id}', [UserTimeController::class, 'week_time_update']);
    Route::get('admin/week_time/delete/{id}', [UserTimeController::class, 'week_time_delete']);
    // Week Time End

    // Schedule Start
    Route::get('admin/schedule', [UserTimeController::class, 'admin_schedule']);
    Route::post('admin/schedule', [UserTimeController::class, 'admin_schedule_update']);
    // Schedule End
});

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
    Route::get('agent/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('agent/email/inbox', [AdminController::class, 'agent_email_inbox']);
});

Route::get('set_new_password/{token}', [AdminController::class, 'set_new_password']);
Route::post('set_new_password/{token}', [AdminController::class, 'set_new_password_post']);

Route::get('admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
