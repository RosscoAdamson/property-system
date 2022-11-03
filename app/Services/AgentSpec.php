<?php

namespace App\Services;

use App\Models\Agent;

class AgentSpec
{
    public function __construct(protected Agent $agent, protected array $competingAgents = [])
    {
    }

    public function addCompetingAgent(Agent $competingAgent): void
    {
        if (!$this->competingAgentExists($competingAgent)) {
            $this->competingAgents[$competingAgent->id] = [
                'agent' => $competingAgent->setHidden(['pivot']),
                'properties_in_common' => 0
            ];
        }

        $this->competingAgents[$competingAgent->id]['properties_in_common']++;
    }

    public function competingAgentExists(Agent $competingAgent): bool
    {
        return array_key_exists($competingAgent->id, $this->competingAgents);
    }

    public function canIncludeInResult(): bool
    {
        $this->competingAgents = array_filter($this->competingAgents, function ($competingAgent) {
            return $competingAgent['properties_in_common'] >= 2;
        });

        return !empty($this->competingAgents);
    }

    public function getResult(): array
    {
        return [
            'agent' => $this->agent->setHidden(['properties_count', 'properties']),
            'competing_agents' => array_values($this->competingAgents)
        ];
    }
}
