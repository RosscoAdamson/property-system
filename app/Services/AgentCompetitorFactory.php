<?php

namespace App\Services;

use App\Models\Agent;
use App\Services\AgentSpec;

class AgentCompetitorFactory
{
    protected $agents;

    public function __construct()
    {
        $this->agents = Agent::withCount('properties')
            ->having('properties_count', '>=', 2)
            ->with('properties.agents')
            ->get();
    }

    public function getResult(): array
    {
        $competingAgents = [];

        foreach ($this->agents as $agent) {
            $agentSpec = new AgentSpec($agent);

            foreach ($agent->properties as $property) {
                foreach ($property->agents as $competingAgent) {
                    if ($competingAgent->id === $agent->id) {
                        continue;
                    }

                    $agentSpec->addCompetingAgent($competingAgent);
                }
            }

            if ($agentSpec->canIncludeInResult()) {
                $competingAgents[] = $agentSpec->getResult();
            }
        }

        return $competingAgents;
    }
}
