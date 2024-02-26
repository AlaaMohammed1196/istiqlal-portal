<?php

namespace App\Http\Controllers\Portal\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ActivityCompetitorsController extends Controller
{
    public function index(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['CompanyCompetitors'];
        $hasMembers = $constants['CompanyProfileData']['CompanyGeneralInfo']['CompanyGeneralInfo'][0]['HAS_COMPETITORS_FLAG'];

        return view('portal.company.activity.competitors.index', compact('data', 'hasMembers', 'constants'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'COMPETITOR_NAME' => 'required',
            'MARKET_SHARE' => 'required',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/AddCompanyCompetitor?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.activity.competitors.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'COMPETITOR_NAME' => 'required',
            'MARKET_SHARE' => 'required',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/UpdateCompanyCompetitor?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.activity.competitors.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function delete(Request $request)
    {
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/DeleteCompanyCompetitor?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'COMPETITOR_ID' => $request->id,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        return response()->json(compact('status', 'msg'));
    }

    public function noMember(Request $request){
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/UpdateProfileHasCompetitors?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'HAS_COMPETITORS_FLAG' => $request->HAS_COMPETITORS_FLAG,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.activity.competitors.index');

        return response()->json(compact('status', 'msg', 'url'));
    }

}
