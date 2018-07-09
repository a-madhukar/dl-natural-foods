<?php

namespace Tests\Feature;

use App\User;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductsTest extends TestCase
{
    use DatabaseMigrations; 

    public function setUp()
    {
        parent::setUp(); 

        $this->user = factory(User::class)->create();  
    }

    
    /**
     * @test
     */
    public function a_user_can_add_a_new_product()
    {
        $product = $this->makeProduct(); 

        $response = $this->actingAs($this->user)
        ->post('products', $product->toArray())
        ->getContent(); 

        $this->assertEquals($product->name, json_decode($response)->data->name); 
    }



    /**
     * 
     */
    public function a_product_will_have_a_unique_code_once_it_is_created()
    {
        $product = $this->makeProduct(); 

        $response = $this->actingAs($this->user)
        ->post('products', $product->toArray())
        ->getContent(); 
        // dd(json_decode($response->getContent())); 

        $this->assertCount(6, str_split(json_decode($response)->data->unq_code)); 

    }


    protected function makeProduct()
    {
        return factory(Product::class)->make(); 
    }

}
