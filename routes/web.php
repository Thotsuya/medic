<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::redirect('/','/login');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth:sanctum','admin'],'prefix' => 'admin'], function () {

    Route::redirect('/', '/admin/dashboard');
    Route::get('/dashboard',\App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');

    Route::post('patients/files',[\App\Http\Controllers\Admin\PatientOperationsController::class,'storeDocument'])->name('patients.files');
    Route::get('/patients/{patient}/odontogram',[\App\Http\Controllers\Admin\OdontogramController::class,'index'])->name('patients.odontogram');

    Route::post('/patients/{patient}/odontogram/rules',[\App\Http\Controllers\Admin\OdontogramController::class,'rules'])->name('patients.odontogram.rules');
    Route::put('/patients/{patient}/odontogram',[\App\Http\Controllers\Admin\OdontogramController::class,'update'])->name('patients.odontogram.update');

    Route::resource('patients', \App\Http\Controllers\Admin\PatientController::class)->except(['edit']);

    Route::resource('notes', \App\Http\Controllers\Admin\NotesController::class);

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);

    Route::put('appointments/{appointment}/status',[\App\Http\Controllers\Admin\AppointmentOperationsController::class,'updateAppointmentStatus'])->name('appointments.status');
    Route::put('appointments/{appointment}/restore',[\App\Http\Controllers\Admin\AppointmentOperationsController::class,'restoreAppointment'])->name('appointments.restore');
    Route::resource('appointments', \App\Http\Controllers\Admin\AppointmentController::class)->only(['index','store','destroy']);

    Route::resource('procedures', \App\Http\Controllers\Admin\ProcedureController::class);
    Route::post('currency/{currency}',[\App\Http\Controllers\CurrencyController::class,'setCurrency'])->name('currency.set');

    Route::put('attentions/{attention}/procedures',[\App\Http\Controllers\Admin\AttentionUpdateController::class,'update'])->name('attentions.procedures.update');
    Route::get('attentions/{attention}/report',[\App\Http\Controllers\Admin\AttentionController::class,'report'])->name('attentions.report');
    Route::resource('attentions', \App\Http\Controllers\Admin\AttentionController::class);

    Route::post('payments',[\App\Http\Controllers\Admin\PaymentController::class,'store'])->name('payments.store');
    Route::delete('payments/{payment}',[\App\Http\Controllers\Admin\PaymentController::class,'destroy'])->name('payments.destroy');

    Route::resource('valuations', \App\Http\Controllers\Admin\ValuationController::class);
    Route::put('valuations/{valuation}/procedures',[\App\Http\Controllers\Admin\ValuationUpdateController::class,'update'])->name('valuations.procedures.update');
    Route::get('valuations/{valuation}/report',[\App\Http\Controllers\Admin\ValuationController::class,'report'])->name('valuations.report');
});

Route::group(['middleware' => 'auth:sanctum','prefix' => 'app','as' => 'client.'],function(){

    Route::get('/dashboard',fn() => Inertia::render('Client/Dashboard'))->name('dashboard');
});
