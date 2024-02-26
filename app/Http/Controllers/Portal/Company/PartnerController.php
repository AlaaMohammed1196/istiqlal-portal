<?php

namespace App\Http\Controllers\Portal\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['CompanyPartners'];

        return view('portal.company.partner.index', compact('data', 'constants'));
    }

    public function add(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];

        return view('portal.company.partner.add', compact('constants'));
    }

    public function addPerson(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];

        $countries = getCountries();

        return view('portal.company.partner.add_person', compact('constants', 'countries'));
    }

    public function storePerson(Request $request)
    {
        $this->validate($request, [
//            'PARTNER_FULL_NAME' => 'required',
            'FIRST_NAME_NA' => 'required',
            'FATHER_NAME_NA' => 'required',
            'GRAND_FATHER_NAME_NA' => 'required',
            'FAMILY_NAME_NA' => 'required',
            'ID_TYPE_ID' => 'required',
            'ID_NUM' => $request->ID_TYPE_ID==1?'required|digits:9':'required',
            'BIRTH_PLACE' => 'required',
            'BIRTH_DATE' => 'required',
            'GENDER_ID' => 'required',
            'MARITAL_STATUS_ID' => 'required',
            'NATIONALITY_ID.*' => 'required',
            'DEPENDENTS_CNT' => 'required',
            'SHARES_CNT' => 'required',
            'CONTRIBUTION_PERCENT' => 'required',
//            'IS_BANK_BORROWER' => 'required',
            'NOTES' => 'required|string|max:4000',
            'EDUCATION_LEVEL_ID' => 'required',
            'EXPERIENCE_YEARS_CNT' => 'required',
            'CURRENT_EXPERIENCE_NOTES' => 'required|string|max:4000',
            'OTHER_EXPERIENCE_NOTES' => 'required|string|max:4000',
            'COUNTRY_ID' => 'required',
            'STATE_ID' => 'required',
            'CITY_ID' => 'required',
            'ADDRESS' => 'required',
            'CELULAR_NUMBER' => 'required|digits:10|starts_with:056,059',
            'PHONE_NUMBER' => 'required|digits:9',
            'EMAIL' => 'required|email',
        ],[
            'ID_NUM' => 'رقم الوثيقة',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/AddIndividualPartner?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.partner.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function editPerson(Request $request, $id)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $list = $constants['CompanyProfileData']['CompanyPartners'];

        $data = '';
        foreach ($list as $item) {
            if ($id == $item['PARTNER_ID']) {
                $data = $item;
                break;
            }
        }

        $countries = getCountries();

        return view('portal.company.partner.edit_person', compact('data', 'constants', 'countries'));
    }

    public function updatePerson(Request $request)
    {
        $this->validate($request, [
//            'PARTNER_FULL_NAME' => 'required',
            'FIRST_NAME_NA' => 'required',
            'FATHER_NAME_NA' => 'required',
            'GRAND_FATHER_NAME_NA' => 'required',
            'FAMILY_NAME_NA' => 'required',
            'ID_TYPE_ID' => 'required',
            'ID_NUM' => $request->ID_TYPE_ID==1?'required|digits:9':'required',
            'BIRTH_PLACE' => 'required',
            'BIRTH_DATE' => 'required',
            'GENDER_ID' => 'required',
            'MARITAL_STATUS_ID' => 'required',
            'NATIONALITY_ID.*' => 'required',
            'DEPENDENTS_CNT' => 'required',
            'SHARES_CNT' => 'required',
            'CONTRIBUTION_PERCENT' => 'required',
//            'IS_BANK_BORROWER' => 'required',
            'NOTES' => 'required|string|max:4000',
            'EDUCATION_LEVEL_ID' => 'required',
            'EXPERIENCE_YEARS_CNT' => 'required',
            'CURRENT_EXPERIENCE_NOTES' => 'required|string|max:4000',
            'OTHER_EXPERIENCE_NOTES' => 'required|string|max:4000',
            'COUNTRY_ID' => 'required',
            'STATE_ID' => 'required',
            'CITY_ID' => 'required',
            'ADDRESS' => 'required',
            'CELULAR_NUMBER' => 'required|digits:10|starts_with:056,059',
            'PHONE_NUMBER' => 'required|digits:9',
            'EMAIL' => 'required|email',
        ],[],[
            'ID_NUM' => 'رقم الوثيقة',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/UpadteIndividualPartner?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.partner.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function addFirm(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];

        return view('portal.company.partner.add_firm', compact('constants'));
    }

    public function storeFirm(Request $request)
    {
        $this->validate($request, [
            'PARTNER_FULL_NAME' => 'required',
            'ID_NUM' => 'required',
            'SHARES_CNT' => 'required',
            'CONTRIBUTION_PERCENT' => 'required',
//            'IS_BANK_BORROWER' => 'required',
            'NOTES' => 'required|string|max:4000',
            'COMPANY_NOTES' => 'required|string|max:4000',
        ],[],[
            'ID_NUM' => 'رقم التسجيل'
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/AddFirmPartner?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.partner.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function editFirm(Request $request, $id)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $list = $constants['CompanyProfileData']['CompanyPartners'];

        $data = '';
        foreach ($list as $item) {
            if ($id == $item['PARTNER_ID']) {
                $data = $item;
                break;
            }
        }

        return view('portal.company.partner.edit_firm', compact('data', 'constants'));
    }

    public function updateFirm(Request $request)
    {
        $this->validate($request, [
            'PARTNER_FULL_NAME' => 'required',
            'ID_NUM' => 'required',
            'SHARES_CNT' => 'required',
            'CONTRIBUTION_PERCENT' => 'required',
//            'IS_BANK_BORROWER' => 'required',
            'NOTES' => 'required|string|max:4000',
            'COMPANY_NOTES' => 'required|string|max:4000',
        ],[],[
            'ID_NUM' => 'رقم التسجيل'
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/UpdateFirmPartner?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.partner.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function delete(Request $request)
    {
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/DeleteIndividualOrFirmPartner?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        return response()->json(compact('status', 'msg'));
    }

    public function isBorrower(Request $request)
    {
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/IsBankBorrower?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $value = $responseBody['data'];

        return response()->json(compact('status', 'msg', 'value'));
    }
}
