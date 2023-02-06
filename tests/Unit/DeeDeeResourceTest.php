<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\DeeDee;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class DeeDeeResourceTest extends TestCase
{
    

    /**
     * Test that resources are returned when we have them in the database
     *
     * @return void
     */
    public function test_fetch_action()
    {
        DeeDee::factory()->count(50)->create();
        
        $response = $this->getJson('/api/deedee');

        $response->assertJsonCount(15, 'data');

    }

    public function test_get_action(){
        $deedee = DeeDee::factory()->create();
    
        $response = $this->getJson("/api/deedee/$deedee->id");
 
        $response->assertJsonFragment($deedee->toArray());

        }


    public function test_post_validation(){
        $response = $this->postJson('/api/deedee',['']);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['surname' => [], 'character_name' => [],'character_level' => [], 'age' => [], 'character_type' => [] ]]);
    }

    public function test_post_action(){
        $deedee = DeeDee::factory()->make()->toArray();

        $response = $this->postJson('/api/deedee', $deedee);
    
        $response->assertStatus(201);
        $response->assertJson($deedee);
    }

    public function test_put_validation(){
        $deedee = DeeDee::factory()->create();
        $response = $this->putJson("/api/deedee/$deedee->id", ['id' => $deedee->id]);

        $response->assertStatus(422);
        
    }


    public function test_put_action(){
       
        $deedee = DeeDee::factory()->create();
        $deedee->surname = Str::reverse($deedee->surname);
        $response = $this->putJson("/api/deedee/$deedee->id", $deedee->toArray());
        
        $this->assertSame($response->json('surname'), $deedee->surname);
        
    }

    public function test_delete_action(){
       

        $deedee = DeeDee::factory()->create();

       
        $this->assertDatabaseHas($deedee, $deedee->toArray());
        
        // $response = $this->deleteJson("/api/deedee/{$deedee->id}");

        // $this->assertDatabaseMissing($deedee, $deedee->toArray());
    }
   
}

