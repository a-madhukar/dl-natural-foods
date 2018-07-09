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


    public function store()
    {
        return response()->json([
            "data" => Product::persist()
        ], 201); 
    }


    public function generateBarcode(Product $product)
    {
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new ImagickImageBackEnd()
        );
        $writer = new Writer($renderer);

        $writer->writeFile(
            'https://9eb837a4.ngrok.io/orders/create?default=' . $product->unq_code, 
            'qrcode.png'
        );

        return response()->download("qrcode.png", sprintf("%s_code.png", $product->unq_code))
        ->deleteFileAfterSend(true);
    }

}
