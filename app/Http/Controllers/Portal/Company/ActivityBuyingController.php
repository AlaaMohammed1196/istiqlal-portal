<?php

namespace App\Http\Controllers\Portal\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ActivityBuyingController extends Controller
{
    public function index(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['CompanySuppliers'];
        $policy = $constants['CompanyProfileData']['CompanyBuyPolicy'];

        return view('portal.company.activity.buying.index', compact('data', 'policy', 'constants'));
    }

    public function edit(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['CompanySuppliers'];
        $policy = $constants['CompanyProfileData']['CompanyBuyPolicy'];

        return view('portal.company.activity.buying.edit', compact('data', 'policy'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'CLIENT_SUPPLIER_NAME' => 'required',
            'BUY_SELL_PERCENT' => 'required',
            'BUY_PLACE' => 'required',
            'CLIENT_SUPPLIER_NOTES' => 'required|string|max:2000',
        ],[],[
            'CLIENT_SUPPLIER_NAME' => 'اسم المورد',
            'BUY_SELL_PERCENT' => 'نسبة الشراء %',
            'BUY_PLACE' => 'مصدر التوريد',
            'CLIENT_SUPPLIER_NOTES' => 'توضيحات أخرى',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/AddProfileSupplier?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.activity.buying.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'CLIENT_SUPPLIER_NAME' => 'required',
            'BUY_SELL_PERCENT' => 'required',
            'BUY_PLACE' => 'required',
            'CLIENT_SUPPLIER_NOTES' => 'required|string|max:2000',
        ],[],[
            'CLIENT_SUPPLIER_NAME' => 'اسم المورد',
            'BUY_SELL_PERCENT' => 'نسبة الشراء %',
            'BUY_PLACE' => 'مصدر التوريد',
            'CLIENT_SUPPLIER_NOTES' => 'توضيحات أخرى',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/UpdateProfileSupplier?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.activity.buying.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function delete(Request $request)
    {
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/DeleteProfileClientSupplier?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'CLIENT_SUPPLIER_ID' => $request->id,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        return response()->json(compact('status', 'msg'));
    }

    public function storePolicy(Request $request)
    {
        $this->validate($request, [
            'BUY_SELL_SUB_FLAG' => 'required',
            'COMMERCE_POLICY_PERCENT' => 'required',
            'COMMERCE_POLICY_PERIOD' => 'required',
            'NOTES' => 'required|string|max:2000',
        ],[],[
            'BUY_SELL_SUB_FLAG' => 'السياسة',
            'COMMERCE_POLICY_PERCENT' => 'نسبة الشراء %',
            'COMMERCE_POLICY_PERIOD' => 'مدة الآجل / الأيام',
            'NOTES' => 'توضيحات أخرى',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/AddProfileBuyPolicy?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.activity.buying.index');

        if($status){
            $constants = companyConstants();
            $constants = $constants['data'];
            $policy = $constants['CompanyProfileData']['CompanyBuyPolicy'];
            $html = view('portal.company.activity.buying.policy', compact('policy'))->render();
            return response()->json(compact('status', 'html', 'policy'));
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function updatePolicy(Request $request){
        $this->validate($request, [
            'BUY_SELL_SUB_FLAG' => 'required',
            'COMMERCE_POLICY_PERCENT' => 'required',
            'COMMERCE_POLICY_PERIOD' => 'required',
            'NOTES' => 'required|string|max:2000',
        ],[],[
            'BUY_SELL_SUB_FLAG' => 'السياسة',
            'COMMERCE_POLICY_PERCENT' => 'نسبة الشراء %',
            'COMMERCE_POLICY_PERIOD' => 'مدة الآجل / الأيام',
            'NOTES' => 'توضيحات أخرى',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/UpdateProfileBuyPolicy?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.activity.buying.index');

        if($status){
            $constants = companyConstants();
            $constants = $constants['data'];
            $policy = $constants['CompanyProfileData']['CompanyBuyPolicy'];
            $html = view('portal.company.activity.buying.policy', compact('policy'))->render();
            return response()->json(compact('status', 'html', 'policy'));
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function deletePolicy(Request $request){
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/DeleteProfileBuyPolicy?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'BUY_SELL_ID' => $request->id,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        return response()->json(compact('status', 'msg'));
    }
}
