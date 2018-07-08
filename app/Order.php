<?php

namespace App;

use DB; 
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $guarded = ['id']; 

    public static function persist()
    {
        return DB::transaction(function(){
            $instance = (new static)->fill([
                'user_id' => auth()->user()->id, 
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
}
