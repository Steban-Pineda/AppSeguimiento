<?php

namespace App\Http\Controllers;

use App\Models\centrodeformacion;
use App\Models\Regional;
use Illuminate\Http\Request;

class CentrodeformacionController extends Controller
{
    /**
     * Lista todos los centros con su regional asociada.
     */
    public function index()
    {
        // Eager Loading para optimizar las 500+ regionales
        $Centrodeformacion = centrodeformacion::with('regional')->get();
        return view('Centrodeformacion.index', compact('Centrodeformacion'));
    }

    /**
     * Formulario de creación (Híbrido).
     */
    public function create()
    {
        $Regionales = Regional::orderBy('Denominacion', 'asc')->get();
        return view('Centrodeformacion.create', compact('Regionales'));
    }

    /**
     * Almacena un nuevo centro.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Codigo' => 'required|integer|unique:tbl_centrodeformacion,Codigo',
            'Denominacion' => 'required|string|max:200',
            'Direccion' => 'required|string|max:200',
            'Observaciones' => 'required|string|max:200',
            'tbl_regional_NIS' => 'required|exists:tbl_regional,NIS'
        ]);

        centrodeformacion::create($data);

        return redirect()->route('Centrodeformacion.index')
            ->with('success', 'Centro de formación guardado correctamente');
    }

    /**
     * Muestra el detalle de un centro específico.
     */
    public function show($id)
    {
        $centro = centrodeformacion::with('regional')->findOrFail($id);
        return view('Centrodeformacion.show', compact('centro'));
    }

    /**
     * Formulario de edición (Híbrido).
     */
    public function edit($id)
    {
        $centro = centrodeformacion::findOrFail($id);
        $Regionales = Regional::orderBy('Denominacion', 'asc')->get();

        // Reutilizamos la vista 'create'
        return view('Centrodeformacion.create', compact('centro', 'Regionales'));
    }

    /**
     * Actualiza el registro en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $centro = centrodeformacion::findOrFail($id);

        $data = $request->validate([
            // Ignoramos el ID actual en la validación unique para permitir guardar sin cambiar el código
            'Codigo' => 'required|integer|unique:tbl_centrodeformacion,Codigo,' . $id . ',NIS',
            'Denominacion' => 'required|string|max:200',
            'Direccion' => 'required|string|max:200',
            'Observaciones' => 'required|string|max:200',
            'tbl_regional_NIS' => 'required|exists:tbl_regional,NIS'
        ]);

        $centro->update($data);

        return redirect()->route('Centrodeformacion.index')
            ->with('success', 'Centro de formación actualizado correctamente');
    }

    /**
     * Elimina el registro.
     */
    public function destroy($id)
    {
        $centro = centrodeformacion::findOrFail($id);

        try {
            $centro->delete();
            return redirect()->route('Centrodeformacion.index')
                ->with('success', 'Centro de formación eliminado con éxito');
        } catch (\Exception $e) {
            // Manejo de error por si el centro tiene dependencias (llaves foráneas)
            return redirect()->route('Centrodeformacion.index')
                ->with('error', 'No se puede eliminar el centro porque tiene registros asociados.');
        }
    }
}
