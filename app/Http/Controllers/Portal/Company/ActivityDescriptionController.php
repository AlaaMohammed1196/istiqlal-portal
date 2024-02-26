<?php

namespace App\Http\Controllers\Portal\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ActivityDescriptionController extends Controller
{
    public function index(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['CompanyActivity'];

        return view('portal.company.activity.description.index', compact('data', 'constants'));
    }

    public function edit(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['CompanyActivity'];

        return view('portal.company.activity.description.edit', compact('data', 'constants'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'WORK_SPACE' => 'required',
            'REAL_STATE_OWNERSHIP' => 'required',
            'EXPERIENCE_YEARS_CNT' => 'required',
            'ACTIVITY_EXPLANATION_NOTES' => 'required|string|max:4000',
            'REAL_STATE_OWNERSHIP_NOTES' => 'required|string|max:4000',
            'EMPLOYEES_NOTES' => 'required|string|max:4000',
            'OTHER_NOTES' => 'required|string|max:4000',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/UpdateCompanyActivity?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.activity.description.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function storeSellWay(Request $request){
        $this->validate($request, [
            'SELLING_METHOD_ID' => 'required',
            'METHOD_PERCENT' => 'required',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/AddCompanyActivitySellingMethod?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.activity.description.index');

        if($status){
            $constants = companyConstants();
            $data = $constants['data']['CompanyProfileData']['CompanyActivity'];
            $html = view('portal.company.activity.description.table', compact('data'))->render();
            return response()->json(compact('status', 'msg', 'url', 'html', 'data'));
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function updateSellWay(Request $request){
        $this->validate($request, [
            'SELLING_METHOD_ID' => 'required',
            'METHOD_PERCENT' => 'required',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/UpdateCompanyActivitySellingMethod?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.activity.description.index');

        if($status){
            $constants = companyConstants();
            $data = $constants['data']['CompanyProfileData']['CompanyActivity'];
            $html = view('portal.company.activity.description.table', compact('data'))->render();
            return response()->json(compact('status', 'msg', 'url', 'html', 'data'));
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function deleteSellWay(Request $request){
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/DeleteCompanyActivitySellingMethod?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'METHOD_ID' => $request->id,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        return response()->json(compact('status', 'msg'));
    }
}
