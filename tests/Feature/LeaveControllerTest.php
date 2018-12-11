<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\Leave;

class LeaveControllerTest extends TestCase
{

	use RefreshDatabase;

    public function testLeaveListing()
    {
        $user = factory(User::class)->create(['email' => "admin@admin.com"]);
        factory(Leave::class)->create([ 'user_id' => $user->id ]);

        $response = $this->actingAs($user)->json('GET', 'leave/list');
        
        $response->assertStatus(200);
        
        $data = json_decode($response->getContent(), 1);

        $this->assertCount(1, $data[ 'data' ]);
    }


   


    public function testStoreSingleLeave()
    {
        $user = factory(User::class)->create(['email' => "admin@admin.com"]);

        $response = $this->actingAs($user)->json('POST', '/leave',
        [
            "from_date" => date( "Y-m-d" ),
        	"to_date" => date( "Y-m-d" ),
        	"reason" => "test reason",
        ]);
        $response->assertStatus(200);
        $data = json_decode($response->getContent(),1);
        $this->assertArrayHasKey('id', $data['data']);


    }

    public function testStoreSingleLeaveValidationCheck()
    {
        $user = factory(User::class)->create(['email' => "admin@admin.com"]);

        $response = $this->actingAs($user)->json('POST', '/leave',
        [
            "to_date" => date( "Y-m-d" ),
            "reason" => "test reason",
        ]);

        $response->assertStatus(422);


    }

 
    public function testDeleteSingleSubscription()
    {
        $user = factory(User::class)->create(['email' => "admin@admin.com"]);
        $leave = factory(Leave::class)->create([ 'user_id' => $user->id ]);
        
        $response = $this->actingAs($user)->json('DELETE', '/leave/' . $leave->id);
        $data = json_decode($response->getContent(),1);
        $response->assertStatus(200);

    }
}
