<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ActiveUsersTest extends TestCase
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
    public function an_inactive_user_cannot_access_the_application()
    {
        $this->actingAs($this->user)
        ->get('/home')
        ->assertRedirect('account/send-activation-email'); 
    }


}
