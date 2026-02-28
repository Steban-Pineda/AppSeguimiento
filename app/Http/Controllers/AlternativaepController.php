<?php

namespace App\Http\Controllers;

use App\Models\alternativaep;
use Illuminate\Http\Request;

class AlternativaepController extends Controller
{
    /**
     * Mostrar lista con Buscador
     */
    public function index(Request $request)
    {
        $buscar = $request->get('buscar');

        $alternativaep = alternativaep::when($buscar, function ($query, $buscar) {
            return $query->where('Nombre', 'LIKE', "%{$buscar}%")
                ->orWhere('NIS', 'LIKE', "%{$buscar}%");
        })->get();

        return view('alternativaep.index', compact('alternativaep', 'buscar'));
    }

    public function create()
    {
        return view('alternativaep.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre' => 'required|string|max:100',
            'Descripcion' => 'required|string|max:200',
        ]);

        alternativaep::create($data);

        return redirect()->route('alternativaep.index')
            ->with('success', 'Registro guardado correctamente');
    }

    /**
     * Consultar detalle de un registro
     */
    public function show(alternativaep $alternativaep)
    {
        return view('alternativaep.show', compact('alternativaep'));
    }

    /**
     * Cargar formulario de edición
     */
    public function edit(alternativaep $alternativaep)
    {
        // Reutilizamos la vista create para editar
        return view('alternativaep.create', compact('alternativaep'));
    }

    /**
     * Actualizar el registro
     */
    public function update(Request $request, alternativaep $alternativaep)
    {
        $data = $request->validate([
            'Nombre' => 'required|string|max:100',
            'Descripcion' => 'required|string|max:200'
        ]);

        $alternativaep->update($data);

        return redirect()->route('alternativaep.index')
            ->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Eliminar el registro con protección de errores
     */
    public function destroy(alternativaep $alternativaep)
    {
        try {
            $alternativaep->delete();
            return redirect()->route('alternativaep.index')
                ->with('success', 'Registro eliminado correctamente');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect()->route('alternativaep.index')
                    ->with('error', 'No se puede eliminar: esta alternativa tiene registros asociados.');
            }
            return redirect()->route('alternativaep.index')
                ->with('error', 'Ocurrió un error inesperado.');
        }
    }
}
