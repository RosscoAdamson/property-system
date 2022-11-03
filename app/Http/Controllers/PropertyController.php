<?php

namespace App\Http\Controllers;

use App\Http\Requests\Properties\AssignAgentRequest;
use App\Models\Agent;
use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PropertyController extends Controller
{
    public function index()
    {
        return Inertia::render('Properties/Index', [
            'properties' => Property::get()
        ]);
    }

    public function show(Request $request, int $propertyId)
    {
        $property = Property::with('agents')->findOrFail($propertyId);

        $assignedAgents = array_map(function ($agent) {
            return $agent['id'];
        }, $property->agents->toArray());

        $unassignedAgents = Agent::select(['id', 'name'])->whereNotIn('id', $assignedAgents)->get();

        return Inertia::render('Properties/Property', [
            'property' => Property::with('agents')->findOrFail($propertyId),
            'agents' => Agent::get(),
            'unassignedAgents' => $unassignedAgents
        ]);
    }

    public function storeAgent(AssignAgentRequest $request, int $propertyId)
    {
        $property = Property::findOrFail($propertyId);

        $property->agents()->attach(
            $request->input('id'),
            [
                'can_conduct_viewings' => $request->has('can_conduct_viewings') ? boolval($request->input('can_conduct_viewings')) : false,
                'can_sell_property' => $request->has('can_sell_property') ? boolval($request->input('can_sell_property')) : false,
            ]
        );

        if ($request->wantsJson()) {
            return response(['property' => $property], 201);
        }
    }

    public function updateAgent(AssignAgentRequest $request, int $propertyId, int $agentId)
    {
        $property = Property::findOrFail($propertyId);

        $property->agents()->detach($agentId);
        $property->agents()->attach(
            $agentId,
            [
                'can_conduct_viewings' => $request->has('can_conduct_viewings') ? boolval($request->input('can_conduct_viewings')) : false,
                'can_sell_property' => $request->has('can_sell_property') ? boolval($request->input('can_sell_property')) : false,
            ]
        );

        if ($request->wantsJson()) {
            return response(['property' => $property], 201);
        }
    }

    public function removeAgent(Request $request, int $propertyId, int $agentId)
    {
        $property = Property::findOrFail($propertyId);

        $property->agents()->detach($agentId);

        if ($request->wantsJson()) {
            return response(['property' => $property]);
        }
    }
}
