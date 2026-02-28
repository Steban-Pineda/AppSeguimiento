<?php

namespace App\Http\Controllers;

use App\Models\rolesadministrativos;
use Illuminate\Http\Request;

class RolesadministrativosController extends Controller
{
    /**
     * Lista con Buscador y Paginado
     */
    public function index(Request $request)
    {
        $buscar = $request->get('buscar');

        $RolesAdministrativos = rolesadministrativos::when($buscar, function ($query, $buscar) {
            return $query->where('Descripcion', 'LIKE', "%{$buscar}%")
                ->orWhere('NIS', 'LIKE', "%{$buscar}%");
        })
            ->paginate(10)
            ->withQueryString();

        return view('rolesadministrativos.index', compact('RolesAdministrativos', 'buscar'));
    }

    public function create()
    {
        return view('rolesadministrativos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Descripcion' => 'required|string|max:200',
        ]);

        rolesadministrativos::create($data);

        return redirect()->route('rolesadministrativos.index')
            ->with('success', 'Registro guardado correctamente');
    }

    public function show(rolesadministrativos $rolesadministrativo)
    {
        return view('rolesadministrativos.show', compact('rolesadministrativo'));
    }

    public function edit(rolesadministrativos $rolesadministrativo)
    {
        // Pasamos como 'rol' para simplificar el nombre en la vista
        return view('rolesadministrativos.create', ['rol' => $rolesadministrativo]);
    }

    public function update(Request $request, rolesadministrativos $rolesadministrativo)
    {
        $data = $request->validate([
            'Descripcion' => 'required|string|max:200',
        ]);

        $rolesadministrativo->update($data);

        return redirect()->route('rolesadministrativos.index')
            ->with('success', 'Registro actualizado correctamente');
    }

    public function destroy(rolesadministrativos $rolesadministrativo)
    {
        $rolesadministrativo->delete();

        return redirect()->route('rolesadministrativos.index')
            ->with('success', 'Registro eliminado correctamente');
    }
}
