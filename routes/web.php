<?php

use App\Http\Controllers\TiposdocumentoController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RegionalController;

Route::get('/', function () {
    return view('welcome');

});
/*

*/
Route::resource('Regional', RegionalController::class);
Route::resource('alternativaep', \App\Http\Controllers\AlternativaepController::class);

Route::get('/Aprendices', [\App\Http\Controllers\AprendicesController::class, 'index'])->name('Aprendices.index');
Route::get('/Aprendices/create', [\App\Http\Controllers\AprendicesController::class, 'create'])->name('Aprendices.create');
Route::post('/Aprendices/store', [\App\Http\Controllers\AprendicesController::class, 'store'])->name('Aprendices.store');

Route::get('/Centrodeformacion', [\App\Http\Controllers\CentrodeformacionController::class, 'index'])->name('Centrodeformacion.index');
Route::get('/Centrodeformacion/create', [\App\Http\Controllers\CentrodeformacionController::class, 'create'])->name('Centrodeformacion.create');
Route::post('/Centrodeformacion/store', [\App\Http\Controllers\CentrodeformacionController::class, 'store'])->name('Centrodeformacion.store');



Route::get('/Fichadecaracterizacion', [\App\Http\Controllers\FichadecaracterizacionController::class, 'index'])->name('Fichadecaracterizacion.index');
Route::get('/Fichadecaracterizacion/create', [\App\Http\Controllers\FichadecaracterizacionController::class, 'create'])->name('Fichadecaracterizacion.create');
Route::post('/Fichadecaracterizacion/store', [\App\Http\Controllers\FichadecaracterizacionController::class, 'store'])->name('Fichadecaracterizacion.store');

Route::get('/Instructor', [\App\Http\Controllers\InstructorController::class, 'index'])->name('Instructor.index');
Route::get('/Instructor/create', [\App\Http\Controllers\InstructorController::class, 'create'])->name('Instructor.create');
Route::post('/Instructor/store', [\App\Http\Controllers\InstructorController::class, 'store'])->name('Instructor.store');

Route::get('/programadeformacion', [\App\Http\Controllers\ProgramadeformacionController::class, 'index'])->name('programadeformacion.index');
Route::get('/programadeformacion/create', [\App\Http\Controllers\ProgramadeformacionController::class, 'create'])->name('programadeformacion.create');
Route::post('/programadeformacion/store', [\App\Http\Controllers\ProgramadeformacionController::class, 'store'])->name('programadeformacion.store');




Route::resource('tiposdocumento', TiposdocumentoController::class);
Route::resource('tiposeps', \App\Http\Controllers\tiposepsController::class);
Route::resource('rolesadministrativos', \App\Http\Controllers\rolesadministrativosController::class);
Route::resource('Subalternativaep', \App\Http\Controllers\SubalternativaepController::class);
Route::resource('enteconformador', \App\Http\Controllers\enteconformadorController::class);










//Route::resource('regional', RegionalController::class);
