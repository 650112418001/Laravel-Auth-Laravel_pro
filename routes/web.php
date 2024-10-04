<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AttendingSystemController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventShowController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\LikeSystemController;
use App\Http\Controllers\SavedSystemController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LikedEventController;
use App\Http\Controllers\SavedEventController;
use App\Http\Controllers\AttendingEventController;
use App\Http\Controllers\StoreCommentController;
use App\Http\Controllers\DeleteCommentController;
use App\Http\Controllers\EventIndexController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', WelcomeController::class)->name('welcome');
Route::get('/e', EventIndexController::class)->name('eventIndex');
Route::get('/e/{id}', EventShowController::class)->name('eventShow');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/liked-events', LikedEventController::class)->name('likedEvents');
    Route::get('/saved-events', SavedEventController::class)->name('savedEvents');
    Route::get('/attending-events', AttendingEventController::class)->name('attendingEvents');

    Route::post('/events-like/{id}',LikeSystemController::class)->name('events.like');
    Route::post('/events-saved/{id}',SavedSystemController::class)->name('events.saved');
    Route::post('/events-attending/{id}', AttendingSystemController::class)->name('events.attending');

    Route::post('/events/{id}/comments', StoreCommentController::class)->name('events.comments');
    Route::delete('/events/{id}/comments/{comment}', DeleteCommentController::class)->name('events.comments.destroy');
});

require __DIR__.'/auth.php';

/* Admin */
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::resource('events', EventController::class);
    Route::resource('users', UserController::class);
    Route::get('/e', EventIndexController::class)->name('eventIndex');
});


Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login-submit', [AdminController::class, 'login_submit'])->name('admin_login_submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin_logout');
    Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget-password-submit', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');
    Route::post('/reset-password-submit', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');
});

