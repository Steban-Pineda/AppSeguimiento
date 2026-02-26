<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enteconformador extends Model
{
    //
    use HasFactory;
    protected $table = 'tbl_enteconformador';
protected $primaryKey = 'NIS';
    protected $fillable = [
        'NIS', 'tdoc', 'Numdoc', 'RazonSocial', 'Direccion', 'Telefono', 'CorreoInstitucional'
    ];

    public $timestamps = false;



}
