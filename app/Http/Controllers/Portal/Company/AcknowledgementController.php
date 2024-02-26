<?php

namespace App\Http\Controllers\Portal\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AcknowledgementController extends Controller
{
    public function index(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['ProfileAcknowledgments'];

        return view('portal.company.acknowledgement.index', compact('data', 'constants'));
    }

    public function edit(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['ProfileAcknowledgments'];

        return view('portal.company.acknowledgement.edit', compact('data', 'constants'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'IS_MORTGEGE_TO_OTHERS' => 'required',
            'IS_COMPANY_RIGHT_BORROW' => 'required',
            'BORROWING_LIMIT' => 'nullable',
            'CURR_ID' => 'nullable',
            'IS_COMPANY_TAX_DOC' => 'required',
//            'IS_LOANS_GRANTED' => 'required',
            'IS_COMPANY_GUARANTEE_LOANS' => 'required',
        ]);

        $postInput = $request->all();

        if($request->IS_COMPANY_RIGHT_BORROW == 1){
            $this->validate($request, [
                'BORROWING_LIMIT' => 'required',
                'CURR_ID' => 'required',
            ]);
        }else{
            $postInput['BORROWING_LIMIT'] = null;
        }

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/AddUpdateAcknowledgment?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.acknowledgement.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }
}
