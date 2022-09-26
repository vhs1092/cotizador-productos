<?php

namespace App\Http\Controllers\Api\V1;

use App\Product;
use App\ProductMaterials;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return $product;
    }

    public function store(Request $request)
    {   
        
        $product = Product::create($request->all());
        $materiales = $request->materiales;
        
        foreach($materiales as $material) {
            
            ProductMaterials::create([
                'product_id' => $product->id,
                'material_id' => $material['id'],
                'cantidad' => $material['cantidad'],
            ]);    
        }

        return $product;
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return '';
    }
}
