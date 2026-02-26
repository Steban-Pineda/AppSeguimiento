<?php

namespace App\Http\Controllers;

use App\Models\tiposdocumento;
use Illuminate\Http\Request;

class TiposdocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //
        $tipodoc = tiposdocumento::all(); // trae todos los registros

        return view('tiposdocumento.index', compact('tipodoc'));
        //return view('regional.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tiposdocumento.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([

            'Denominacion' => 'required|string|max:100',
            'Observaciones' => 'required|string|max:200'
        ]);
       // $data['Observaciones'] = Crypt::encryptString($data['Observaciones']);
        tiposdocumento::create($data);

        return redirect()->route('tiposdocumento.index')
            ->with('success', 'Registro guardado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(tiposdocumento $tiposdocumento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // En edit
    public function edit(tiposdocumento $tiposdocumento) // Asegúrate que 'tiposdocumento' coincida con el nombre del modelo importado
    {
        return view('tiposdocumento.create', compact('tiposdocumento'));
    }

// En update
    public function update(Request $request, tiposdocumento $tiposdocumento)
    {
        $data = $request->validate([
            'Denominacion' => 'required|string|max:100',
            'Observaciones' => 'required|string|max:200'
        ]);

        $tiposdocumento->update($data);

        return redirect()->route('tiposdocumento.index')
            ->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tiposdocumento $tiposdocumento)
    {
        //
    }
}
