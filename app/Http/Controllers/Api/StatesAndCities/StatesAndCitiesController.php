<?php

namespace App\Http\Controllers\Api\StatesAndCities;

use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatesAndCitiesController extends Controller
{
    //

    public function getStates(Request $request)
    {
        return response()->json(State::get(), 200);
    }

    public function getCities($stateId)
    {
        //
        $cities = State::find($stateId)?->cities;
        //
        if (!$cities) {
            return response()->json(['message' => 'No cities found'], 404);
        }
        //
        return response()->json(State::find($stateId)->cities, 200);
    }
}
