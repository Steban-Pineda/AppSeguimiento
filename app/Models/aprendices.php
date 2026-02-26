<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aprendices extends Model
{
    //hujjk
    //
    use HasFactory;
    protected $table = 'tbl_aprendices';
    protected $primaryKey = 'NIS';
    protected $fillable = [
        'NIS', 'Numdoc', 'Nombres', 'Apellidos', 'Direccion', 'Telefono', 'CorreoInstitucional', 'CorreoPersonal', 'sexo', 'fechaNacimiento', 'tbl_tiposdocumento_NIS', 'tbl_tiposeps_NIS', 'tbl_fichadecaracterizacion_NIS'
    ];

    public $timestamps = false;

}
