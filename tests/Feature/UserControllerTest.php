<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\Leave;

class UserControllerTest extends TestCase
{

	use RefreshDatabase;

    public function testUserListing()
    {
        $user = factory(User::class)->create(['email' => "admin@admin.com"]);

        $response = $this->actingAs($user)->json('GET', 'user/list');
        
        $response->assertStatus(200);
        
        $data = json_decode($response->getContent(), 1);

        $this->assertCount(1, $data[ 'data' ]);
    }


   


    public function testStoreSingleUser()
    {
        $user = factory(User::class)->create(['email' => "admin@admin.com"]);

        $response = $this->actingAs($user)->json('POST', '/register',
        [
            "name" => "Abhijeet Bagul",
        	"email" => "abhijeet.bagul@gmail.com",
            "password" => "123456",
            "password_confirmation" => "123456",
        	"role" => "admin",
        ]);

        $response->assertStatus(200);
        $data = json_decode($response->getContent(),1);
        $this->assertArrayHasKey('id', $data['data']);

    }

    public function testStoreSingleUserValidationCheck()
    {
        $user = factory(User::class)->create(['email' => "admin@admin.com"]);

        $response = $this->actingAs($user)->json('POST', '/register',
        [
            "name" => "Abhijeet Bagul",
            "email" => "abhijeet.bagul@gmail.com",
            "password" => "123456",
            "password_confirmation" => "123456",
        ]);

        $response->assertStatus(422);


    }

 
    public function testDeleteSingleUser()
    {
        $user = factory(User::class)->create(['email' => "admin@admin.com", "role"=>"super_admin"]);
        
        $response = $this->actingAs($user)->json('DELETE', '/user/' . $user->id);
        $response->assertStatus(200);

    }

    public function testChangeRoleSingleUser()
    {
        $user = factory(User::class)->create(['email' => "admin@admin.com", "role"=>"super_admin"]);
        $user2 = factory(User::class)->create(['email' => "admin1@admin.com", "role"=>"admin"]);
        $response = $this->actingAs($user)->json('PATCH', '/user/changerole/' . $user2->id . "/employee");
        $response->assertStatus(200);
        $data = json_decode($response->getContent(), 1);
        $this->assertEquals("employee", $data[ "data" ]["role"]);

    }
}
