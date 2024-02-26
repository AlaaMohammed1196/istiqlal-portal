<?php

namespace App\Http\Controllers\Portal\RequestLoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class WarrantyController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'GUARANTEE_TYPE_ID' => 'required',
            'GUARANTEE_DESC' => 'required',
            'GUARANTEE_VALUE' => 'required|numeric',
            'GURANTEES_CURR_ID' => 'required',
        ]);

        $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/AddUpdateFundGuaranteeData?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $postInput['Guarantees'] = array_values(collect($postInput['FUND_GUARANTEE_ID'])->zip($postInput['GUARANTEE_TYPE_ID'],
            $postInput['GUARANTEE_DESC'], $postInput['GUARANTEE_VALUE'], $postInput['GURANTEES_CURR_ID'])
            ->transform(function ($values) {
                return [
                    'FUND_GUARANTEE_ID' => $values[0],
                    'GUARANTEE_TYPE_ID' => $values[1],
                    'GUARANTEE_DESC' => $values[2],
                    'GUARANTEE_VALUE' => $values[3],
                    'GURANTEES_CURR_ID' => $values[4],
                ];
            })->all());

        unset($postInput['FUND_GUARANTEE_ID'], $postInput['GUARANTEE_TYPE_ID'], $postInput['GUARANTEE_DESC'], $postInput['GUARANTEE_VALUE'], $postInput['GURANTEES_CURR_ID']);

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $constants = getFundData($request->FUND_ID);
            $data = $constants['data'];
            $currency = $data['Fund_Data'][0]['GOOD_CURR_NAME'];
            $html = view('portal.request_loans.components.warranty_table', compact('data', 'currency'))->render();
            return response()->json(compact('status', 'html', 'data'));
        }
        return response()->json(compact('status', 'msg'));
    }

    public function delete(Request $request)
    {
        $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/DeleteGuarantee?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'FUND_ID' => $request->fundId,
            'FUND_GUARANTEE_ID' => $request->id,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $constants = getFundData($request->fundId);
            $data = $constants['data'];
            $currency = $data['Fund_Data'][0]['GOOD_CURR_NAME'];
            $html = view('portal.request_loans.components.warranty_table', compact('data', 'currency'))->render();
            return response()->json(compact('status', 'html', 'data'));
        }

        return response()->json(compact('status', 'msg'));
    }
}
