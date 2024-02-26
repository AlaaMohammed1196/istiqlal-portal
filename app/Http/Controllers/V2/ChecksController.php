<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ChecksController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page??1;
        $data = $request->all();
        $sort = [
            'col' => $request->ORDER_COLUMN_NAME,
            'type' => $request->ORDER_TYPE,
        ];
        try {
            $responseBody = $this->GetCustomerChecksConstants();
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $types = $responseBody['data']['CheckStatuses'];
            $responseBody = $this->GetCustomerChecks($page, $data);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $status = $responseBody['status'];
            $checks = $responseBody['data']['COMPANY_CHECKS'];
            $pages = $responseBody['data'];
            unset($pages['COMPANY_CHECKS']);
        }catch (\Exception $ex){
            $status = false;
            $types = [];
            $checks = [];
            $pages = [];
        }

        if($request->ajax()){
            $html = view('portal_v2.checks.table', compact('checks', 'pages', 'sort'))->render();
            return response()->json(compact('status', 'html'));
        }

        return view('portal_v2.checks.index', compact('checks', 'pages', 'types', 'sort'));
    }

    public function print(Request $request)
    {
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyAccounts/GetCustomerChecksExcel?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL = $apiURL.'&PAGE=0';

        $data = $request->all();

        if(isset($data['FROM_DATE'])){
            $apiURL = $apiURL.'&FROM_DATE='.$data['FROM_DATE'];
        }
        if(isset($data['TO_DATE'])){
            $apiURL = $apiURL.'&TO_DATE='.$data['TO_DATE'];
        }
        if(isset($data['FROM_AMOUNT'])){
            $apiURL = $apiURL.'&FROM_AMOUNT='.$data['FROM_AMOUNT'];
        }
        if(isset($data['TO_AMOUNT'])){
            $apiURL = $apiURL.'&TO_AMOUNT='.$data['TO_AMOUNT'];
        }
        if(isset($data['CHECK_STATUS_ID']) && $data['CHECK_STATUS_ID']!=0){
            $apiURL = $apiURL.'&CHECK_STATUS_ID='.$data['CHECK_STATUS_ID'];
        }
        if(isset($data['CURR_ID']) && $data['CURR_ID']!=0){
            $apiURL = $apiURL.'&CURR_ID='.$data['CURR_ID'];
        }
        if(isset($data['FROM_RECEIPT_DATE'])){
            $apiURL = $apiURL.'&FROM_RECEIPT_DATE='.$data['FROM_RECEIPT_DATE'];
        }
        if(isset($data['TO_RECEIPT_DATE'])){
            $apiURL = $apiURL.'&TO_RECEIPT_DATE='.$data['TO_RECEIPT_DATE'];
        }
        if(isset($data['CHECK_NUM'])){
            $apiURL = $apiURL.'&CHECK_NUM='.$data['CHECK_NUM'];
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $file = $response->getBody()->getContents();

        $filename= 'Checks.xlsx';
        $status = true;

        $file = base64_encode($file);

        return response()->json(compact('status', 'file'));
    }
    function GetCustomerChecks($page=0, $data=[]){
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyAccounts/GetCustomerChecks?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL = $apiURL.'&PAGE='.$page;
        if(isset($data['FROM_DATE'])){
            $apiURL = $apiURL.'&FROM_DATE='.$data['FROM_DATE'];
        }
        if(isset($data['TO_DATE'])){
            $apiURL = $apiURL.'&TO_DATE='.$data['TO_DATE'];
        }
        if(isset($data['FROM_AMOUNT'])){
            $apiURL = $apiURL.'&FROM_AMOUNT='.$data['FROM_AMOUNT'];
        }
        if(isset($data['TO_AMOUNT'])){
            $apiURL = $apiURL.'&TO_AMOUNT='.$data['TO_AMOUNT'];
        }
        if(isset($data['CHECK_STATUS_ID']) && $data['CHECK_STATUS_ID']!=0){
            $apiURL = $apiURL.'&CHECK_STATUS_ID='.$data['CHECK_STATUS_ID'];
        }
        if(isset($data['CURR_ID']) && $data['CURR_ID']!=0){
            $apiURL = $apiURL.'&CURR_ID='.$data['CURR_ID'];
        }
        if(isset($data['FROM_RECEIPT_DATE'])){
            $apiURL = $apiURL.'&FROM_RECEIPT_DATE='.$data['FROM_RECEIPT_DATE'];
        }
        if(isset($data['TO_RECEIPT_DATE'])){
            $apiURL = $apiURL.'&TO_RECEIPT_DATE='.$data['TO_RECEIPT_DATE'];
        }
        if(isset($data['CHECK_NUM'])){
            $apiURL = $apiURL.'&CHECK_NUM='.$data['CHECK_NUM'];
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

//        dd($apiURL, $responseBody);

        return $responseBody;
    }

    function GetCustomerChecksConstants(){
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyAccounts/GetCustomerChecksConstants?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL = $apiURL.'&PAGE=1';

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }
}
