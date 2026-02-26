<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class centrodeformacion extends Model
{
    //
    use HasFactory;
    protected $table = 'tbl_centrodeformacion';
protected $primaryKey = 'NIS';
    protected $fillable = [
        'NIS', 'Codigo', 'Denominacion', 'Direccion', 'Observaciones', 'tbl_regional_NIS'
    ];

    public $timestamps = false;

}
