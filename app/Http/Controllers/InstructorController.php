<?php

namespace App\Http\Controllers;

use App\Models\instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Instructor = instructor::all(); // trae todos los registros

        return view('Instructor.index', compact('Instructor'));
        //return view('regional.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([

            'Numdoc' => 'required|integer',
            'Nombres' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:200',
            'Direccion' => 'required|string|max:200',
            'Telefono' => 'required|string|max:200',
            'CorreoInstitucional' => 'required|string|max:200',
            'CorreoPersonal' => 'required|string|max:200',
            'sexo' => 'required|integer',
            'fechaNacimiento' => 'required|date',
            'tbl_rolesadministrativos_NIS1' => 'required|integer',
            'tbl_tiposeps_NIS1' => 'required|integer',
            'tbl_tiposdocumento_NIS' => 'required|integer'
        ]);
        //$data['Nombre'] = Crypt::encryptString($data['Nombre']);
        instructor::create($data);

        return redirect()->route('Instructor.index')
            ->with('success', 'Registro guardado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(instructor $instructor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(instructor $instructor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, instructor $instructor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(instructor $instructor)
    {
        //
    }
}
