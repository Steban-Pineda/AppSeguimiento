<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rolesadministrativos extends Model
{
    //
    use HasFactory;
    protected $table = 'tbl_rolesadministrativos';
protected $primaryKey = 'NIS';
    protected $fillable = [
        'NIS', 'Descripcion'
    ];

    public $timestamps = false;


}
