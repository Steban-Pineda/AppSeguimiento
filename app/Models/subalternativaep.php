<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subalternativaep extends Model
{
    //
    use HasFactory;
    protected $table = 'tbl_subalternativaep';
    protected $primaryKey = 'NIS';
    protected $fillable = [
        'NIS', 'Nombre', 'Descripcion'
    ];

    public $timestamps = false;


}
