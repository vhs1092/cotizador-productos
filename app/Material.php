<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = "materials";
    protected $fillable = ['nombre', 'alto', 'ancho', 'unitario', 'lineal'];

     protected $casts = [
        'unitario' => 'boolean',
    ];

}
