<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class aprendices extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_aprendices';
    protected $primaryKey = 'NIS';

    protected $fillable = [
        'NIS',
        'Numdoc',
        'Nombres',
        'Apellidos',
        'Direccion',
        'Telefono',
        'CorreoInstitucional',
        'CorreoPersonal',
        'sexo',
        'fechaNacimiento',
        'tbl_tiposdocumento_NIS',
        'tbl_tiposeps_NIS',
        'tbl_fichadecaracterizacion_NIS'
    ];

    public $timestamps = false;

    // --- RELACIONES (Para traer nombres en lugar de IDs) ---

    /**
     * Relación con el Tipo de Documento
     */
    public function tipoDocumento()
    {
        return $this->belongsTo(tiposdocumento::class, 'tbl_tiposdocumento_NIS', 'NIS');
    }

    /**
     * Relación con la EPS
     */
    public function eps()
    {
        return $this->belongsTo(tiposeps::class, 'tbl_tiposeps_NIS', 'NIS');
    }

    /**
     * Relación con la Ficha de Caracterización
     */
    public function ficha()
    {
        return $this->belongsTo(fichadecaracterizacion::class, 'tbl_fichadecaracterizacion_NIS', 'NIS');
    }
    public function routeNotificationForMail($notification)
    {
        return 'steban19pin@gmail.com';
    }

    // --- ACCESORES (Transformación de datos para la vista) ---

    /**
     * Convierte el entero (1 o 2) en texto legible.
     * Uso en vista: $aprendiz->sexo_texto
     */
    public function getSexoTextoAttribute()
    {
        return match ($this->sexo) {
            1 => 'Masculino',
            2 => 'Femenino',
            default => 'No definido',
        };
    }
}
