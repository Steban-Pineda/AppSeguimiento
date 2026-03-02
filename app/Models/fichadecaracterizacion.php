<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fichadecaracterizacion extends Model
{
    use HasFactory;

    protected $table = 'tbl_fichadecaracterizacion';
    protected $primaryKey = 'NIS';

    // Al ser NIS autoincremental
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'Codigo',
        'Denominacion',
        'Cupo',
        'fechaInicio',
        'fechaFin',
        'Observaciones',
        'tbl_programadeformacion_NIS',
        'tbl_centrodeformacion_NIS'
    ];

    public $timestamps = false;

    /**
     * Relación con el Programa de Formación
     */
    public function programa()
    {
        // El NIS de la tabla ficha apunta al NIS de la tabla programas
        return $this->belongsTo(programadeformacion::class, 'tbl_programadeformacion_NIS', 'NIS');
    }

    /**
     * Relación con el Centro de Formación
     */
    public function centro()
    {
        // El NIS de la tabla ficha apunta al NIS de la tabla centros
        return $this->belongsTo(centrodeformacion::class, 'tbl_centrodeformacion_NIS', 'NIS');
    }
}
