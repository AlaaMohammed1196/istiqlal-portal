<?php

namespace App\Http\Controllers\Portal\RequestLoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PaymentSourceController extends Controller
{
    public function fundSource(Request $request){
        $this->validate($request, [
            'SOURCE_ID' => 'required',
            'ANNUAL_SOURCE_VALUE' => 'required|numeric',
            'SOURCE_CURR_ID' => 'required',
        ]);

        $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/UpdateFundSourceData?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $constants = getFundData($request->FUND_ID);
            $data = $constants['data'];
            $currency = $data['Fund_Data'][0]['GOOD_CURR_NAME'];
            $html = view('portal.request_loans.components.fund_source_table', compact('data', 'currency'))->render();
            $sources_list = getFundSources($request->FUND_ID);
            $sources_list = $sources_list['data']['FUND_SOURCES'];
            $optionHtml = view('portal.request_loans.components.fund_source_option', compact('sources_list'))->render();
            return response()->json(compact('status', 'html', 'optionHtml', 'data'));
        }
        return response()->json(compact('status', 'msg'));
    }

    public function fundSourceDesc(Request $request){
        $this->validate($request, [
            'SOURCE_CUST_CONTR_DESC' => 'required',
            'ANNUAL_SOURCE_VALUE' => 'required|numeric',
            'SOURCE_CUST_CONTR_CURR_ID' => 'required',
        ]);

        $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/AddUpdateFundSourceDescData?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $constants = getFundData($request->FUND_ID);
            $data = $constants['data'];
            $currency = $data['Fund_Data'][0]['GOOD_CURR_NAME'];
            $html = view('portal.request_loans.components.fund_source_desc_table', compact('data', 'currency'))->render();
            return response()->json(compact('status', 'html', 'data'));
        }
        return response()->json(compact('status', 'msg'));
    }

    public function fundSourceDelete(Request $request)
    {
        $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/DeleteFundSource?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'FUND_ID' => $request->fundId,
            'SOURCE_ID' => $request->id,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $constants = getFundData($request->fundId);
            $data = $constants['data'];
            $currency = $data['Fund_Data'][0]['GOOD_CURR_NAME'];
            $html = view('portal.request_loans.components.fund_source_table', compact('data', 'currency'))->render();
            $sources_list = getFundSources($request->fundId);
            $sources_list = $sources_list['data']['FUND_SOURCES'];
            $optionHtml = view('portal.request_loans.components.fund_source_option', compact('sources_list'))->render();
            return response()->json(compact('status', 'html', 'optionHtml', 'data'));
        }
        return response()->json(compact('status', 'msg'));
    }

    public function fundSourceDescDelete(Request $request)
    {
        $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/DeleteFundSourceDesc?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'FUND_ID' => $request->fundId,
            'SOURCE_CUST_CONTR_DESC_ID' => $request->id,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $constants = getFundData($request->fundId);
            $data = $constants['data'];
            $currency = $data['Fund_Data'][0]['GOOD_CURR_NAME'];
            $html = view('portal.request_loans.components.fund_source_desc_table', compact('data', 'currency'))->render();
            return response()->json(compact('status', 'html', 'data'));
        }
        return response()->json(compact('status', 'msg'));
    }
}
