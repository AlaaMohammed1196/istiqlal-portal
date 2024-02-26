<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $constants = getMyFunds();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $data = $constants['data']['Funds'];

        return view('portal.orders.index', compact('data'));
    }

    public function getFund(Request $request)
    {
        $constants = getMyFunds();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $status = $constants['status'];
        if($status){
            $data = $constants['data']['Funds'];
            $item = collect($data)->where('FUND_ID', $request->id)->first();
            $html = view('portal.orders.fund', compact('item'))->render();
            return response()->json(compact('status', 'html'));
        }
        $status = false;
        $msg = 'حدث خطأ ما الرجاء المحاولة لاحقا';
        return response()->json(compact('status', 'msg'));
    }

    public function addComment(Request $request)
    {
        $this->validate($request, [
            'FUND_COMMENT' => 'required',
            'FUND_ATTACHS' => 'nullable|max:'.maxSize().'|mimes:'.acceptImagePdfType(0),
        ]);

        $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/AddFundComments?&MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'FUND_ID' => $request->FUND_ID,
            'FUND_COMMENT' => $request->FUND_COMMENT,
        ];

        if($request->FUND_ATTACHS){
            $path = generalUpload('attachments', $request->FUND_ATTACHS);
            if($path){
                deleteUpload($path);
                $apiURL = config('app.api_attach').'/PortalFundsApi/api/PortalFunds/AddFundComments?&MODULE_ID='.config('app.MODULE_ID');
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
        }else{
            $response = Http::asForm()->withHeaders($headers)->post($apiURL, $postInput);
            $responseBody = json_decode($response->getBody(), true);
            $status = $responseBody['status'];
            $msg = $responseBody['message'];
        }

        if($status){
            $msg = 'تم إضافة التعليق بنجاح';
            $details = getFundData($request->FUND_ID);
            $html = view('portal.orders.comments', compact('details'))->render();
            return response()->json(compact('status', 'msg', 'html'));
        }

        return response()->json(compact('status', 'msg'));
    }

    public function cancel(Request $request)
    {
        $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/CancelFundApplication?&MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'FUND_ID' => $request->id,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        return response()->json(compact('status', 'msg'));
    }

    public function print(Request $request, $id)
    {
        $apiURL = config('app.reports').'/RhodesBankingReports/PortalFundApplication/PrintFundApplication';

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'FUND_ID' => $id
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $file = $response->getBody()->getContents();

        $filename= 'FinancingApplicationsReport.pdf';

        return response()->streamDownload(function () use($file) {
            echo $file;
        }, $filename, [
            'Content-Type'=> 'application/json',
            'Accept'=> 'application/pdf',
        ]);
    }
}
