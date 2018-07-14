<?php

namespace Tests\Feature;

use App\User; 
use App\Order; 
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OrdersTest extends TestCase
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
    public function only_a_authenticated_user_can_see_order_create_form()
    {
        $this->get('/orders/create')
        ->assertRedirect('/login'); 
    }


    
    /**
     * @test
     */
    public function a_user_can_make_a_order()
    {     
        $order = factory(Order::class)->make(); 
        
        $response = $this->actingAs($this->user)
        ->post('/orders',$order->toArray())
        ->assertStatus(201)
        ->getContent();

        $this->assertEquals($order->price, json_decode($response)->data->price); 
    }


    /**
     * @test
     */
    public function every_order_belongs_to_a_product()
    {
        $order = factory(Order::class)->create();
        
        $this->assertTrue(!is_null($order->product)); 
    }


    /**
     * @test
     */
    public function a_user_can_see_past_orders_in_dashboard()
    {
        $order = factory(Order::class)->create(); 

        $response = $this->actingAs($this->user)
        ->get('home')
        ->assertStatus(200); 

        $response->assertSeeText($order->store_name); 

    }

}
