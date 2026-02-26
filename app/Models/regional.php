<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class regional extends Model
{

    //
    use HasFactory;
    protected $table = 'tbl_regional';
protected $primaryKey = 'NIS';
    protected $fillable = [
        'NIS',
        'Codigo',
        'Denominacion',
        'Observaciones',
        ];

    public $timestamps = false;
}
