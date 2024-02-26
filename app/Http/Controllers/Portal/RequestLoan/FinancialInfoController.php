<?php

namespace App\Http\Controllers\Portal\RequestLoan;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class FinancialInfoController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'AUDITED_ENTITY_NAME' => 'required',
            'FINANCE_INFO_CURR_ID' => 'required',
            'FINANCE_INFO_PREPARED_ON' => 'required|date_format:m-d-Y|before:tomorrow',
            'FISCAL_YEAR' => 'required|date_format:Y',
        ]);

        $input = $request->all();

        $infoData = json_decode($request->info, true)[0];

        $postInput = [
            'FUND_ID' => $input['FUND_ID'],
            "FINANCIAL_INFO_IDS" => $infoData['FINANCIAL_INFO_IDS'],
            "THIS_YEAR_VALUES" => $infoData['THIS_YEAR_VALUES'],
            "LAST_YEAR_VALUES" => $infoData['LAST_YEAR_VALUES'],
        ];

        $response = storeYear($input);
        if(!$response['status'] || count($postInput['FINANCIAL_INFO_IDS'])==0){
            $status = $response['status'];
            $msg = $response['message'];
            return response()->json(compact('status', 'msg'));
        }

        $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/UpdateFundFinanceInfoData?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        if($status){
            $msg = __('msg.update_loan_request_success', ['id'=>$postInput['FUND_ID']]);
        }
        return response()->json(compact('status', 'msg'));
    }

    public function storeIncome(Request $request)
    {

        $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/UpdateFundIncomeListFinanceInfoData?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $input = $request->all();
        $postInput = [
            'FUND_ID' => $input['FUND_ID'],
            "FINANCIAL_INFO_IDS" => $input['info'][0]['FINANCIAL_INFO_IDS'],
            "THIS_YEAR_VALUES" => $input['info'][0]['THIS_YEAR_VALUES'],
            "LAST_YEAR_VALUES" => $input['info'][0]['LAST_YEAR_VALUES'],
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        if($status){
            $msg = __('msg.update_loan_request_success', ['id'=>$postInput['FUND_ID']]);
        }
        return response()->json(compact('status', 'msg'));
    }
}
