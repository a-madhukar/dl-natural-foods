<?php

namespace App;

use DB;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;

class Product extends Model
{
    protected $guarded = ['id']; 


    public static function boot()
    {
        parent::boot(); 

        static::creating(function($product){
            $product->unq_code = $product->generateUniqueCode(); 

            $product->qr_code_path = $product->generateQRCode(); 
        }); 
    }


    public static function persist()
    {
        return DB::transaction(function(){
            $instance = (new static)->fill([
                'name' => request()->name, 
                'description' => request()->description, 
            ]); 

            $instance->save(); 

            return $instance; 
        }); 
    }


    public function updateInstance()
    {
        $this->fill([
            'name' => request()->name, 
            'description' => request()->description, 
        ]); 

        $this->save(); 

        return $this; 
    }


    public static function findByUnqCode($code)
    {
        return static::unqCode($code)->first(); 
    }



    protected function generateUniqueCode()
    {
        $chars = strtoupper(str_random(3)); 

        $duplicateCount = DB::table('products')
        ->where('unq_code','like',"$chars%")
        ->count() + 100; 

        return $chars . $duplicateCount; 
    }


    protected function generateQRCode()
    {
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new ImagickImageBackEnd()
        );
        $writer = new Writer($renderer);

        $filePath = sprintf("%s/QR_%s.png", storage_path('app/public'), $this->unq_code); 

        $writer->writeFile(
            sprintf("%s/orders/create?default=%s", env('APP_URL'), $this->unq_code), 
            $filePath
        );

        return sprintf("storage/QR_%s.png", $this->unq_code); 
    }



    public function scopeUnqCode($query, $unqCode)
    {
        return $query->whereUnqCode($unqCode); 
    }



    public function getRouteKeyName()
    {
        return 'unq_code';    
    }


    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id'); 
    }
}
