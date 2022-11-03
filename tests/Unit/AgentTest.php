<?php

namespace Test\Unit;

use App\Models\Agent;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AgentTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function test_should_calculate_the_correct_agent_total_property_price()
    {
        $this->seed();

        $agent = Agent::factory()->create();

        $agent->properties()->sync([
            1 => [
                'can_conduct_viewings' => true,
                'can_sell_property' => false
            ],
            2 => [
                'can_conduct_viewings' => false,
                'can_sell_property' => true
            ]
        ]);

        $totalPrice = 0;
        foreach ($agent->properties as $property) {
            $totalPrice += $property->price;
        }

        $response = $this->json('GET', '/api/agents');

        $response->assertStatus(200);

        $data = json_decode($response->getContent(), true);

        $this->assertEquals($totalPrice, $data['agents'][0]['total_price']);
    }
}
