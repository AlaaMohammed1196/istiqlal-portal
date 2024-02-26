<?php

namespace App\Http\Controllers\Portal\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ManagementController extends Controller
{
    public function index(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['ExecutiveMembers'];

        return view('portal.company.management.index', compact('data', 'constants'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'MEMBER_FULL_NAME' => 'required',
            'ID_NUM' => 'required|digits:9',
            'JOB_ID' => 'required',
            'EDUCATION_LEVEL_ID' => 'required',
            'EXPERIENCE_YEARS_CNT' => 'required',
            'IS_SIGNER' => 'required',
            'CURRENT_EXPERIENCE_NOTES' => 'required|string|max:4000',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/AddExecutiveMember?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.management.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'MEMBER_FULL_NAME' => 'required',
            'ID_NUM' => 'required|digits:9',
            'JOB_ID' => 'required',
            'EDUCATION_LEVEL_ID' => 'required',
            'EXPERIENCE_YEARS_CNT' => 'required',
            'IS_SIGNER' => 'required',
            'CURRENT_EXPERIENCE_NOTES' => 'required|string|max:4000',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/UpdateExecutiveMember?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.management.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function delete(Request $request)
    {
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/DeleteExecutiveMember?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'MEMBER_ID' => $request->id,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        return response()->json(compact('status', 'msg'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'ID_NUM' => 'required|digits:9',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/SearchExecutiveMember?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $data = [];
        if($status){
            $data = $responseBody['data']['PROFILES_PARTNER'][0];
        }
        return response()->json(compact('status', 'msg', 'data'));
    }
}
