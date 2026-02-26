<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instructor extends Model
{
    //
    use HasFactory;
    protected $table = 'tbl_instructor';
protected $primaryKey = 'NIS';
    protected $fillable = [
        'NIS', 'Numdoc', 'Nombres', 'Apellidos', 'Direccion', 'Telefono', 'CorreoInstitucional', 'CorreoPersonal', 'sexo', 'fechaNacimiento', 'tbl_rolesadministrativos_NIS1', 'tbl_tiposeps_NIS1', 'tbl_tiposdocumento_NIS'
    ];

    public $timestamps = false;


}
