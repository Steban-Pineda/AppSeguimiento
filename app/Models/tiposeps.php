<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tiposeps extends Model
{
    //
    use HasFactory;
    protected $table = 'tbl_tiposeps';

    protected $fillable = [
        'NIS', 'numdoc', 'Denominacion', 'Observaciones'
    ];

    public $timestamps = false;


}
