<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMaterials extends Model
{
    protected $table = "products_materials";
    protected $fillable = ['product_id', 'material_id', 'cantidad'];
}
