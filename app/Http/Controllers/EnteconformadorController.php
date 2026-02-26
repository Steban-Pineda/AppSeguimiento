<?php

namespace App\Http\Controllers;

use App\Models\enteconformador;
use Illuminate\Http\Request;

class EnteconformadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //
        $enteconformador = enteconformador::all(); // trae todos los registros

        return view('enteconformador.index', compact('enteconformador'));
        //return view('regional.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('enteconformador.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tdoc' => 'required|integer',
            'Numdoc' => 'required|integer',
            'RazonSocial' => 'required|string|max:100',
            'Direccion' => 'required|string|max:200',
            'Telefono' => 'required|string|max:50',
            'CorreoInstitucional' => 'required|string|max:50'
        ]);
        //$data['Observaciones'] = Crypt::encryptString($data['Observaciones']);
        enteconformador::create($data);

        return redirect()->route('enteconformador.index')
            ->with('success', 'Registro guardado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(enteconformador $enteconformador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(enteconformador $enteconformador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, enteconformador $enteconformador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(enteconformador $enteconformador)
    {
        //
    }
}
