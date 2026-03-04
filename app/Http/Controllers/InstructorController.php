<?php

namespace App\Http\Controllers;

use App\Models\instructor;
use App\Models\rolesadministrativos;

use App\Models\tiposeps;
use App\Models\tiposdocumento;


use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Muestra el listado de instructores con sus relaciones.
     */
    public function index()
    {
        // Cargamos relaciones para evitar múltiples consultas a la BD (Problema N+1)
        $Instructor = instructor::with(['rolesadministrativos', 'eps', 'tiposdocumento'])->get();
        return view('Instructor.index', compact('Instructor'));
    }

    /**
     * Formulario de creación con carga de tablas maestras.
     */
    public function create()
    {
        $roles = rolesadministrativos::orderBy('Descripcion', 'asc')->get();
        $eps = tiposeps::orderBy('Denominacion', 'asc')->get();
        $tiposDoc = tiposdocumento::orderBy('Denominacion', 'asc')->get();

        return view('Instructor.create', compact('roles', 'eps', 'tiposDoc'));
    }

    /**
     * Guarda el nuevo instructor.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Numdoc' => 'required|integer|unique:tbl_instructor,Numdoc',
            'Nombres' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:200',
            'Direccion' => 'required|string|max:200',
            'Telefono' => 'required|string|max:200',
            'CorreoInstitucional' => 'required|email|max:200',
            'CorreoPersonal' => 'required|email|max:200',
            'sexo' => 'required|integer',
            'fechaNacimiento' => 'required|date',
            'tbl_rolesadministrativos_NIS1' => 'required|exists:tbl_rolesadministrativos,NIS',
            'tbl_tiposeps_NIS1' => 'required|exists:tbl_tiposeps,NIS',
            'tbl_tiposdocumento_NIS' => 'required|exists:tbl_tiposdocumento,NIS'
        ]);

        instructor::create($data);

        return redirect()->route('Instructor.index')
            ->with('success', 'Instructor registrado exitosamente');
    }

    /**
     * Formulario de edición (Híbrido).
     */
    public function edit($id)
    {
        $instructor = instructor::findOrFail($id);
        $roles = rolesadministrativos::orderBy('Descripcion', 'asc')->get();
        $eps = tiposeps::orderBy('Denominacion', 'asc')->get();
        $tiposDoc = tiposdocumento::orderBy('Denominacion', 'asc')->get();

        return view('Instructor.create', compact('instructor', 'roles', 'eps', 'tiposDoc'));
    }

    /**
     * Actualiza los datos del instructor.
     */
    public function update(Request $request, $id)
    {
        $instructor = instructor::findOrFail($id);

        $data = $request->validate([
            'Numdoc' => 'required|integer|unique:tbl_instructor,Numdoc,' . $id . ',NIS',
            'Nombres' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:200',
            'Direccion' => 'required|string|max:200',
            'Telefono' => 'required|string|max:200',
            'CorreoInstitucional' => 'required|email|max:200',
            'CorreoPersonal' => 'required|email|max:200',
            'sexo' => 'required|integer',
            'fechaNacimiento' => 'required|date',
            'tbl_rolesadministrativos_NIS1' => 'required|exists:tbl_rolesadministrativos,NIS',
            'tbl_tiposeps_NIS1' => 'required|exists:tbl_tiposeps,NIS',
            'tbl_tiposdocumento_NIS' => 'required|exists:tbl_tiposdocumento,NIS'
        ]);

        $instructor->update($data);

        return redirect()->route('Instructor.index')
            ->with('success', 'Datos del instructor actualizados');
    }

    /**
     * Elimina al instructor.
     */
    public function destroy($id)
    {
        $instructor = instructor::findOrFail($id);
        $instructor->delete();

        return redirect()->route('Instructor.index')
            ->with('success', 'Registro eliminado correctamente');
    }

    /**
     * Muestra detalles del instructor.
     */
    public function show($id)
    {
        $instructor = instructor::with(['rolesadministrativos', 'eps', 'tiposdocumento'])->findOrFail($id);
        return view('Instructor.show', compact('instructor'));
    }
}
