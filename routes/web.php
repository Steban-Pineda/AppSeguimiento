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







Route::get('/Instructor', [\App\Http\Controllers\InstructorController::class, 'index'])->name('Instructor.index');
Route::get('/Instructor/create', [\App\Http\Controllers\InstructorController::class, 'create'])->name('Instructor.create');
Route::post('/Instructor/store', [\App\Http\Controllers\InstructorController::class, 'store'])->name('Instructor.store');






Route::resource('tiposdocumento', TiposdocumentoController::class);
Route::resource('tiposeps', \App\Http\Controllers\tiposepsController::class);
Route::resource('rolesadministrativos', \App\Http\Controllers\rolesadministrativosController::class);
Route::resource('Subalternativaep', \App\Http\Controllers\SubalternativaepController::class);
Route::resource('enteconformador', \App\Http\Controllers\enteconformadorController::class);
Route::resource('programadeformacion', \App\Http\Controllers\programadeformacionController::class);
Route::resource('Fichadecaracterizacion', \App\Http\Controllers\FichadecaracterizacionController::class);
Route::resource('Aprendices', \App\Http\Controllers\AprendicesController::class);
Route::resource('Centrodeformacion', \App\Http\Controllers\CentrodeformacionController::class);
Route::resource('Instructor', \App\Http\Controllers\InstructorController::class);










//Route::resource('regional', RegionalController::class);
