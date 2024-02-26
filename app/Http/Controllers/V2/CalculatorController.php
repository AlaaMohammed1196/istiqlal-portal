<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CalculatorController extends Controller
{
    public function getDepositRange(Request $request){
        $this->validate($request, [
            'DEPOSIT_TYPE_PERIOD_ID' => 'required',
            'DEPOSIT_CURR_ID' => 'required',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/API/CompanyDeposits/GetDepositValueRange?MODULE_ID='.Session::get('userData')['MODULE_ID'];

        $apiInput = [
            "DEPOSIT_TYPE_PERIOD_ID" => $request->DEPOSIT_TYPE_PERIOD_ID,
            "DEPOSIT_CURR_ID" => $request->DEPOSIT_CURR_ID,
        ];

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $apiInput);
        $body = json_decode($response->getBody(), true);

        if($body['status']){
            $status = true;
            $data = $body['data'];
            return response()->json(compact('status', 'data'));
        }else{
            $status = false;
            $msg = $body['message'];
            return response()->json(compact('status', 'msg'));
        }
    }

    public function calculate(Request $request){
        $this->validate($request, [
            'DEPOSIT_TYPE_PERIOD_ID' => 'required',
            'DEPOSIT_CURR_ID' => 'required',
            'DEPOSIT_VALUE' => 'required',
        ]);
        $apiURL = config('app.api').'/CompanyPortalApi/API/CompanyDeposits/GetDefaultInterestRate?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiInput = [
            "DEPOSIT_TYPE_PERIOD_ID" => $request->DEPOSIT_TYPE_PERIOD_ID,
            "DEPOSIT_CURR_ID" => $request->DEPOSIT_CURR_ID,
            "DEPOSIT_VALUE" => $request->DEPOSIT_VALUE,
        ];

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $apiInput);
        $body = json_decode($response->getBody(), true);

        if($body['status']){
            $status = true;
            $data = $body['data'];
            return response()->json(compact('status', 'data'));
        }else{
            $status = false;
            $msg = $body['message'];
            return response()->json(compact('status', 'msg'));
        }
    }
}
