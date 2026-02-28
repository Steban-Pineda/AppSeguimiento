<?php

namespace App\Http\Controllers;

use App\Models\tiposeps;
use Illuminate\Http\Request;

class TiposepsController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->get('buscar');

        $tiposeps = tiposeps::when($buscar, function ($query, $buscar) {
            return $query->where('Denominacion', 'LIKE', "%{$buscar}%")
                ->orWhere('numdoc', 'LIKE', "%{$buscar}%")
                ->orWhere('NIS', 'LIKE', "%{$buscar}%");
        })
            ->paginate(10) // Paginación de 10 en 10
            ->withQueryString(); // Mantiene la búsqueda al cambiar de página

        return view('tiposeps.index', compact('tiposeps', 'buscar'));
    }

    public function create()
    {
        return view('tiposeps.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // Eliminamos NIS de aquí porque es autoincremental
            'numdoc' => 'required|integer',
            'Denominacion' => 'required|string|max:100',
            'Observaciones' => 'required|string|max:200'
        ]);

        tiposeps::create($data);

        return redirect()->route('tiposeps.index')
            ->with('success', 'Registro guardado correctamente');
    }

    public function show(tiposeps $tiposep)
    {

        return view('tiposeps.show', compact('tiposep'));
    }

    public function edit(tiposeps $tiposep)
    {
        return view('tiposeps.create', ['tiposep' => $tiposep]);
    }

    public function update(Request $request, tiposeps $tiposep)
    {
        $data = $request->validate([
            'numdoc' => 'required|integer',
            'Denominacion' => 'required|string|max:100',
            'Observaciones' => 'required|string|max:200'
        ]);

        $tiposep->update($data);

        return redirect()->route('tiposeps.index')
            ->with('success', 'Registro actualizado correctamente');
    }

    public function destroy(tiposeps $tiposep)
    {
        $tiposep->delete();
        return redirect()->route('tiposeps.index')
            ->with('success', 'Registro eliminado correctamente');
    }
}
