<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminPanelController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'authenticate']);
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin', [AdminPanelController::class, 'index'])->name('admin');
Route::get('/admin/newbies', [AdminPanelController::class, 'returnNewRegistered']);
Route::get('/admin/reservations', [AdminPanelController::class, 'returnReservation']);
Route::get('/admin/bookers', [AdminPanelController::class, 'returnBookers']);
Route::get('/admin/subscribers', [AdminPanelController::class, 'returnSubscribers']);
Route::get('/newbies/profil/{id}', [AdminPanelController::class, 'showProfil']);
Route::get('/newbies/validate/{id}/{email}', [AdminPanelController::class, 'validateRegister'])->name('validate');
Route::get('/newbies/delete/{id}', [AdminPanelController::class, 'deleteRegister'])->name('delete');
Route::get('/subscribers/delete/{id}', [AdminPanelController::class, 'deleteSubscriber']);
Route::get('/reservations/validate/{reservationId}', [AdminPanelController::class, 'validateReservation']);
Route::get('/reservations/delete/{reservationId}', [AdminPanelController::class, 'deleteReservation']);
Route::post('/workupreservation', [AdminPanelController::class, 'workupReservation'])->name('workup');
Route::get('/reservationConfig', [AdminPanelController::class, 'returnReservationForm']);
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::get('/adminLogout', [AdminPanelController::class, 'adminLogout'])->name('adminLogout');
Route::get('/verified/{email}', [AdminPanelController::class, 'validateEmail']);
Route::post('/booking', [HomeController::class, 'booking'])->name('reserve');
Route::get('/toResetPasswordPage', [LoginController::class, 'toResetPasswordPage'])->name('toResetPasswordPage');
Route::post('/toResetPasswordPage', [LoginController::class, 'resetPasswordMailSend']);
Route::get('/resetPassword/{code}/{email}', [LoginController::class, 'getResetPassword']);
Route::post('/resetPassword', [LoginController::class, 'resetPassword']);

