<?php

use App\Http\Controllers\Main\CalendarController;
use App\Http\Controllers\Main\CustomLoginController;
use App\Http\Controllers\Main\loginController as MainLoginController;
use App\Http\Controllers\Main\mainController;
use App\Http\Controllers\Main\stepController;
use App\Http\Controllers\Main\taskController;
// use App\Http\Controllers\Users\loginController;
use App\Models\Step;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Carbon;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [mainController::class, 'dateIndexedTasks'])->name('homepage');
    Route::get('taskPeriority', [mainController::class, 'periorityIndexedTasks']);
    Route::resource('task', taskController::class);
    Route::controller(taskController::class)->group(function () {
        Route::get('periority/{per}', 'periority');
        Route::get('taskdone/{task}', 'taskDone');
        Route::get('tasknotdone/{task}/{step?}', 'taskNotDone');
    });
    Route::resource('step', 'Main\stepController')->only(['index', 'store', 'update', 'destroy']);
    Route::controller(stepController::class)->group(function () {
        Route::get('stepdone/{step}', 'stepDone');
        Route::get('stepnotdone/{step}', 'stepNotDone');
    });
    Route::controller(CalendarController::class)->group(function () {
        Route::get('day/{day?}', "day")->name('dayTasks');
        Route::get('week/{date?}', "week")->name('weekTasks');
        Route::get('month/{month}', 'month');
        Route::get('year/{month}', 'year');
    });
});
Route::controller(CustomLoginController::class)->group(function () {
    Route::get('register', 'register')->name('user.create');
    Route::post('register', 'store')->name('user.store');
    Route::get('login', 'login')->name('user.login');
    Route::post('login', 'userLogin')->name('login');
    Route::get('logout', 'logout');
});;