<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        $sort = [
            'col' => $request->ORDER_COLUMN_NAME,
            'type' => $request->ORDER_TYPE,
        ];
        try {
            $transactions = $this->GetLastCustomerAccountTransactions($data);
            if($transactions['code']==401) return redirect()->route('portal.v2.logout');
            $status = $transactions['status'];
            $transactions = $transactions['data']['TRANSACTIONS'];
        }catch (\Exception $ex){
            $status = false;
            $transactions = [];
        }

        if($request->ajax()){
            $html = view('portal_v2.home.table', compact('transactions', 'sort'))->render();
            return response()->json(compact('status', 'html'));
        }

        return view('portal_v2.home.index', compact('transactions', 'sort'));
    }

    function GetLastCustomerAccountTransactions($data=[]){
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyAccounts/GetLastCustomerAccountTransactions?MODULE_ID='.Session::get('userData')['MODULE_ID'];

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
}
