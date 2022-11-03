<?php

namespace Tests\Feature;

use App\Models\Agent;
use App\Models\Property;
use Database\Seeders\AgentSeeder;
use Database\Seeders\PropertySeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class PropertyTests extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function test_index_should_view_no_properties()
    {
        $this->get('/properties')
            ->assertInertia(
                fn (Assert $page) => $page
                ->component('Properties/Index')
                ->has('properties', 0)
            );
    }

    public function test_index_should_view_properties()
    {
        $this->seed();

        $this->get('/properties')
            ->assertInertia(
                fn (Assert $page) => $page
                ->component('Properties/Index')
                ->has('properties', 30)
            );
    }

    public function test_viewing_an_individual_property()
    {
        $this->seed([
            PropertySeeder::class,
            AgentSeeder::class
        ]);

        $this->get('/properties/1')
            ->assertInertia(
                fn (Assert $page) => $page
                ->component('Properties/Property')
                ->has('property')
                ->has('unassignedAgents', 10)
            );
    }

    public function test_should_fail_when_attempting_to_attach_an_agent_to_a_property_with_an_invalid_payload()
    {
        $this->seed();

        $response = $this->json('POST', '/properties/fail/agents', []);

        $response->assertStatus(422);

        $errors = json_decode($response->getContent(), true)['errors'];

        $this->assertArrayHasKey('id', $errors);
    }

    public function test_should_fail_when_attempting_to_attach_an_agent_to_an_invalid_property()
    {
        $agent = Agent::factory()->create();

        $response = $this->json('POST', '/properties/99/agents', [
            'id' => $agent->id
        ]);

        $response->assertStatus(404);
    }

    public function test_should_pass_when_attaching_an_agent_to_a_property()
    {
        $this->seed([
            PropertySeeder::class,
            AgentSeeder::class
        ]);

        $response = $this->json('POST', '/properties/1/agents', [
            'id' => 1,
            'can_conduct_viewings' => true
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseCount('agent_property', 1);
        $this->assertDatabaseHas('agent_property', [
            'agent_id' => 1,
            'property_id' => 1
        ]);
    }

    public function test_should_pass_when_updating_an_agent_already_attached_to_a_property()
    {
        $this->seed([
            PropertySeeder::class,
            AgentSeeder::class
        ]);

        Property::find(1)->agents()->attach(1, [
            'can_conduct_viewings' => false,
            'can_sell_property' => false
        ]);

        $this->assertDatabaseHas('agent_property', [
            'agent_id' => 1,
            'property_id' => 1,
            'can_conduct_viewings' => 0,
            'can_sell_property' => 0
        ]);

        $response = $this->json('POST', '/properties/1/agents/1', [
            'id' => 1,
            'can_conduct_viewings' => true,
            'can_sell_property' => true
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseCount('agent_property', 1);
        $this->assertDatabaseHas('agent_property', [
            'agent_id' => 1,
            'property_id' => 1,
            'can_conduct_viewings' => 1,
            'can_sell_property' => 1
        ]);
    }
}
