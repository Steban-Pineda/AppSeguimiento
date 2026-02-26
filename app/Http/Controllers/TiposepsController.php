<?php

namespace App\Http\Controllers;

use App\Models\tiposeps;
use Illuminate\Http\Request;

class TiposepsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tiposeps = tiposeps::all(); // trae todos los registros

        return view('tiposeps.index', compact('tiposeps'));
        //return view('regional.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tiposeps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([

            'numdoc' => 'required|integer',
            'Denominacion' => 'required|string|max:100',
            'Observaciones' => 'required|string|max:200'
        ]);
        // $data['Observaciones'] = Crypt::encryptString($data['Observaciones']);
        tiposeps::create($data);

        return redirect()->route('tiposeps.index')
            ->with('success', 'Registro guardado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(tiposeps $tiposeps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tiposeps $tiposeps)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tiposeps $tiposeps)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tiposeps $tiposeps)
    {
        //
    }
}
