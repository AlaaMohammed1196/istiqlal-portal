<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DepositsController_OLD extends Controller
{
    public function index(Request $request)
    {
        try {
            $responseBody = $this->SearchAccountsDeposits();
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $deposits = $responseBody['data']['DEPOSITS'];
            $details = [];
            if(count($deposits) > 0){
                $details = $this->GetDepositDetails($deposits[0]['DEPOSIT_ID']);
                if($details['code']==401) return redirect()->route('portal.v2.logout');
                $details = $details['data']['DEPOSITS']['0'];
            }
        }catch (\Exception $ex){
            $deposits = [];
            $details = [];
        }

        return view('portal_v2.deposits.index', compact('deposits', 'details'));
    }

    public function getDeposit(Request $request)
    {
        $constants = $this->GetDepositDetails($request->id);
        if($constants['code']==401) return redirect()->route('portal.v2.logout');
        $status = $constants['status'];
        if($status){
            $details = $constants['data']['DEPOSITS']['0'];
            $html = view('portal_v2.deposits.details', compact('details'))->render();
            return response()->json(compact('status', 'html'));
        }
        $status = false;
        $msg = 'حدث خطأ ما الرجاء المحاولة لاحقا';
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
