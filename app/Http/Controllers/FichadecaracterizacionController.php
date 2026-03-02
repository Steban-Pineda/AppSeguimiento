<?php

namespace App\Http\Controllers;

use App\Models\fichadecaracterizacion;
use App\Models\programadeformacion;
use App\Models\centrodeformacion;
use Illuminate\Http\Request;

class FichadecaracterizacionController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->get('buscar');

        $fichadecaracterizacion = fichadecaracterizacion::with(['programa', 'centro'])
            ->when($buscar, function ($query, $buscar) {
                return $query->where('Denominacion', 'LIKE', "%{$buscar}%")
                    ->orWhere('Codigo', 'LIKE', "%{$buscar}%");
            })
            ->paginate(10)
            ->withQueryString();

        return view('Fichadecaracterizacion.index', compact('fichadecaracterizacion', 'buscar'));
    }

    public function create()
    {
        $programas = programadeformacion::all();
        $centros = centrodeformacion::all();
        return view('Fichadecaracterizacion.create', compact('programas', 'centros'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:100',
            'Cupo' => 'required|integer',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'Observaciones' => 'required|string|max:200',
            'tbl_programadeformacion_NIS' => 'required|exists:tbl_programadeformacion,NIS',
            'tbl_centrodeformacion_NIS' => 'required|exists:tbl_centrodeformacion,NIS',
        ]);

        fichadecaracterizacion::create($data);

        return redirect()->route('Fichadecaracterizacion.index')
            ->with('success', 'Ficha guardada correctamente');
    }

    // CAMBIO AQUÍ: La variable debe coincidir con el parámetro de la ruta {Fichadecaracterizacion}
    public function show(fichadecaracterizacion $Fichadecaracterizacion)
    {
        $Fichadecaracterizacion->load(['programa', 'centro']);
        // Pasamos a la vista con el nombre que ya usas allá para no romper nada
        return view('Fichadecaracterizacion.show', ['fichadecaracterizacion' => $Fichadecaracterizacion]);
    }

    // CAMBIO AQUÍ: Variable con F mayúscula
    public function edit(fichadecaracterizacion $Fichadecaracterizacion)
    {
        $programas = programadeformacion::all();
        $centros = centrodeformacion::all();
        return view('Fichadecaracterizacion.create', [
            'fichadecaracterizacion' => $Fichadecaracterizacion,
            'programas' => $programas,
            'centros' => $centros
        ]);
    }

    // CAMBIO AQUÍ: Variable con F mayúscula
    public function update(Request $request, fichadecaracterizacion $Fichadecaracterizacion)
    {
        $data = $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:100',
            'Cupo' => 'required|integer',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'Observaciones' => 'required|string|max:200',
            'tbl_programadeformacion_NIS' => 'required|exists:tbl_programadeformacion,NIS',
            'tbl_centrodeformacion_NIS' => 'required|exists:tbl_centrodeformacion,NIS',
        ]);

        $Fichadecaracterizacion->update($data);

        return redirect()->route('Fichadecaracterizacion.index')
            ->with('success', 'Ficha actualizada correctamente');
    }

    // CAMBIO AQUÍ: Variable con F mayúscula
    public function destroy(fichadecaracterizacion $Fichadecaracterizacion)
    {
        try {
            $Fichadecaracterizacion->delete();
            return redirect()->route('Fichadecaracterizacion.index')
                ->with('success', 'Ficha eliminada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('Fichadecaracterizacion.index')
                ->with('error', 'No se puede eliminar la ficha porque tiene registros asociados.');
        }
    }
}
