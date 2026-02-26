<?php

namespace App\Http\Controllers;

use App\Models\regional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class RegionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $regional = regional::all(); // trae todos los registros

        return view('Regional.index', compact('regional'));
        //return view('regional.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('regional.create');
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
        $data['Observaciones'] = Crypt::encryptString($data['Observaciones']);
        regional::create($data);

        return redirect()->route('Regional.index')
            ->with('success', 'Registro guardado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(regional $regional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(regional $regional)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, regional $regional)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(regional $regional)
    {
        //
    }
}
