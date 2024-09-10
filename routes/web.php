<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MailController;
use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;

Route::get('/test', function () {
    return 'test';
});
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

Route::get('/testEmail', [MailController::class, 'sendTestEmail']);

Route::resources([
    'task_statuses' => TaskStatusController::class,
    'tasks' => TaskController::class
    //'labels' => LabelController::class,
]);

require __DIR__.'/auth.php';
