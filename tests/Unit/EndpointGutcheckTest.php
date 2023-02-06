<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\DeeDee;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class EndpointGutcheckTest extends TestCase
{
    use WithoutMiddleware;

    
    public function test_fetch_resource()
    {
        $this->get('/api/deedee')->assertStatus(200);
    }

    public function test_get_resource()
    {
        DeeDee::factory()->create(['id' => 1]);
        $this->get('/api/deedee/1')->assertStatus(200);
    }

    public function test_post_resource()
    {
        $this->post('/api/deedee', DeeDee::factory()->create()->toArray())->assertStatus(201);
    }

    public function test_put_resource()
    {   
        $deedee = DeeDee::factory()->create();
 
        $this->putJSON("/api/deedee/$deedee->id", $deedee->toArray())->assertStatus(200);
    }

    public function test_delete_resource()
    {   
        DeeDee::factory()->create(['id' => 1, 'surname' => 'oldname']);
        $this->delete('/api/deedee/1', ['id' => 1, 'surname' => 'newname'])->assertStatus(200);
    }

   
}

