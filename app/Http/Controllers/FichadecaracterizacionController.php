<?php

namespace App\Http\Controllers;

use App\Models\fichadecaracterizacion;
use Illuminate\Http\Request;

class FichadecaracterizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Fichadecaracterizacion = fichadecaracterizacion::all(); // trae todos los registros

        return view('Fichadecaracterizacion.index', compact('Fichadecaracterizacion'));
        //return view('regional.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Fichadecaracterizacion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([

            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:100',
            'Cupo' => 'required|integer',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
            'Observaciones' => 'required|string|max:200',
            'tbl_programadeformacion_NIS' => 'required|integer',
            'tbl_centrodeformacion_NIS' => 'required|integer',

        ]);
        //$data['Nombre'] = Crypt::encryptString($data['Nombre']);
        fichadecaracterizacion::create($data);

        return redirect()->route('Fichadecaracterizacion.index')
            ->with('success', 'Registro guardado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(fichadecaracterizacion $fichadecaracterizacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(fichadecaracterizacion $fichadecaracterizacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, fichadecaracterizacion $fichadecaracterizacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(fichadecaracterizacion $fichadecaracterizacion)
    {
        //
    }
}
