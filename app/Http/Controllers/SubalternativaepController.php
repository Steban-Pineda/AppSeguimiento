<?php

namespace App\Http\Controllers;

use App\Models\subalternativaep;
use Illuminate\Http\Request;

class SubalternativaepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Subalternativaep = subalternativaep::all(); // trae todos los registros

        return view('Subalternativaep.index', compact('Subalternativaep'));
        //return view('regional.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Subalternativaep.create');
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
        //$data['Observaciones'] = Crypt::encryptString($data['Observaciones']);
        Subalternativaep::create($data);

        return redirect()->route('Subalternativaep.index')
            ->with('success', 'Registro guardado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(subalternativaep $subalternativaep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(subalternativaep $subalternativaep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, subalternativaep $subalternativaep)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(subalternativaep $subalternativaep)
    {
        //
    }
}
