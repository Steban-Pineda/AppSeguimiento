<?php

namespace App\Http\Controllers;

use App\Models\rolesadministrativos;
use Illuminate\Http\Request;

class RolesadministrativosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $RolesAdministrativos = rolesadministrativos::all(); // trae todos los registros

        return view('rolesadministrativos.index', compact('RolesAdministrativos'));
        //return view('regional.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('rolesadministrativos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([

            'Descripcion' => 'required|string|max:200',


        ]);
        //$data['Observaciones'] = Crypt::encryptString($data['Observaciones']);
        RolesAdministrativos::create($data);

        return redirect()->route('rolesadministrativos.index')
            ->with('success', 'Registro guardado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(rolesadministrativos $rolesadministrativos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rolesadministrativos $rolesadministrativos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rolesadministrativos $rolesadministrativos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rolesadministrativos $rolesadministrativos)
    {
        //
    }
}
