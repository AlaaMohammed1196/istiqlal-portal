<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CalculatorController extends Controller
{
    public function calculate(Request $request){
        $this->validate($request, [
            'PRODUCT_TYPE_ID' => 'required',
            'CURR_ID' => 'required',
            'FINANCING_VALUE' => 'required',
            'INSTALLMENT_CNT' => 'required',
        ]);
        $apiURL = config('app.api').'/CalculaterApi/API/CalculateFunds/CalculateFund';
        $apiInput = [
            "PRODUCT_TYPE_ID" => $request->PRODUCT_TYPE_ID,
            "CURR_ID" => $request->CURR_ID,
            "FINANCING_VALUE" => $request->FINANCING_VALUE,
            "INSTALLMENT_CNT" => $request->INSTALLMENT_CNT,
        ];
        $headers = [
            'Authorization' => 'Bearer NGHQ1DF6D6fIs7Z82TQMYCZKVASFiS88AQ6MAEWJUKCQV82AKM7FIIIssSPODG2KLNPSQ1Y463DYIJO5DD7JLXU3SW267WBQQJ9',
            'MODULE_ID' => 1,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $apiInput);
        $body = json_decode($response->getBody(), true);

        if($body['status']){
            $status = true;
            $data = [
                'monthly_payment' => round(($request->FINANCING_VALUE + $body['data']['FundData']['PROFIT_VALUE']) / $request->INSTALLMENT_CNT, 2),
                'payment_numbers' => $request->INSTALLMENT_CNT,
                'require_payment' => $request->FINANCING_VALUE,
                'return_percentage' => round($body['data']['FundData']['YEARLY_PROFIT_PER_OUT'],2),
                'return_value' => round($body['data']['FundData']['PROFIT_VALUE'],2),
                'total_number' => round($request->FINANCING_VALUE + $body['data']['FundData']['PROFIT_VALUE'],2),
            ];
            return response()->json(compact('status', 'data'));
        }else{
            $status = false;
            $msg = $body['message'];
            return response()->json(compact('status', 'msg'));
        }
    }

    public function getCurrencies(Request $request){
        try {
            $apiURL = config('app.api').'/CalculaterApi/API/CalculateFunds/GetProductsCurr?PRODUCT_TYPE_ID='.$request->PRODUCT_TYPE_ID;
            $headers = [
                'Authorization' => 'Bearer NGHQ1DF6D6fIs7Z82TQMYCZKVASFiS88AQ6MAEWJUKCQV82AKM7FIIIssSPODG2KLNPSQ1Y463DYIJO5DD7JLXU3SW267WBQQJ9',
                'MODULE_ID' => 1,
            ];

            $response = Http::withHeaders($headers)->get($apiURL);
            $body = json_decode($response->getBody(), true);

            $currencies = $body['data']['PRODUCT_CURRENCIES'];

        } catch (\Exception $ex) {
            $currencies = [];
        }

        $status = true;
        $html = view('components.Calculator.curr', compact('currencies'))->render();
        return response()->json(compact('status', 'html'));
    }

    public function getMoneyRange(Request $request){
        try {

            $apiURL = config('app.api').'/CalculaterApi/API/CalculateFunds/GetProductsMaxMinAmmounts?MODULE_ID='.config('app.MODULE_ID');

            $postInput = [
                'PRODUCT_TYPE_ID' => $request->PRODUCT_TYPE_ID,
                'CURR_ID' => $request->CURR_ID,
            ];

            $headers = [
                'Authorization' => 'Bearer NGHQ1DF6D6fIs7Z82TQMYCZKVASFiS88AQ6MAEWJUKCQV82AKM7FIIIssSPODG2KLNPSQ1Y463DYIJO5DD7JLXU3SW267WBQQJ9',
            ];

            $response = Http::withHeaders($headers)->post($apiURL, $postInput);
            $body = json_decode($response->getBody(), true);

            $amounts = $body['data']['PRODUCT_AMOUNTS'];

            if(count($amounts) > 0){
                $status = true;
                $min = $amounts[0]['MIN_FINANCE_AMOUNT'];
                $max = $amounts[0]['MAX_FINANCE_AMOUNT'];
            }else{
                $status = false;
                $min = '';
                $max = '';
            }

        } catch (\Exception $ex) {
            $status = false;
            $min = '';
            $max = '';
        }

        return response()->json(compact('status', 'min', 'max'));
    }

    public function getTimeRange(Request $request){
        try {

            $apiURL = config('app.api').'/CalculaterApi/API/CalculateFunds/GetProductsMaxMinPeriods?MODULE_ID='.config('app.MODULE_ID');

            $postInput = [
                'PRODUCT_TYPE_ID' => $request->PRODUCT_TYPE_ID,
                'CURR_ID' => $request->CURR_ID,
                'AMOUNT' => $request->AMOUNT,
            ];

            $headers = [
                'Authorization' => 'Bearer NGHQ1DF6D6fIs7Z82TQMYCZKVASFiS88AQ6MAEWJUKCQV82AKM7FIIIssSPODG2KLNPSQ1Y463DYIJO5DD7JLXU3SW267WBQQJ9',
            ];

            $response = Http::withHeaders($headers)->post($apiURL, $postInput);
            $body = json_decode($response->getBody(), true);

            $amounts = $body['data']['PRODUCT_PERIODS'];

            if(count($amounts) > 0){
                $status = true;
                $min = $amounts[0]['MIN_FINANCE_MONTHS'];
                $max = $amounts[0]['MAX_FINANCE_MONTHS'];
            }else{
                $status = false;
                $min = '';
                $max = '';
            }

        } catch (\Exception $ex) {
            $status = false;
            $min = '';
            $max = '';
        }

        return response()->json(compact('status', 'min', 'max'));
    }
}
