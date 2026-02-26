<?php

namespace App\Http\Controllers;

use App\Models\alternativaep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AlternativaepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //
        $alternativaep = alternativaep::all(); // trae todos los registros

        return view('alternativaep.index', compact('alternativaep'));
        //return view('regional.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('alternativaep.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([

            'Nombre' => 'required|string|max:100',
            'Descripcion' => 'required|string|max:200',

        ]);
        //$data['Nombre'] = Crypt::encryptString($data['Nombre']);
        alternativaep::create($data);

        return redirect()->route('alternativaep.index')
            ->with('success', 'Registro guardado correctamente');
    }


    /**
     * Display the specified resource.
     */
    public function show(alternativaep $alternativaep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(alternativaep $alternativaep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, alternativaep $alternativaep)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(alternativaep $alternativaep)
    {
        //
    }
}
