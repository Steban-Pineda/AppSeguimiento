<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fichadecaracterizacion extends Model
{
    //
    use HasFactory;
    protected $table = 'tbl_fichadecaracterizacion';
protected $primaryKey = 'NIS';
    protected $fillable = [
        'NIS', 'Codigo', 'Denominacion', 'Cupo', 'fechaInicio', 'fechaFin', 'Observaciones', 'tbl_programadeformacion_NIS', 'tbl_centrodeformacion_NIS'
    ];

    public $timestamps = false;


}
