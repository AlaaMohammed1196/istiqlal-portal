<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ConstantsController extends Controller
{
    public function fetchStates(Request $request)
    {
        $list = getStates($request->id);
        $html = view('portal.components.options', compact('list'))->render();

        return response()->json(compact('html'));
    }

    public function fetchCities(Request $request)
    {
        $list = getCities($request->id);
        $html = view('portal.components.options', compact('list'))->render();

        return response()->json(compact('html'));
    }

    public function fetchActivities(Request $request)
    {
        $list = getActivities($request->id);
        $html = view('portal.components.options', compact('list'))->render();

        return response()->json(compact('html'));
    }
}
