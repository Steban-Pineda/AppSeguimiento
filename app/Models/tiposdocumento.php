<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tiposdocumento extends Model
{
    //
    //
    use HasFactory;
    protected $table = 'tbl_tiposdocumento';
protected $primaryKey = 'NIS';
    protected $fillable = [
        'Denominacion', 'Observaciones'
    ];

    public $timestamps = false;


}
