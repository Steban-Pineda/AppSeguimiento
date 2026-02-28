<?php

namespace App\Http\Controllers;

use App\Models\enteconformador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EnteconformadorController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->get('buscar');

        $enteconformador = enteconformador::when($buscar, function ($query, $buscar) {
            return $query->where('RazonSocial', 'LIKE', "%{$buscar}%")
                ->orWhere('Numdoc', 'LIKE', "%{$buscar}%")
                ->orWhere('NIS', 'LIKE', "%{$buscar}%");
        })
            ->paginate(10)
            ->withQueryString();

        return view('enteconformador.index', compact('enteconformador', 'buscar'));
    }

    public function create()
    {
        return view('enteconformador.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tdoc' => 'required|integer',
            'Numdoc' => 'required|integer|unique:tbl_enteconformador,Numdoc',
            'RazonSocial' => 'required|string|max:100',
            'Direccion' => 'required|string|max:200',
            'Telefono' => 'required|string|max:50',
            'CorreoInstitucional' => 'required|email|max:50',
            'anexo_camara' => 'nullable|mimes:pdf|max:3072'
        ]);

        if ($request->hasFile('anexo_camara')) {
            $data['anexo_camara'] = $this->subirArchivo($request);
        }

        enteconformador::create($data);

        return redirect()->route('enteconformador.index')
            ->with('success', 'Ente registrado correctamente');
    }

    public function show(enteconformador $enteconformador)
    {
        return view('enteconformador.show', ['ente' => $enteconformador]);
    }

    public function edit(enteconformador $enteconformador)
    {
        return view('enteconformador.create', ['ente' => $enteconformador]);
    }

    public function update(Request $request, enteconformador $enteconformador)
    {
        $data = $request->validate([
            'tdoc' => 'required|integer',
            'Numdoc' => "required|integer|unique:tbl_enteconformador,Numdoc,{$enteconformador->NIS},NIS",
            'RazonSocial' => 'required|string|max:100',
            'Direccion' => 'required|string|max:200',
            'Telefono' => 'required|string|max:50',
            'CorreoInstitucional' => 'required|email|max:50',
            'anexo_camara' => 'nullable|mimes:pdf|max:3072'
        ]);

        if ($request->hasFile('anexo_camara')) {
            // Eliminar archivo anterior si existe
            $this->eliminarArchivoFisico($enteconformador->anexo_camara);
            $data['anexo_camara'] = $this->subirArchivo($request);
        }

        $enteconformador->update($data);

        return redirect()->route('enteconformador.index')
            ->with('success', 'Registro actualizado correctamente');
    }

    public function destroy(enteconformador $enteconformador)
    {
        $this->eliminarArchivoFisico($enteconformador->anexo_camara);
        $enteconformador->delete();

        return redirect()->route('enteconformador.index')
            ->with('success', 'Registro y archivo eliminados');
    }

    // Funciones auxiliares para limpieza de código
    private function subirArchivo($request) {
        $rutaCarpeta = public_path('uploads/clientes/camara/');
        if (!file_exists($rutaCarpeta)) {
            mkdir($rutaCarpeta, 0777, true);
        }
        $nombreArchivo = 'cam_' . $request->Numdoc . '_' . time() . '.' . $request->file('anexo_camara')->extension();
        $request->file('anexo_camara')->move($rutaCarpeta, $nombreArchivo);
        return $nombreArchivo;
    }

    private function eliminarArchivoFisico($nombreArchivo) {
        if ($nombreArchivo) {
            $ruta = public_path('uploads/clientes/camara/' . $nombreArchivo);
            if (File::exists($ruta)) {
                File::delete($ruta);
            }
        }
    }
}
