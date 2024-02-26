<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DepositActionsController extends Controller
{
    public function feeding(Request $request)
    {
        $this->validate($request, [
            'DEPOSIT_VALUE' => 'required|numeric|min:0',
            'DEPOSIT_CURR_ID' => 'required',
            'FEED_ACC_LEDGER_ID' => 'required',
            'VERIFY_CODE' => isset($request->code_is_required)&&$request->code_is_required==1?'required':'nullable',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/AddToDeposit?&MODULE_ID='.Session::get('userData')['MODULE_ID'];

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $url = route('portal.v2.orders.index').'?tab=deposits';
            return response()->json(compact('status', 'msg', 'url'));
        }

        return response()->json(compact('status', 'msg'));
    }

    public function break(Request $request)
    {
        $this->validate($request, [
            'DEPOSIT_ID' => 'required',
            'DEPOSIT_LOSS_VALUE' => 'required|numeric|min:0',
            'VERIFY_CODE' => isset($request->code_is_required)&&$request->code_is_required==1?'required':'nullable',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/BrokenDeposit?&MODULE_ID='.Session::get('userData')['MODULE_ID'];

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

//        dd($apiURL, $postInput, $responseBody);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $url = route('portal.v2.orders.index').'?tab=deposits';
            return response()->json(compact('status', 'msg', 'url'));
        }

        return response()->json(compact('status', 'msg'));
    }
}
