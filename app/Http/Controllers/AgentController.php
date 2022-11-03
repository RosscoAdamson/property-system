<?php

namespace App\Http\Controllers;

use App\Http\Requests\Agents\CreateRequest;
use App\Http\Requests\Agents\UpdateRequest;
use App\Models\Agent;
use Inertia\Inertia;

class AgentController extends Controller
{
    public function index()
    {
        return Inertia::render('Agents/Index', [
            'agents' => Agent::get()
        ]);
    }

    public function store(CreateRequest $request)
    {
        $agent = Agent::create(
            $request->only([
                'name',
                'email',
                'address',
                'phone_numbers'
            ])
        );

        if ($request->wantsJson()) {
            return response(['agent' => $agent], 201);
        }
    }

    public function update(UpdateRequest $request, int $agentId)
    {
        $agent = Agent::findOrFail($agentId);
        $agent->name = $request->input('name');
        $agent->email = $request->input('email');
        $agent->address = $request->input('address');
        $agent->phone_numbers = $request->input('phone_numbers');
        $agent->save();

        if ($request->wantsJson()) {
            return response(['agent' => $agent], 201);
        }
    }
}
