<?php

namespace Tests\Feature;

use App\User;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;

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

        $data = json_decode($response)->data; 

        $this->assertEquals($product->name, $data->name); 
        $this->assertCount(6, str_split($data->unq_code)); 
        $this->assertNotNull($data->qr_code_path);
    }


    /**
     * @test
     */
    public function a_user_can_view_a_created_product()
    {
        $product = factory(Product::class)->create();

        $response = $this->actingAs($this->user)
        ->get('/products/' . $product->unq_code)
        ->assertStatus(200)
        ->assertSee($product->name)
        ->assertSee($product->description)
        ->assertSee($product->unq_code); 
    }


    /**
     * @test
     */
    public function a_user_can_update_a_product()
    {
        $product = factory(Product::class)->create();
        
        $newOrder = factory(Product::class)->make([
            'name' => 'Updated Name', 
            'description' => 'Updated desc'
        ]); 

        $response = $this->actingAs($this->user)
        ->json('PUT','/products/' . $product->unq_code, $newOrder->toArray())
        ->assertStatus(200)
        ->getContent(); 

        $response = json_decode($response)->data; 

        $this->assertEquals($product->fresh()->id, $response->id); 
        $this->assertEquals($product->fresh()->name, "Updated Name"); 
        $this->assertEquals($product->fresh()->description, "Updated desc"); 
    }



    /**
     * @test
     */
    public function a_user_can_delete_a_product()
    {
        $product = factory(Product::class)->create();

        $response = $this->actingAs($this->user)
        ->json('DELETE','/products/' . $product->unq_code);
        
        $this->assertNotNull($product->fresh()->deleted_at); 
    }


    protected function makeProduct()
    {
        return factory(Product::class)->make(); 
    }

}
