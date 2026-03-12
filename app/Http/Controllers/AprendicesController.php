<?php

namespace App\Http\Controllers;

use App\Models\aprendices;
use App\Models\tiposdocumento;
use App\Models\tiposeps;
use App\Models\fichadecaracterizacion;
use Illuminate\Http\Request;
use App\Notifications\Notificaciones;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AprendicesController extends Controller
{
    /**
     * Muestra la lista de aprendices con sus relaciones cargadas.
     */
    public function index()
    {
        // Cargamos las relaciones para evitar el error de variable indefinida en la vista index
        // y para que la consulta sea eficiente (Eager Loading).
        $Aprendiz= aprendices::with(['tipoDocumento', 'eps', 'ficha'])->get();

        return view('Aprendices.index', compact('Aprendiz'));
    }

    /**
     * Muestra el formulario para crear un aprendiz.
     */
    public function create()
    {

        $tiposDoc = tiposdocumento::all();
        $eps = tiposeps::all();
        $fichas = fichadecaracterizacion::all();

        return view('Aprendices.create', compact('tiposDoc', 'eps', 'fichas'));
    }

    /**
     * Guarda el aprendiz en la base de datos.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Numdoc' => 'required|integer|unique:tbl_aprendices,Numdoc',
            'Nombres' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:200',
            'Direccion' => 'required|string|max:200',
            'Telefono' => 'required|string|max:200',
            'CorreoInstitucional' => 'required|email|max:200',
            'CorreoPersonal' => 'required|email|max:200|unique:users,email', // Validar que el correo no exista en users
            'sexo' => 'required|integer|in:1,2',
            'fechaNacimiento' => 'required|date',
            'tbl_tiposdocumento_NIS' => 'required|exists:tbl_tiposdocumento,NIS',
            'tbl_tiposeps_NIS' => 'required|exists:tbl_tiposeps,NIS',
            'tbl_fichadecaracterizacion_NIS' => 'required|exists:tbl_fichadecaracterizacion,NIS'
        ]);

        // 1. Crear el aprendiz en la tabla de negocio
        $aprendiz = aprendices::create($data);

        // 2. Crear el acceso al sistema en la tabla 'users'
        // La contraseña por defecto será su número de documento
        User::create([
            'name' => $data['Nombres'] . ' ' . $data['Apellidos'],
            'email' => $data['CorreoPersonal'],
            'password' => Hash::make($data['Numdoc']),
            'role' => 3, // Asignamos Rol 3 (Aprendiz) automáticamente
        ]);

        // 3. Notificar (Cargamos la relación 'ficha' antes de enviar el correo)
        $aprendiz->load('ficha');
        $aprendiz->notify(new \App\Notifications\Notificaciones($aprendiz));

        return redirect()->route('Aprendices.index')
            ->with('success', 'Aprendiz y cuenta de usuario creados correctamente. La clave de acceso es su número de documento.');


    }




    /**
     * Muestra el detalle de un aprendiz.
     */
    public function show($id)
    {
        // Buscamos el aprendiz por su PK (NIS) cargando sus relaciones
        $aprendiz = aprendices::with(['tipoDocumento', 'eps', 'ficha.programa'])->findOrFail($id);

        return view('Aprendices.show', compact('aprendiz'));
    }

    /**
     * Muestra el formulario de edición.
     */
    public function edit($id)
    {
        $aprendiz = aprendices::findOrFail($id);

        // Cargamos nuevamente las listas para los selects en la edición
        $tiposDoc = tiposdocumento::all();
        $eps = tiposeps::all();
        $fichas = fichadecaracterizacion::all();

        return view('Aprendices.create', compact('aprendiz', 'tiposDoc', 'eps', 'fichas'));
    }

    /**
     * Actualiza el registro.
     */
    public function update(Request $request, $id)
    {
        $aprendiz = aprendices::findOrFail($id);

        $data = $request->validate([
            // La validación unique ignora el ID actual para permitir guardar sin cambiar el documento
            'Numdoc' => 'required|integer|unique:tbl_aprendices,Numdoc,' . $id . ',NIS',
            'Nombres' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:200',
            'sexo' => 'required|integer|in:1,2',
            'tbl_tiposdocumento_NIS' => 'required|exists:tbl_tiposdocumento,NIS',
            'tbl_tiposeps_NIS' => 'required|exists:tbl_tiposeps,NIS',
            'tbl_fichadecaracterizacion_NIS' => 'required|exists:tbl_fichadecaracterizacion,NIS'
        ]);

        $aprendiz->update($data);

        return redirect()->route('Aprendices.index')
            ->with('success', 'Datos actualizados correctamente');
    }

    /**
     * Elimina el registro.
     */
    public function destroy($id)
    {
        $aprendiz = aprendices::findOrFail($id);
        $aprendiz->delete();

        return redirect()->route('Aprendices.index')
            ->with('success', 'Aprendiz eliminado con éxito');
    }
}
