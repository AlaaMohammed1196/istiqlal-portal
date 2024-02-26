<?php

namespace App\Http\Controllers\Portal\RequestLoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AttachmentController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'DOC_CLASS_IDS' => 'required',
            'FUND_ATTACHS' => 'required|max:'.maxSize().'|mimes:'.acceptImagePdfType(0),
        ]);

        $apiURL = config('app.api_attach').'/PortalFundsApi/api/PortalFunds/AddFundAttachments?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();
        unset($postInput['FUND_ATTACHS']);

        $path = generalUpload('attachments', $request->FUND_ATTACHS);
        if($path){
            deleteUpload($path);
            $response = Http::attach(
                'FUND_ATTACHS', file_get_contents($request->FUND_ATTACHS), $request->FUND_ATTACHS->getClientOriginalName()
            )->withHeaders($headers)->post($apiURL, $postInput);
            $responseBody = json_decode($response->getBody(), true);
            $status = $responseBody['status'];

            $msg = $responseBody['message'];
        }else{
            $status = false;
            $msg = __('msg.wrong_attachment');
        }

        if($status){
            $constants = getFundData($request->FUND_ID);
            $data = $constants['data'];
            $msg = __('msg.order_attach_success');
            $html = view('portal.request_loans.components.attachments_items', compact('data'))->render();
            return response()->json(compact('status', 'msg', 'html'));
        }

        return response()->json(compact('status', 'msg'));
    }

    public function delete(Request $request){
        $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/DeleteAttachment?AttachId='.$request->id.'&FundId='.$request->fundId.'&MODULE_ID='.config('app.MODULE_ID');
        
        

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->post($apiURL, []);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $msg = 'تم إزالة المرفق بنجاح';
        }
        

        return response()->json(compact('status', 'msg'));
    }

    public function submit(Request $request){
        $constants = getFundData($request->FUND_ID);
        $status = $constants['status'];
        $msg = $constants['message'];

        if($status){
            $data = $constants['data'];
            $FundStatus = $data['Fund_Data'][0]['FUND_STATUS_ID'];
            if($FundStatus == 1){
                $msg = __('msg.send_request_success');
            }else{
                $msg = __('msg.send_loan_request_success');
            }
            $url = route('portal.orders.index');
            return response()->json(compact('status', 'msg', 'url'));
        }
        return response()->json(compact('status', 'msg'));
    }


}
