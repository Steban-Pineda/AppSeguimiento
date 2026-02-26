<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alternativaep extends Model
{
    //
    //
    use HasFactory;
    protected $table = 'tbl_alternativaep';
    protected $primaryKey = 'NIS';
    protected $fillable = [
        'NIS', 'Nombre', 'Descripcion'
    ];

    public $timestamps = false;

}
