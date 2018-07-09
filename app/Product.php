<?php

namespace App;

use DB;

class Product extends Model
{
    protected $guarded = ['id']; 


    public static function boot()
    {
        parent::boot(); 

        static::creating(function($product){
            $product->unq_code = $product->generateUniqueCode(); 
        }); 
    }


    public static function persist()
    {
        return DB::transaction(function(){
            $instance = (new static)->fill([
                'name' => request()->name, 
                'description' => request()->description, 
                'slug' => request()->slug,
            ]); 

            $instance->save(); 

            return $instance; 
        }); 
    }



    public function generateUniqueCode()
    {
        $chars = str_random(3); 

        $duplicateCount = DB::table('products')
        ->where('unq_code','like',"$chars%")
        ->count() + 100; 

        return $chars . $duplicateCount; 
    }
}
