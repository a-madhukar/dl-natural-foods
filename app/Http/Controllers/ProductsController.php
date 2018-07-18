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

    public function index()
    {
        $this->authorizeUser(); 

        $products = Product::when(request()->unq_code, function($query){
            $query->whereUnqCode(request()->unq_code); 
        })
        ->paginate(30);

        $codes = Product::pluck('unq_code')->unique();

        return view('products.index', compact('products', 'codes')); 
    }


    public function create()
    {
        $this->authorizeUser(); 

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

        $this->authorizeUser(); 

        return view('products.show', compact('product')); 
    }


    public function store()
    {
        $this->authorizeUser(); 

        return response()->json([
            "data" => Product::persist()
        ], 201); 
    }


    public function edit(Product $product)
    {
        $this->authorizeUser(); 

        return view('products.edit', compact('product')); 
    }


    public function update(Product $product)
    {
        $this->authorizeUser(); 

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
        $this->authorizeUser(); 

        $product->orders()->delete(); 

        $product->delete(); 
        
        return response()->json([
            'data' => true
        ],200); 
    }



    public function authorizeUser()
    {
        $this->authorize('update', Product::class); 
    }

}
