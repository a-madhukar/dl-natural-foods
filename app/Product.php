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
                // 'slug' => request()->slug,
            ]); 

            $instance->save(); 

            return $instance; 
        }); 
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



    public function scopeUnqCode($query, $unqCode)
    {
        return $query->whereUnqCode($unqCode); 
    }



    public function getRouteKeyName()
    {
        return 'unq_code';    
    }


}
