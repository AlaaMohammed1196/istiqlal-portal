<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DepositsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $responseBody = $this->SearchAccountsDeposits();
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $deposits = $responseBody['data']['DEPOSITS'];
        }catch (\Exception $ex){
            $deposits = [];
        }

        return view('portal_v2.deposits.index', compact('deposits'));
    }

    public function show(Request $request, $id)
    {
        try {
            $responseBody = $this->GetDepositDetails($id);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $details = $responseBody['data']['DEPOSITS']['0'];
            $amounts = $responseBody['data']['DEPOSIT_AMOUNTS'];
        }catch (\Exception $ex){
            $details = [];
            $amounts = [];
        }

        return view('portal_v2.deposits.show', compact('details', 'amounts'));
    }

    public function create(Request $request)
    {
        return view('portal_v2.deposits.create');
    }

    public function GetAccounts(Request $request)
    {
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/GetProfileAccounts?&MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL .= '&DEPOSIT_CURR_ID='.$request->curr;

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $options = $responseBody['data']['CUSTOMER_ACCOUNTS'];
            return response()->json(compact('status', 'msg', 'options'));
        }

        return response()->json(compact('status', 'msg'));
    }

    public function numToText(Request $request)
    {
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/GetAmmountAsText?&MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL .= '&AMMOUNT='.$request->value.'&CURR_ID='.$request->curr;

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $value = $responseBody['data']['AMMOUNT_AS_TEXT'];
            return response()->json(compact('status', 'msg', 'value'));
        }

        return response()->json(compact('status', 'msg'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'DEPOSIT_TYPE_PERIOD_ID' => 'required',
            'DEPOSIT_VALUE' => 'required|numeric|min:0',
            'DEPOSIT_CURR_ID' => 'required',
            'FEED_ACC_LEDGER_ID' => 'required',
            'VERIFY_CODE' => isset($request->code_is_required)&&$request->code_is_required==1?'required':'nullable',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/BindDepositAccount?&MODULE_ID='.Session::get('userData')['MODULE_ID'];

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

    function SearchAccountsDeposits(){
        $apiURL = config('app.api').'/CompanyPortalApi/API/CompanyDeposits/SearchAccountsDeposits?MODULE_ID='.Session::get('userData')['MODULE_ID'];

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            "DEPOSIT_ID_FROM" => "",
            "DEPOSIT_ID_TO" => "",
            "DEPOSIT_TYPE_ID" => "",
            "DEPOSIT_VALUE_FROM" => "",
            "DEPOSIT_VALUE_TO" => "",
            "INTEREST_PERCENTAGE_VALUE" => "",
            "DEPOSIT_BIND_DATE" => "",
            "DEPOSIT_BIND_DATE_FROM" => "",
            "DEPOSIT_BIND_DATE_TO" => "",
            "DEPOSIT_MATURITY_DATE" => "",
            "DEPOSIT_MATURITY_DATE_FROM" => "",
            "DEPOSIT_MATURITY_DATE_TO" => "",
            "RENEWAL_END_DATE_FROM" => "",
            "RENEWAL_END_DATE_TO" => "",
            "STATUS_ID" => [],
            "DEPOSIT_CURR_ID" => "",
            "PAGE" => "0"
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }

    function GetDepositDetails($DEPOSIT_ID){
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/GetDepositDetails?MODULE_ID='.Session::get('userData')['MODULE_ID'].'&DEPOSIT_ID='.$DEPOSIT_ID;

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }
}
