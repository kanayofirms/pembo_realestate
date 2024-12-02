<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserTimeController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\SMTPController;
use App\Http\Controllers\ColourController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SendPDFController;
use App\Http\Controllers\TransactionsController;

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

    // Transactions Start
    Route::get('admin/transactions', [TransactionsController::class, 'transactions_index']);
    // Transactions End

    // PDF
    Route::get('admin/send_pdf', [SendPDFController::class, 'send_pdf']);
    Route::post('admin/send_pdf_sent', [SendPDFController::class, 'send_pdf_sent']);
    // PDF End

    // Blog Delete All
    Route::get('admin/blog/truncate', [BlogController::class, 'blog_truncate']);

    // address menu start
    Route::get('admin/address', [LocationController::class, 'admin_address']);
    Route::get('admin/address/add', [LocationController::class, 'admin_address_add']);
    Route::get('get-states/{countryId}', [LocationController::class, 'get_states']);
    Route::get('get-cities/{stateId}', [LocationController::class, 'get_cities']);
    Route::post('admin/address/add', [LocationController::class, 'admin_address_store']);
    Route::get('admin/address/edit/{id}', [LocationController::class, 'admin_address_edit']);
    Route::post('admin/address/edit/{id}', [LocationController::class, 'admin_address_update']);
    Route::get('admin/address/delete/{id}', [LocationController::class, 'admin_address_delete']);
    // address menu end

    // Address Start
    Route::get('admin/countries', [LocationController::class, 'countries_index']);
    Route::get('admin/countries/add', [LocationController::class, 'countries_add']);
    Route::post('admin/countries/add', [LocationController::class, 'countries_store']);
    Route::get('admin/countries/edit/{id}', [LocationController::class, 'countries_edit']);
    Route::post('admin/countries/edit/{id}', [LocationController::class, 'countries_update']);
    Route::get('admin/countries/delete/{id}', [LocationController::class, 'countries_delete']);

    Route::get('admin/state', [LocationController::class, 'state_list']);
    Route::get('admin/state/add', [LocationController::class, 'state_add']);
    Route::post('admin/state/add', [LocationController::class, 'state_store']);
    Route::get('admin/state/edit/{id}', [LocationController::class, 'state_edit']);
    Route::post('admin/state/edit/{id}', [LocationController::class, 'state_update']);
    Route::get('admin/state/delete/{id}', [LocationController::class, 'state_delete']);

    Route::get('admin/city', [LocationController::class, 'city_list']);
    Route::get('admin/city/add', [LocationController::class, 'city_add']);
    Route::get('get-states-record/{countryId}', [LocationController::class, 'get_state_name']);
    Route::post('admin/city/add', [LocationController::class, 'city_store']);
    Route::get('admin/city/edit/{id}', [LocationController::class, 'city_edit']);
    Route::post('admin/city/edit/{id}', [LocationController::class, 'city_update']);
    Route::get('admin/city/delete/{id}', [LocationController::class, 'city_delete']);

    // Address End
    Route::get('admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('admin/profile', [AdminController::class, 'admin_profile']);
    Route::post('admin_profile/update', [AdminController::class, 'update']);

    Route::get('admin/users', [AdminController::class, 'admin_users']);

    Route::get('admin/users/add', [AdminController::class, 'admin_add_users']);
    Route::post('admin/users/add', [AdminController::class, 'admin_add_users_store']);

    Route::get('admin/users/view/{id}', [AdminController::class, 'view_users']);
    Route::get('admin/users/edit/{id}', [AdminController::class, 'edit_users']);
    Route::post('admin/users/edit/{id}', [AdminController::class, 'edit_users_update']);
    Route::get('admin/users/delete/{id}', [AdminController::class, 'admin_soft_delete']);

    Route::post('admin/users/update', [AdminController::class, 'admin_users_update']);
    Route::get('admin/users/changeStatus', [AdminController::class, 'admin_users_changeStatus']);
    Route::post('checkemail', [AdminController::class, 'checkEmail']);

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

    // Notification Start
    Route::get('admin/notification', [NotificationController::class, 'notification_index']);
    Route::post('admin/notification_send', [NotificationController::class, 'notification_send']);
    // Notification End

    //QRCode Start
    Route::get('admin/qrcode', [QRCodeController::class, 'list']);
    Route::get('admin/qrcode/add', [QRCodeController::class, 'add_qrcode']);
    Route::post('admin/qrcode/add', [QRCodeController::class, 'store_qrcode']);
    Route::get('admin/qrcode/edit/{id}', [QRCodeController::class, 'edit_qrcode']);
    Route::post('admin/qrcode/edit/{id}', [QRCodeController::class, 'update_qrcode']);
    Route::get('admin/qrcode/delete/{id}', [QRCodeController::class, 'delete_qrcode']);
    //QRCode End

    // SMTP Start
    Route::get('admin/smtp', [SMTPController::class, 'smtp_list']);
    Route::post('admin/smtp_update', [SMTPController::class, 'smtp_update']);
    // SMTP End

    // Colour Start
    Route::get('admin/colour', [ColourController::class, 'colour_list']);
    Route::get('admin/colour/add', [ColourController::class, 'add_colour']);
    Route::post('admin/colour/add', [ColourController::class, 'store_colour']);
    Route::get('admin/colour/edit/{id}', [ColourController::class, 'edit_colour']);
    Route::post('admin/colour/edit/{id}', [ColourController::class, 'update_colour']);
    Route::get('admin/colour/delete/{id}', [ColourController::class, 'delete_colour']);
    Route::post('admin/colour/change_status', [ColourController::class, 'change_status']);
    // Colour End

    // Order Start
    Route::get('admin/order', [OrdersController::class, 'list_order']);
    Route::get('admin/order/add', [OrdersController::class, 'add_order']);
    Route::post('admin/order/add', [OrdersController::class, 'store_order']);
    Route::get('admin/order/edit/{id}', [OrdersController::class, 'edit_order']);
    Route::post('admin/order/edit/{id}', [OrdersController::class, 'update_order']);
    Route::get('admin/order/delete/{id}', [OrdersController::class, 'delete_order']);
    // Order End

    // Blog Start
    Route::get('admin/blog', [BlogController::class, 'list_blog']);
    Route::get('admin/blog/add', [BlogController::class, 'add_blog']);
    Route::post('admin/blog/add', [BlogController::class, 'store_blog']);
    Route::get('admin/blog/edit/{id}', [BlogController::class, 'edit_blog']);
    Route::post('admin/blog/edit/{id}', [BlogController::class, 'update_blog']);
    Route::get('/admin/blog/view/{id}', [BlogController::class, 'view_blog']);
    Route::get('admin/blog/delete/{id}', [BlogController::class, 'delete_blog']);
    // Blog End

    // PDF Start
    Route::get('admin/pdf_demo', [ColourController::class, 'pdf_demo']);
    Route::get('admin/pdf_colour', [ColourController::class, 'pdf_colour']);
    Route::get('admin/colour/pdf/{id}', [ColourController::class, 'pdf_id']);
    // PDF End

});

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
    Route::get('agent/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('agent/email/inbox', [AdminController::class, 'agent_email_inbox']);
    Route::get('agent/transactions', [TransactionsController::class, 'agent_transactions_add']);
});

Route::get('set_new_password/{token}', [AdminController::class, 'set_new_password']);
Route::post('set_new_password/{token}', [AdminController::class, 'set_new_password_post']);

Route::get('admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
