<?php

namespace App\Http\Controllers\Portal\RequestLoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class GuaranteeController extends Controller
{
    public function store(Request $request){

        if($request->SALARY_TYPE_ID == 1){
            $rules = [
                'GUARANTEE_TYPE_ID' => 'required',
                'SALARY_TYPE_ID' => 'required',
                'SALARY_DESC' => 'required|array|min:2',
                'SALARY_VALUE' => 'required|array|min:2',
                'SALARY_DESC.1' => 'required',
                'SALARY_VALUE.1' => 'required',
            ];
        }else{
            $rules = [
                'GUARANTEE_TYPE_ID' => 'required',
                'SALARY_TYPE_ID' => 'required',
                'GUARANTEE_VALUE' => 'required',
                'GURANTEES_CURR_ID' => 'required',
            ];
        }

        $this->validate($request, $rules,[],[
            'GUARANTEE_TYPE_ID' => 'الكفالة',
        ]);

        $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/AddUpdateFundGuaranteeData?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        if($postInput['SALARY_TYPE_ID'] == 1) {
            $postInput['GuaranteeSalaries'] = array_values(collect($postInput['SALARY_VALUE'])->zip($postInput['SALARY_CURR_ID'], $postInput['SALARY_DESC'])->transform(function ($values) {
                return [
                    'SALARY_VALUE' => $values[0],
                    'SALARY_CURR_ID' => $values[1],
                    'SALARY_DESC' => $values[2],
                ];
            })->whereNotNull('SALARY_VALUE')->whereNotNull('SALARY_DESC')->all());

            $postInput['Guarantees'] = array_values(collect($postInput['FUND_GUARANTEE_ID'])->zip($postInput['GUARANTEE_TYPE_ID'], $postInput['SALARY_TYPE_ID'])->transform(function ($values) {
                return [
                    'FUND_GUARANTEE_ID' => $values[0],
                    'GUARANTEE_TYPE_ID' => $values[1],
                    'SALARY_TYPE_ID' => $values[2],
                ];
            })->all());

            $postInput['Guarantees'][0]['GuaranteeSalaries'] = $postInput['GuaranteeSalaries'];

        }else{
            $postInput['Guarantees'] = array_values(collect($postInput['FUND_GUARANTEE_ID'])->zip($postInput['GUARANTEE_TYPE_ID'],
                $postInput['SALARY_TYPE_ID'], $postInput['GUARANTEE_VALUE'], $postInput['GURANTEES_CURR_ID'])
                ->transform(function ($values) {
                    return [
                        'FUND_GUARANTEE_ID' => $values[0],
                        'GUARANTEE_TYPE_ID' => $values[1],
                        'SALARY_TYPE_ID' => $values[2],
                        'GUARANTEE_VALUE' => $values[3],
                        'GURANTEES_CURR_ID' => $values[4],
                    ];
            })->all());
        }

        unset($postInput['SALARY_VALUE']);
        unset($postInput['SALARY_CURR_ID']);
        unset($postInput['SALARY_DESC']);
        unset($postInput['FUND_GUARANTEE_ID']);
        unset($postInput['GUARANTEE_TYPE_ID']);
        unset($postInput['SALARY_TYPE_ID']);
        unset($postInput['GuaranteeSalaries']);
        unset($postInput['GUARANTEE_VALUE']);
        unset($postInput['GURANTEES_CURR_ID']);

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $constants = getFundData($request->FUND_ID);
            $data = $constants['data'];
            $currency = $data['Fund_Data'][0]['GOOD_CURR_NAME'];
            $html = view('portal.request_loans.components.guarantee_table', compact('data', 'currency'))->render();
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
            $html = view('portal.request_loans.components.guarantee_table', compact('data', 'currency'))->render();
            return response()->json(compact('status', 'html', 'data'));
        }

        return response()->json(compact('status', 'msg'));
    }
}
