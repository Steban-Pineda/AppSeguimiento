<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programadeformacion extends Model
{
    //
    use HasFactory;
    protected $table = 'tbl_programadeformacion';

    protected $fillable = [
        'NIS', 'Codigo', 'Denominacion', 'Observaciones'
    ];

    public $timestamps = false;


}
