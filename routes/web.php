<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::inertia('/', 'Welcome')->name('welcome');

// access below group route if user authenticated
Route::group(['middleware' => ['auth','update.online.status']],function(){
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
    Route::post('delete-chat',[ChatController::class,'deleteChat'])->name('chat.delete');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
});

Route::get('login/{id}',function($id){
    $user = \App\Models\User::find($id);
    Auth::login($user);
    $user->update(['last_online_at' => now()]);

    return redirect()->route('chat.index');
});
