<?php

namespace App\Http\Controllers;

use App\Models\subalternativaep;
use Illuminate\Http\Request;

class SubalternativaepController extends Controller
{
    /**
     * Lista con Buscador y Paginado
     */
    public function index(Request $request)
    {
        $buscar = $request->get('buscar');

        $Subalternativaep = subalternativaep::when($buscar, function ($query, $buscar) {
            return $query->where('Nombre', 'LIKE', "%{$buscar}%")
                ->orWhere('Descripcion', 'LIKE', "%{$buscar}%")
                ->orWhere('NIS', 'LIKE', "%{$buscar}%");
        })
            ->paginate(10)
            ->withQueryString();

        return view('Subalternativaep.index', compact('Subalternativaep', 'buscar'));
    }

    public function create()
    {
        return view('Subalternativaep.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre' => 'required|string|max:100',
            'Descripcion' => 'required|string|max:200',
        ]);

        subalternativaep::create($data);

        return redirect()->route('Subalternativaep.index')
            ->with('success', 'Registro guardado correctamente');
    }

    public function show(subalternativaep $Subalternativaep)
    {
        // Nota: Pasamos la variable en singular para la vista
        return view('Subalternativaep.show', ['sub' => $Subalternativaep]);
    }

    public function edit(subalternativaep $Subalternativaep)
    {
        // Usamos 'sub' para que el formulario dual funcione fácilmente
        return view('Subalternativaep.create', ['sub' => $Subalternativaep]);
    }

    public function update(Request $request, subalternativaep $Subalternativaep)
    {
        $data = $request->validate([
            'Nombre' => 'required|string|max:100',
            'Descripcion' => 'required|string|max:200',
        ]);

        $Subalternativaep->update($data);

        return redirect()->route('Subalternativaep.index')
            ->with('success', 'Registro actualizado correctamente');
    }

    public function destroy(subalternativaep $Subalternativaep)
    {
        $Subalternativaep->delete();

        return redirect()->route('Subalternativaep.index')
            ->with('success', 'Registro eliminado correctamente');
    }
}
