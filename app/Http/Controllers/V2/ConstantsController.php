<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ConstantsController extends Controller
{
    public function bankBranches(Request $request)
    {
        try {
            $list = getBankBankBranches($request->id);
        }catch (\Exception $ex){
            $list = [];
        }
        $html = view('portal.components.options', compact('list'))->render();

        return response()->json(compact('html'));
    }
}
