<?php

namespace App\Http\Controllers;

use App\Models\aprendices;
use App\Models\tiposdocumento;
use App\Models\tiposeps;
use App\Models\fichadecaracterizacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AprendicesController extends Controller
{

    // ─── Helpers privados ───────────────────────────────────────────────────

    /** Verifica si el usuario logueado es Aprendiz (role 3) */
    private function esAprendiz(): bool
    {
        return Auth::user()->role === 3;
    }

    /**
     * Busca el aprendiz vinculado al usuario logueado.
     * Lanza 404 si no tiene perfil asociado.
     */
    private function miAprendiz(): aprendices
    {
        $aprendiz = aprendices::where('CorreoPersonal', Auth::user()->email)->first();
        abort_if(!$aprendiz, 404, 'No se encontró tu registro de aprendiz.');
        return $aprendiz;
    }

    /**
     * Verifica que el aprendiz pertenece al usuario logueado (si es role 3).
     * Lanza 403 si intenta ver/editar datos de otro.
     */
    private function verificarPropietario(aprendices $aprendiz): void
    {
        if ($this->esAprendiz() && $aprendiz->CorreoPersonal !== Auth::user()->email) {
            abort(403, 'No tienes permiso para acceder a este perfil.');
        }
    }

    // ─── CRUD ───────────────────────────────────────────────────────────────

    /**
     * index: Solo Admin/Instructor (role 1 o 2).
     * Si un aprendiz intenta entrar, se redirige a su propio perfil.
     */
    public function index()
    {
        if ($this->esAprendiz()) {
            $aprendiz = $this->miAprendiz();
            return redirect()->route('Aprendices.show', $aprendiz->NIS);
        }

        $Aprendiz = aprendices::with(['tipoDocumento', 'eps', 'ficha'])->get();
        return view('Aprendices.index', compact('Aprendiz'));
    }

    /**
     * create: Solo Admin/Instructor.
     */
    public function create()
    {
        abort_if($this->esAprendiz(), 403, 'No tienes permiso para crear registros.');

        return view('Aprendices.create', [
            'tiposDoc' => tiposdocumento::all(),
            'eps'      => tiposeps::all(),
            'fichas'   => fichadecaracterizacion::all(),
        ]);
    }

    /**
     * store: Crea aprendiz + usuario automáticamente en transacción.
     */
    public function store(Request $request)
    {
        abort_if($this->esAprendiz(), 403);

        $data = $request->validate([
            'Numdoc'                       => 'required|integer|unique:tbl_aprendices,Numdoc',
            'Nombres'                      => 'required|string|max:100',
            'Apellidos'                    => 'required|string|max:200',
            'sexo'                         => 'required|integer|in:1,2',
            'Direccion'                    => 'required|string|max:200',
            'Telefono'                     => 'required|string|max:200',
            'CorreoInstitucional'          => 'required|email|unique:tbl_aprendices,CorreoInstitucional',
            'CorreoPersonal'               => 'required|email|unique:tbl_aprendices,CorreoPersonal|unique:users,email',
            'fechaNacimiento'              => 'required|date',
            'tbl_tiposdocumento_NIS'       => 'required|exists:tbl_tiposdocumento,NIS',
            'tbl_tiposeps_NIS'             => 'required|exists:tbl_tiposeps,NIS',
            'tbl_fichadecaracterizacion_NIS'=> 'required|exists:tbl_fichadecaracterizacion,NIS',
        ]);

        DB::beginTransaction();
        try {
            $aprendiz = aprendices::create($data);

            User::create([
                'name'     => $data['Nombres'] . ' ' . $data['Apellidos'],
                'email'    => $data['CorreoPersonal'],   // ← clave de la relación
                'password' => Hash::make($data['Numdoc']),
                'role'     => 3,
            ]);

            DB::commit();

            return redirect()->route('Aprendices.index')
                ->with('success', 'Aprendiz registrado. Contraseña inicial: número de documento.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error al registrar: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * show: Aprendiz solo ve el suyo, Admin/Instructor ven cualquiera.
     */
    public function show($id)
    {
        $aprendiz = aprendices::with(['tipoDocumento', 'eps', 'ficha'])->findOrFail($id);

        $this->verificarPropietario($aprendiz);

        return view('Aprendices.show', compact('aprendiz'));
    }

    /**
     * edit: Aprendiz solo edita el suyo (campos limitados en la vista).
     */
    public function edit($id)
    {
        $aprendiz = aprendices::findOrFail($id);

        $this->verificarPropietario($aprendiz);

        return view('Aprendices.create', [
            'aprendiz' => $aprendiz,
            'tiposDoc' => tiposdocumento::all(),
            'eps'      => tiposeps::all(),
            'fichas'   => fichadecaracterizacion::all(),
        ]);
    }

    /**
     * update: Aprendiz solo actualiza el suyo.
     */
    public function update(Request $request, $id)
    {
        $aprendiz = aprendices::findOrFail($id);

        $this->verificarPropietario($aprendiz);

        $data = $request->validate([
            'Numdoc'                        => 'required|integer|unique:tbl_aprendices,Numdoc,' . $id . ',NIS',
            'Nombres'                       => 'required|string|max:100',
            'Apellidos'                     => 'required|string|max:200',
            'sexo'                          => 'required|integer|in:1,2',
            'Direccion'                     => 'required|string|max:200',
            'Telefono'                      => 'required|string|max:200',
            'tbl_tiposdocumento_NIS'        => 'required|exists:tbl_tiposdocumento,NIS',
            'tbl_tiposeps_NIS'              => 'required|exists:tbl_tiposeps,NIS',
            'tbl_fichadecaracterizacion_NIS'=> 'required|exists:tbl_fichadecaracterizacion,NIS',
        ]);

        $aprendiz->update($data);

        // Redirige según el rol
        $ruta = $this->esAprendiz()
            ? redirect()->route('Aprendices.show', $aprendiz->NIS)
            : redirect()->route('Aprendices.index');

        return $ruta->with('success', 'Información actualizada correctamente.');
    }

    /**
     * destroy: Solo Admin/Instructor.
     */
    public function destroy($id)
    {
        abort_if($this->esAprendiz(), 403, 'Un aprendiz no puede eliminar registros.');

        aprendices::findOrFail($id)->delete();

        return redirect()->route('Aprendices.index')
            ->with('success', 'Aprendiz eliminado con éxito.');
    }
}
