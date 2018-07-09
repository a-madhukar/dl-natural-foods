<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
    //


    public function store()
    {
        return response()->json([
            "data" => Product::persist()
        ], 201); 
    }
}
