<?php

namespace App\Http\Controllers\Portal\RequestLoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PropertyRightController extends Controller
{
    public function index(Request $request)
    {
        return view('portal.request_loans.property_rights');
    }
}
