<?php

namespace App\Http\Controllers\Portal\RequestLoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class MainInfoController extends Controller
{
    public function fetchProgram(Request $request)
    {
        $responseBody = fetchProgram($request->PROGRAM_TYPE_ID);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        $list = $responseBody['data']['PRODUCT_TYPES'];
        $html = view('portal.components.options', compact('list'))->render();

        return response()->json(compact('status', 'msg', 'html'));
    }

    public function fetchPurpose(Request $request)
    {
        $responseBody = fetchPurpose($request->FUND_SECTOR_ID);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        $list = $responseBody['data']['FINANCING_PURPOSES'];
        $html = view('portal.components.options', compact('list'))->render();

        return response()->json(compact('status', 'msg', 'html'));
    }

    public function getAddress(Request $request)
    {
        $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/GetMyProfileAddress?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $value = '';

        if($status){
            $value = $responseBody['data']['Full_Address'];
        }
        return response()->json(compact('status', 'msg', 'value'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'PROGRAM_TYPE_ID' => 'required',
            'PRODUCT_TYPE_ID' => 'required',
            'FUND_SECTOR_ID' => 'required',
            'FINANCING_PURPOSE_ID' => 'required',
            'FINANCING_PURPOSE_DESCRIPTION' => 'required|string|max:2000',
            'ACTIVITY_PLACE' => 'required',
            'GOODS_VALUE' => 'required',
            'GOODS_CURR_ID' => 'required',
            'FINANCING_VALUE' => 'required',
            'CURR_ID' => 'required',
            'INSTALLMENT_CNT' => 'required',
            'GRACE_PERIOD_IN_DAYS' => 'required',
            'FUND_DESCRIPTION' => 'required|string|max:2000',
            'FUND_PROJECT_ATTACHS' => $request->PROJECT_STATUS_ID==2&&$request->is_file_exist==0?'required|min:1|max:'.maxSize().'|mimes:'.acceptImagePdfType(0):'nullable|min:1|max:'.maxSize().'|mimes:'.acceptImagePdfType(0),
        ]);

        $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/AddFundApplication?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();
        $postInput['GRACE_PERIOD_IN_DAYS'] = $postInput['GRACE_PERIOD_IN_DAYS']*30;
        unset($postInput['is_file_exist']);
        unset($postInput['FINANCING_PURPOSE_ID']);

        $postInput['FINANCING_PURPOSE_IDS'] = "";
        foreach ($request->FINANCING_PURPOSE_ID as $index=>$id){
            if($index==0){
                $postInput['FINANCING_PURPOSE_IDS'] = $id;
            }else{
                $postInput['FINANCING_PURPOSE_IDS'] .= ','.$id;
            }
        }

        try {
            if ($postInput['PROJECT_STATUS_ID'] == 2 && $request->FUND_PROJECT_ATTACHS) {
                $path = generalUpload('attachments', $request->FUND_PROJECT_ATTACHS);
                if($path){
                    deleteUpload($path);
                    $apiURL = config('app.api_attach').'/PortalFundsApi/api/PortalFunds/AddFundApplication?MODULE_ID='.config('app.MODULE_ID');
                    $file = $request->FUND_PROJECT_ATTACHS;
                    $response = Http::attach(
                        'FUND_PROJECT_ATTACHS', file_get_contents($file), $file->getClientOriginalName()
                    )->withHeaders($headers)->post($apiURL, $postInput);
                    $responseBody = json_decode($response->getBody(), true);
                    $status = $responseBody['status'];
                    $msg = $responseBody['message'];
                }else{
                    $status = false;
                    $msg = __('msg.wrong_attachment');
                }
            } else {
                $response = Http::asForm()->withHeaders($headers)->post($apiURL, $postInput);
                $responseBody = json_decode($response->getBody(), true);
                $status = $responseBody['status'];
                $msg = $responseBody['message'];
            }
        }catch (\Exception $ex){
            $status = false;
            $msg = $ex->getMessage();
        }

        $fund_id = '';

        if($status){
            $fund_id = $responseBody['data']['FUND_ID'];
            if(!$msg){
                $msg = __('msg.send_loan_request_success');
            }
        }
        return response()->json(compact('status', 'msg', 'fund_id'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'PROGRAM_TYPE_ID' => 'required',
            'PRODUCT_TYPE_ID' => 'required',
            'FUND_SECTOR_ID' => 'required',
            'FINANCING_PURPOSE_ID' => 'required',
            'FINANCING_PURPOSE_DESCRIPTION' => 'required|string|max:2000',
            'GOODS_VALUE' => 'required',
            'GOODS_CURR_ID' => 'required',
            'FINANCING_VALUE' => 'required',
            'CURR_ID' => 'required',
            'INSTALLMENT_CNT' => 'required',
            'GRACE_PERIOD_IN_DAYS' => 'required',
            'FUND_DESCRIPTION' => 'required|string|max:2000',
            'FUND_PROJECT_ATTACHS' => $request->PROJECT_STATUS_ID==2&&$request->is_file_exist==0?'required|min:1|max:'.maxSize().'|mimes:'.acceptImagePdfType(0):'nullable|min:1|max:'.maxSize().'|mimes:'.acceptImagePdfType(0),
        ]);

        $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/UpdateFundBaseData?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();
        $postInput['GRACE_PERIOD_IN_DAYS'] = $postInput['GRACE_PERIOD_IN_DAYS']*30;
        unset($postInput['is_file_exist']);
        unset($postInput['FINANCING_PURPOSE_ID']);

        $postInput['FINANCING_PURPOSE_IDS'] = "";
        foreach ($request->FINANCING_PURPOSE_ID as $index=>$id){
            if($index==0){
                $postInput['FINANCING_PURPOSE_IDS'] = $id;
            }else{
                $postInput['FINANCING_PURPOSE_IDS'] .= ','.$id;
            }
        }

        try {
            if ($postInput['PROJECT_STATUS_ID'] == 2 && $request->FUND_PROJECT_ATTACHS) {
                $path = generalUpload('attachments', $request->FUND_PROJECT_ATTACHS);
                if($path){
                    deleteUpload($path);
                    $apiURL = config('app.api_attach').'/PortalFundsApi/api/PortalFunds/UpdateFundBaseData?MODULE_ID='.config('app.MODULE_ID');
                    $file = $request->FUND_PROJECT_ATTACHS;
                    $response = Http::attach(
                        'FUND_PROJECT_ATTACHS', file_get_contents($file), $file->getClientOriginalName()
                    )->withHeaders($headers)->post($apiURL, $postInput);
                    $responseBody = json_decode($response->getBody(), true);
                    $status = $responseBody['status'];
                    $msg = $responseBody['message'];
                }else{
                    $status = false;
                    $msg = __('msg.wrong_attachment');
                }
            } else {
                $response = Http::asForm()->withHeaders($headers)->post($apiURL, $postInput);
                $responseBody = json_decode($response->getBody(), true);
                $status = $responseBody['status'];
                $msg = $responseBody['message'];
            }
        }catch (\Exception $ex){
            $status = false;
            $msg = $ex->getMessage();
        }

        $fund_id = '';

        if($status){
            $fund_id = $request->FUND_ID;
            if(!$msg){
                $msg = __('msg.update_loan_request_success', ['id'=>$postInput['FUND_ID']]);
            }
        }
        return response()->json(compact('status', 'msg', 'fund_id'));
    }
}
