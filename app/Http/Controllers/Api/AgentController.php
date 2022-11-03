<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Services\AgentCompetitorFactory;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::with('properties')->get()->append('total_price');

        return response()->json(['agents' => $agents]);
    }

    public function indexCompeting(Request $request, AgentCompetitorFactory $factory)
    {
        return response()->json($factory->getResult());
    }
}
