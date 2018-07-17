<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class ProductsController extends Controller
{
    //


    public function create()
    {
        return view('products.create'); 
    }


    public function show(Product $product)
    {
        if(request()->type == "json") 
        {
            return response()->json([
                'data' => $product
            ],200); 
        }

        return view('products.show', compact('product')); 
    }


    public function store()
    {
        return response()->json([
            "data" => Product::persist()
        ], 201); 
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product')); 
    }


    public function update(Product $product)
    {
        return response()->json([
            'data' => $product->updateInstance()
        ], 200); 
    }


    public function downloadBarcode(Product $product)
    {
        return response()->download($product->qr_code_path);
    }


    public function destroy(Product $product)
    {
        $product->delete(); 
        
        return redirect()->home(); 
    }

}
