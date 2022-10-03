<?php

namespace App\Http\Controllers\Api\V1;

use App\Product;
use App\ProductMaterials;
use App\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();

        foreach($products as &$product) {
            $product->materiales = $this->getProductMaterials($product);
        }
        return $products;
    }

    private function getProductMaterials($product){
        
        $query = ProductMaterials::where('product_id', $product->id)->get();

        $result = [];
        foreach ($query as $key => $q) {
            $data['material'] = Material::find($q->material_id);
            $data['cantidad'] = $q->cantidad;
            $result[] = $data;
        }

        return $result;

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
