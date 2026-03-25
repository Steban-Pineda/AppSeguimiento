<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AprendicesController; // Asegúrate de importar tus controladores
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- RUTAS PROTEGIDAS (Requieren Login) ---
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/mi-perfil', function () {
        $aprendiz = \App\Models\aprendices::where('CorreoPersonal', Auth::user()->email)->firstOrFail();
        return redirect()->route('Aprendices.show', $aprendiz->NIS);
    })->name('mi.perfil');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('Aprendices', \App\Http\Controllers\AprendicesController::class);
    Route::resource('Instructor', \App\Http\Controllers\InstructorController::class);
    Route::resource('Fichadecaracterizacion', \App\Http\Controllers\FichadecaracterizacionController::class);
    Route::resource('Regional', \App\Http\Controllers\RegionalController::class);
    Route::resource('alternativaep', \App\Http\Controllers\AlternativaepController::class);
    Route::resource('tiposdocumento', \App\Http\Controllers\TiposdocumentoController::class);
    Route::resource('tiposeps', \App\Http\Controllers\tiposepsController::class);
    Route::resource('rolesadministrativos', \App\Http\Controllers\rolesadministrativosController::class);
    Route::resource('Subalternativaep', \App\Http\Controllers\SubalternativaepController::class);
    Route::resource('enteconformador', \App\Http\Controllers\enteconformadorController::class);
    Route::resource('programadeformacion', \App\Http\Controllers\programadeformacionController::class);
    Route::resource('Centrodeformacion', \App\Http\Controllers\CentrodeformacionController::class);
});

require __DIR__.'/auth.php';
