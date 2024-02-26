<?php

namespace App\Http\Controllers\V2\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AccountsController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page??1;
        $data = $request->all();
        $sort = [
            'col' => $request->ORDER_COLUMN_NAME,
            'type' => $request->ORDER_TYPE,
        ];
        $constants = [
            'CURRENCIES' => [],
            'ACCOUNT_TYPES' => [],
        ];
        try {
            $responseBody = $this->GetCustomerAccounts($page, $data);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $status = $responseBody['status'];
            $accounts = $responseBody['data']['CUSTOMER_ACCOUNTS'];
            $pages = $responseBody['data'];
            unset($pages['CUSTOMER_ACCOUNT']);

            if(!$request->ajax()){
                $responseBody = $this->GetCustomerAccountsConstnats();
                if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
                $constants = $responseBody['data'];
            }

            dd($accounts);

        }catch (\Exception $ex){
            $status = false;
            $accounts = [];
            $pages = [];
        }

        if($request->ajax()){
            $html = view('portal_v2.accounts.table', compact('accounts', 'pages', 'sort'))->render();
            return response()->json(compact('status', 'html'));
        }

        return view('portal_v2.accounts.index', compact('accounts', 'pages', 'constants', 'sort'));
    }

    function GetCustomerAccounts($page=0, $data=[]){
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyAccounts/GetCustomerAccounts?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL = $apiURL.'&PAGE='.$page;
        if(isset($data['AVAILABLE_BALANCE_FROM'])){
            $apiURL = $apiURL.'&AVAILABLE_BALANCE_FROM='.$data['AVAILABLE_BALANCE_FROM'];
        }
        if(isset($data['AVAILABLE_BALANCE_TO'])){
            $apiURL = $apiURL.'&AVAILABLE_BALANCE_TO='.$data['AVAILABLE_BALANCE_TO'];
        }
        if(isset($data['ACCOUNT_BALANCE_FROM'])){
            $apiURL = $apiURL.'&ACCOUNT_BALANCE_FROM='.$data['ACCOUNT_BALANCE_FROM'];
        }
        if(isset($data['ACCOUNT_BALANCE_TO'])){
            $apiURL = $apiURL.'&ACCOUNT_BALANCE_TO='.$data['ACCOUNT_BALANCE_TO'];
        }
        if(isset($data['CURR_ID']) && $data['CURR_ID']!=0){
            $apiURL = $apiURL.'&CURR_ID='.$data['CURR_ID'];
        }
        if(isset($data['ACCOUNT_TYPE_ID']) && $data['ACCOUNT_TYPE_ID']!=0){
            $apiURL = $apiURL.'&ACCOUNT_TYPE_ID='.$data['ACCOUNT_TYPE_ID'];
        }
        if(isset($data['ORDER_COLUMN_NAME'])){
            $apiURL = $apiURL.'&ORDER_COLUMN_NAME='.$data['ORDER_COLUMN_NAME'];
        }
        if(isset($data['ORDER_TYPE'])){
            $apiURL = $apiURL.'&ORDER_TYPE='.$data['ORDER_TYPE'];
        }
        if(isset($data['IS_COLUMN_DATE'])){
            $apiURL = $apiURL.'&IS_COLUMN_DATE='.$data['IS_COLUMN_DATE'];
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }

    function GetCustomerAccountsConstnats(){
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyAccounts/GetCustomerAccountsConstnats?MODULE_ID='.Session::get('userData')['MODULE_ID'];

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }
}
