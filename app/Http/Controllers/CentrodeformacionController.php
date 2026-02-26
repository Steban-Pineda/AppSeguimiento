<?php

namespace App\Http\Controllers;

use App\Models\centrodeformacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CentrodeformacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //
        $Centrodeformacion = centrodeformacion::all(); // trae todos los registros

        return view('Centrodeformacion.index', compact('Centrodeformacion'));
        //return view('regional.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Centrodeformacion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:200',
            'Direccion' => 'required|string|max:200',
            'Observaciones' => 'required|string|max:200',
            'tbl_regional_NIS' => 'required|integer'
        ]);
        //$data['Observaciones'] = Crypt::encryptString($data['Observaciones']);
        centrodeformacion::create($data);

        return redirect()->route('Centrodeformacion.index')
            ->with('success', 'Registro guardado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(centrodeformacion $centrodeformacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(centrodeformacion $centrodeformacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, centrodeformacion $centrodeformacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(centrodeformacion $centrodeformacion)
    {
        //
    }
}
