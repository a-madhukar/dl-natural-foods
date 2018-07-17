<?php

namespace App;

use DB; 

class Order extends Model
{

    public static function persist()
    {
        return DB::transaction(function(){
            $instance = (new static)->fill([
                'user_id' => auth()->user()->id, 
                'product_id' => request()->product_id, 
                'quantity' => request()->quantity, 
                'price' => request()->price, 
                'date' => request()->date, 
                'store_name' => request()->store_name, 
                'comments' => request()->comments, 
            ]); 

            $instance->save(); 

            return $instance; 
        }); 
    }


    public function updateInstance()
    {
        $this->fill([
            // 'user_id' => auth()->user()->id, 
            // 'product_id' => request()->product_id, 
            'quantity' => request()->quantity, 
            'price' => request()->price, 
            'date' => request()->date, 
            'store_name' => request()->store_name, 
            'comments' => request()->comments, 
        ]); 

        $this->save(); 

        return $this; 
    }


    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100; 
    }


    public function getPriceAttribute($value)
    {
        return $value/100; 
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id'); 
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }
}
