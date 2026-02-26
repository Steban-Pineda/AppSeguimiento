<?php

namespace App\Http\Controllers;

use App\Models\programadeformacion;
use Illuminate\Http\Request;

class ProgramadeformacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Programa = programadeformacion::all(); // trae todos los registros

        return view('programadeformacion.index', compact('Programa'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('programadeformacion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:200',
            'Observaciones' => 'required|string|max:200'

        ]);
        //$data['Observaciones'] = Crypt::encryptString($data['Observaciones']);
        programadeformacion::create($data);

        return redirect()->route('programadeformacion.index')
            ->with('success', 'Registro guardado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(programadeformacion $programadeformacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(programadeformacion $programadeformacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, programadeformacion $programadeformacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(programadeformacion $programadeformacion)
    {
        //
    }
}
