<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Inventory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_inventory_api_ok(): void
    {
        $response = $this->get('/api/inventory');

        $response->assertStatus(200);
    }

    public function test_inventory_api_item_one_ok(): void
    {

        $this -> seed();

        $firstID = Inventory::first() -> id;
        $response = $this->get('/api/inventory/'.$firstID);

        $response->assertStatus(200);
    }
}
