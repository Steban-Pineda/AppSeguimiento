<?php

namespace App\Http\Controllers;

use App\Models\regional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RegionalController extends Controller
{
    /**
     * Lista con Buscador
     */
    public function index(Request $request)
    {
        $buscar = $request->get('buscar');

        $Regional = Regional::when($buscar, function ($query, $buscar) {
            return $query->where('Denominacion', 'LIKE', "%{$buscar}%")
                ->orWhere('Codigo', 'LIKE', "%{$buscar}%")
                ->orWhere('NIS', 'LIKE', "%{$buscar}%");
        })->paginate(10) // Trae de 10 en 10
        ->withQueryString(); // Mantiene el parámetro 'buscar' en los links;

        return view('Regional.index', compact('Regional', 'buscar'));
    }

    public function create()
    {
        return view('Regional.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:200',
            'Observaciones' => 'required|string|max:200'
        ]);

        // Si decides encriptar, descomenta la siguiente línea:
        // $data['Observaciones'] = Crypt::encryptString($data['Observaciones']);

        regional::create($data);

        return redirect()->route('Regional.index')
            ->with('success', 'Regional guardada correctamente');
    }

    /**
     * Ver Detalle
     */
    public function show(regional $Regional)
    {
        return view('Regional.show', compact('Regional'));
    }

    /**
     * Formulario Editar
     */
    public function edit(regional $Regional)
    {
        return view('Regional.create', compact('Regional'));
    }

    /**
     * Actualizar Registro
     */
    public function update(Request $request, regional $Regional)
    {
        $data = $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:200',
            'Observaciones' => 'required|string|max:200'
        ]);

        $Regional->update($data);

        return redirect()->route('Regional.index')
            ->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Eliminar con Protección
     */
    public function destroy(regional $Regional)
    {
        try {
            $Regional->delete();
            return redirect()->route('Regional.index')
                ->with('success', 'Regional eliminada correctamente');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect()->route('Regional.index')
                    ->with('error', 'No se puede eliminar: esta regional tiene centros vinculados.');
            }
            return redirect()->route('Regional.index')
                ->with('error', 'Ocurrió un error al intentar eliminar.');
        }
    }
}
