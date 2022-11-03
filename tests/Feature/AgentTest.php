<?php

namespace Tests\Feature;

use App\Models\Agent;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class AgentTests extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function test_index_should_view_no_agents()
    {
        $this->get('/agents')
            ->assertInertia(
                fn (Assert $page) => $page
                ->component('Agents/Index')
                ->has('agents', 0)
            );
    }

    public function test_index_should_view_agents()
    {
        Agent::factory()->count(10)->create();

        $this->get('/agents')
            ->assertInertia(
                fn (Assert $page) => $page
                ->component('Agents/Index')
                ->has('agents', 10)
            );
    }

    public function test_should_fail_when_invalid_request_is_received()
    {
        $response = $this->json('POST', '/agents', []);

        $response->assertStatus(422);

        $errors = json_decode($response->getContent(), true)['errors'];

        $this->assertArrayHasKey('name', $errors);
        $this->assertArrayHasKey('email', $errors);
        $this->assertArrayHasKey('address', $errors);
        $this->assertArrayHasKey('phone_numbers', $errors);
    }

    public function test_should_pass_with_a_valid_agent()
    {
        $agent = Agent::factory()->make();

        $response = $this->json('POST', '/agents', [
            'name' => $agent->name,
            'email' => $agent->email,
            'address' => $agent->address,
            'phone_numbers' => $agent->phone_numbers
        ]);

        $response->assertStatus(201);

        $responseData = json_decode($response->getContent(), true);

        $this->assertDatabaseCount('agents', 1);
        $this->assertDatabaseHas('agents', ['id' => $responseData['agent']['id']]);
    }

    public function test_should_fail_when_updating_an_agent_with_an_invalid_request()
    {
        $response = $this->json('POST', '/agents/fail', []);

        $response->assertStatus(422);

        $errors = json_decode($response->getContent(), true)['errors'];

        $this->assertArrayHasKey('name', $errors);
        $this->assertArrayHasKey('email', $errors);
        $this->assertArrayHasKey('address', $errors);
        $this->assertArrayHasKey('phone_numbers', $errors);
    }

    public function test_should_fail_when_updating_an_agent_that_does_not_exist()
    {
        $agent = Agent::factory()->make();

        $response = $this->json('POST', '/agents/1', [
            'name' => $agent->name,
            'email' => $agent->email,
            'address' => $agent->address,
            'phone_numbers' => $agent->phone_numbers
        ]);

        $response->assertStatus(404);
    }

    public function test_should_pass_when_updating_a_valid_agent()
    {
        $agent = Agent::factory()->create();
        $newAgent = Agent::factory()->make();

        $response = $this->json('POST', '/agents/1', [
            'name' => $newAgent->name,
            'email' => $newAgent->email,
            'address' => $newAgent->address,
            'phone_numbers' => $newAgent->phone_numbers
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseCount('agents', 1);
        $this->assertDatabaseMissing('agents', ['email' => $agent->email]);
    }
}
