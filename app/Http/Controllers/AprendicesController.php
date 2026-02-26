<?php

namespace App\Http\Controllers;

use App\Models\aprendices;
use Illuminate\Http\Request;

class AprendicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //
        $Aprendices = aprendices::all(); // trae todos los registros

        return view('Aprendices.index', compact('Aprendices'));
        //return view('regional.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Aprendices.create');
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
            'tbl_tiposdocumento_NIS' => 'required|integer',
            'tbl_tiposeps_NIS' => 'required|integer',
            'tbl_fichadecaracterizacion_NIS' => 'required|integer'

        ]);
        //$data['Nombre'] = Crypt::encryptString($data['Nombre']);
        aprendices::create($data);

        return redirect()->route('Aprendices.index')
            ->with('success', 'Registro guardado correctamente');
    }


    /**
     * Display the specified resource.
     */
    public function show(aprendices $aprendices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(aprendices $aprendices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, aprendices $aprendices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(aprendices $aprendices)
    {
        //
    }
}
