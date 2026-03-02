<?php

namespace App\Http\Controllers;

use App\Models\programadeformacion;
use Illuminate\Http\Request;

class ProgramadeformacionController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->get('buscar');

        // Aplicamos el mismo buscador y paginación que en Regional
        $Programa = programadeformacion::when($buscar, function ($query, $buscar) {
            return $query->where('Denominacion', 'LIKE', "%{$buscar}%")
                ->orWhere('Codigo', 'LIKE', "%{$buscar}%");
        })->paginate(10)->withQueryString();

        return view('programadeformacion.index', compact('Programa', 'buscar'));
    }

    public function create()
    {
        return view('programadeformacion.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:200',
            'Observaciones' => 'required|string|max:200'
        ]);

        programadeformacion::create($data);

        return redirect()->route('programadeformacion.index')
            ->with('success', 'Programa guardado correctamente');
    }

    public function show(programadeformacion $programadeformacion)
    {
        return view('programadeformacion.show', compact('programadeformacion'));
    }

    public function edit(programadeformacion $programadeformacion)
    {
        return view('programadeformacion.create', compact('programadeformacion'));
    }

    public function update(Request $request, programadeformacion $programadeformacion)
    {
        $data = $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:200',
            'Observaciones' => 'required|string|max:200'
        ]);

        $programadeformacion->update($data);

        return redirect()->route('programadeformacion.index')
            ->with('success', 'Programa actualizado correctamente');
    }

    public function destroy(programadeformacion $programadeformacion)
    {
        try {
            $programadeformacion->delete();
            return redirect()->route('programadeformacion.index')
                ->with('success', 'Eliminado correctamente');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect()->route('programadeformacion.index')
                    ->with('error', 'No se puede eliminar: tiene registros vinculados.');
            }
            return redirect()->route('programadeformacion.index')
                ->with('error', 'Error al intentar eliminar.');
        }
    }
}
