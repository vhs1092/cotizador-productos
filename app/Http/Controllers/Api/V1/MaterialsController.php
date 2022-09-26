<?php

namespace App\Http\Controllers\Api\V1;

use App\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaterialsController extends Controller
{
    public function index()
    {
        return Material::all();
    }

    public function show($id)
    {
        return Material::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $product = Material::findOrFail($id);
        $product->update($request->all());

        return $product;
    }

    public function store(Request $request)
    {
        $product = Material::create($request->all());
        return $product;
    }

    public function destroy($id)
    {
        $product = Material::findOrFail($id);
        $product->delete();
        return '';
    }
}
