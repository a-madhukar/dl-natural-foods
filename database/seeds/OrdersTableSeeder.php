<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Product;
use App\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = factory(User::class, 10)->create(); 

        $products = factory(Product::class, 10)->create(); 

        $users->each(function($user) use ($products){
            $products->each(function($product) use ($user){
                factory(Order::class, 10)->create([
                    'user_id' => $user->id, 
                    'product_id' => $product->id, 
                ]); 
            }); 
        }); 
    }
}
