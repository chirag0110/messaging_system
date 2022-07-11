<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->prefix('chat')->group(function () {
    Route::get('/', [ChatController::class, 'index'])->name('chat');
    Route::get('/messages/{user_id}', [ChatController::class, 'getMessages'])->name('get.message');
    Route::post('/send/message', [ChatController::class, 'sendMessage'])->name('send.message');
    Route::delete('/message/delete/{chat_id}', [ChatController::class, 'deleteMessage'])->name('delete.message');

});

require __DIR__.'/auth.php';
