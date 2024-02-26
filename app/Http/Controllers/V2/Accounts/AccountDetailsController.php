<?php

namespace App\Http\Controllers\V2\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AccountDetailsController extends Controller
{
    public function show(Request $request, $index)
    {
        $data = $request->all();
        $sort = [
            'col' => $request->ORDER_COLUMN_NAME,
            'type' => $request->ORDER_TYPE,
        ];
        try {
            $responseBody = $this->GetCustomerAccounts(0);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $status = $responseBody['status'];
            $accounts = $responseBody['data']['CUSTOMER_ACCOUNTS'];

            $responseBody = $this->GetCustomerAccountDetails($accounts[$index], $data);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $account = $responseBody['data']['CUSTOMER_ACCOUNT'][0];

            $responseBody = $this->GetAccountComments($index);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $comments = $responseBody['data']['ACCOUNT_COMMENTS'];

            $responseBody = $this->GetCustomerAccountsConstnats();
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $constants = $responseBody['data'];
        }catch (\Exception $ex){
            $status = false;
            $accounts = [];
            $account = [];
            $comments = [];
            $constants = [
                'CURRENCIES' => [],
                'ACCOUNT_TYPES' => [],
            ];
        }

        if($request->ajax()){
            $html = view('portal_v2.accounts.trans', compact('accounts', 'account', 'sort'))->render();
            return response()->json(compact('status', 'html'));
        }

        return view('portal_v2.accounts.show', compact('accounts', 'account', 'index', 'comments', 'constants', 'sort'));
    }

    public function search(Request $request, $index)
    {
        $data = $request->all();
        $sort = [
            'col' => $request->ORDER_COLUMN_NAME,
            'type' => $request->ORDER_TYPE,
        ];
        try {
            $responseBody = $this->GetCustomerAccountDetails($index, $data);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $status = $responseBody['status'];
            $msg = $responseBody['message'];
            $account = $responseBody['data']['CUSTOMER_ACCOUNT'][0];
        }catch (\Exception $ex){
            $status = false;
            $msg = 'حدث خطأ ما';
            $account = [];
        }
        if($status){
            $html = view('portal_v2.accounts.trans', compact('account', 'sort'))->render();
            return response()->json(compact('status', 'html'));
        }
        return response()->json(compact('status', 'msg'));
    }

    public function print(Request $request, $type, $index=-1)
    {
        $apiURL = config('app.reports').'/RhodesBankingReports/Portalreports/AccountReport';

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        if($index != -1){
            $responseBody = $this->GetCustomerAccountDetails($index);
            $account = $responseBody['data']['CUSTOMER_ACCOUNT'][0];
            $postInput = [
                "BRANCH_ID" => $account['BRANCH_ID'],
                "ACC_NUM" => $account['CUST_ID'],
                "LEDGER_ID" => $account['LEDGER_ID'],
                "CURR_ID" => $account['CURR_ID'],
                "ACC_SUB_NUM" => $account['ACC_SUB_NUM'],
                'type' => $type,
                'CUST_ID' => 16,
                'USER_ID' => Session::get('userData')['USER_ID'],
            ];
        }else{
            $postInput = [
                'type' => $type,
                'CUST_ID' => 16,
                'USER_ID' => Session::get('userData')['USER_ID'],
            ];
        }

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $file = $response->getBody()->getContents();

        if($type == 100){
            $filename= 'AccountStatement.xlsx';
        }else{
            $filename= 'AccountStatement.pdf';
        }

        return response()->streamDownload(function () use($file) {
            echo $file;
        }, $filename, [
            'Content-Type'=> 'application/json',
            'Accept'=> 'application/pdf',
        ]);
    }

    public function addComment(Request $request)
    {
        $this->validate($request, [
            'COMMENT_DESCRIPTION' => 'required_without:COMMENT_ATTACHMENTS',
            'COMMENT_ATTACHMENTS' => 'nullable|max:3',
            'COMMENT_ATTACHMENTS.*' => 'nullable|max:'.maxSize().'|mimes:'.acceptImagePdfType(0),
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyAccounts/AddAccountComment?&MODULE_ID='.Session::get('userData')['MODULE_ID'];

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();
        unset($postInput['index']);

        $response = Http::withHeaders($headers);
        if(isset($postInput['COMMENT_ATTACHMENTS']) && count($postInput['COMMENT_ATTACHMENTS']) > 0){
            foreach ($postInput['COMMENT_ATTACHMENTS'] as $attach){
                $response = $response->attach('COMMENT_ATTACHMENTS', file_get_contents($attach), $attach->getClientOriginalName());
            }
            unset($postInput['COMMENT_ATTACHMENTS']);
        }else{
            $response = Http::asForm()->withHeaders($headers);
        }
        $response = $response->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $msg = 'تم إضافة التعليق بنجاح';
            $responseBody = $this->GetAccountComments($request->index);
            $comments = $responseBody['data']['ACCOUNT_COMMENTS'];

            $count = count($comments);
            $html = view('portal_v2.accounts.comments', compact('comments'))->render();
            return response()->json(compact('status', 'msg', 'html', 'count'));
        }

        return response()->json(compact('status', 'msg'));
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

    function GetCustomerAccountDetails($account, $data=[]){
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyAccounts/GetCustomerAccountDetails?MODULE_ID='.Session::get('userData')['MODULE_ID'];

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            "BRANCH_ID" => $account['BRANCH_ID'],
            "ACC_NUM" => $account['CUST_ID'],
            "LEDGER_ID" => $account['LEDGER_ID'],
            "CURR_ID" => $account['CURR_ID'],
            "ACC_SUB_NUM" => $account['ACC_SUB_NUM'],
            'TRANS_AMOUNT_FROM' => $data['TRANS_AMOUNT_FROM']??'',
            'TRANS_AMOUNT_TO' => $data['TRANS_AMOUNT_TO']??'',
            'TRANS_DATE_FROM' => $data['TRANS_DATE_FROM']??'',
            'TRANS_DATE_TO' => $data['TRANS_DATE_TO']??'',
            'DEBIT_CREDIT_ID' => isset($data['DEBIT_CREDIT_ID'])&&$data['DEBIT_CREDIT_ID']!=0?$data['DEBIT_CREDIT_ID']:'',
            'NO_OF_TRANS' => isset($data['NO_OF_TRANS'])&&$data['NO_OF_TRANS']!=0?$data['NO_OF_TRANS']:'',
            'ORDER_COLUMN_NAME' => $data['ORDER_COLUMN_NAME']??'',
            'ORDER_TYPE' => $data['ORDER_TYPE']??'',
            'IS_COLUMN_DATE' => $data['IS_COLUMN_DATE']??'',
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }

    function GetAccountComments($index, $page=0){
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyAccounts/GetAccountComments?MODULE_ID='.Session::get('userData')['MODULE_ID'];

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $responseBody = $this->GetCustomerAccounts();
        $accounts = $responseBody['data']['CUSTOMER_ACCOUNTS'];
        $account = $accounts[$index];

        $postInput = [
            "BRANCH_ID" => $account['BRANCH_ID'],
            "ACC_NUM" => $account['CUST_ID'],
            "LEDGER_ID" => $account['LEDGER_ID'],
            "CURR_ID" => $account['CURR_ID'],
            "ACC_SUB_NUM" => $account['ACC_SUB_NUM'],
            "PAGE" => $page,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
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
