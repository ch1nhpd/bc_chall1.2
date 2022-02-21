<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use \App\Http\Controllers\Accounts\LoginController;
use \App\Http\Controllers\Accounts\HomeController;
use \App\Http\Controllers\Teachers\MessageController;
use \App\Http\Controllers\Teachers\AssignmentController;
use \App\Http\Controllers\Teachers\ChallengeController;
use \App\Http\Controllers\Teachers\UserController;
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
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/process', [LoginController::class, 'process']);



Route::group(['middleware' => ['auth']], function () {
    Route::prefix('home')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users_teacher');
            Route::get('/p',[UserController::class, 'showinfo']);
            Route::get('add', [UserController::class, 'add']);
            Route::post('add', [UserController::class, 'addProcess']);
            Route::get('details', [UserController::class, 'index']);
            Route::post('update', [UserController::class, 'editProcess']);
            Route::get('edit', [UserController::class, 'edit']);
            Route::post('delete', [UserController::class, 'delete']);
        });
    });

    Route::prefix('messages')->group(function(){
        Route::get('/', [MessageController::class, 'index'])->name('message');
        Route::post('send',[MessageController::class,'sendMessage']);
        Route::post('delete',[MessageController::class,'delete']);
        Route::post('update',[MessageController::class,'update']);
    });

    Route::prefix('myprofile')->group(function(){
        Route::get('/',[UserController::class,'profile']);
    });

    Route::prefix('assignments')->group(function(){
        Route::get('/',[AssignmentController::class,'index'])->name('assignments');
        Route::get('add',[AssignmentController::class,'add']);
        Route::post('add',[AssignmentController::class,'addProcess']);
        Route::get('view',[AssignmentController::class,'getOne']);
        Route::get('submit',[AssignmentController::class,'submit']);
        Route::post('submit',[AssignmentController::class,'submit_a']);
        Route::get('edit',[AssignmentController::class,'edit']);
        Route::post('edit',[AssignmentController::class,'editProcess']);
        Route::post('delete',[AssignmentController::class,'delete']);
    });

    Route::prefix('challenges')->group(function(){
        Route::get('/',[ChallengeController::class,'index'])->name('challenges');
        Route::get('add',[ChallengeController::class,'add']);
        Route::post('add',[ChallengeController::class,'add_a']);
        Route::get('view',[ChallengeController::class,'getOne']);
        Route::post('delete',[ChallengeController::class,'delete']);
        
        Route::post('submit',[ChallengeController::class,'submit']);
    });

    Route::get('download/{file}',[HomeController::class,'download']);
});




