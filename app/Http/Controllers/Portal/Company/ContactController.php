<?php

namespace App\Http\Controllers\Portal\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['CompanyGeneralInfo']['CompanyContactInfo'];

        return view('portal.company.contact.index', compact('data', 'constants'));
    }

    public function edit(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['CompanyGeneralInfo']['CompanyContactInfo'];

        $countries = getCountries();

        return view('portal.company.contact.edit', compact('data', 'constants', 'countries'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'CURR_COUNTRY_ID' => 'required',
            'CURR_STATE_ID' => 'required',
            'CURR_CITY_ID' => 'required',
            'CURR_ADDRESS' => 'required',
            'CONTACT_EMAIL' => 'required|email',
            'CONTACT_CELULARS' => 'required',
            'CONTACT_CELULARS.*.CONTACT_CELULARS' => 'required|digits_between:9,10|starts_with:056,059',
//            'CONTACT_CELULAR' => 'required|digits_between:9,10|starts_with:05,5',
            'CONTACT_TEL' => 'required|digits:9',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/UpdateCompanyContactInfo?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();
        $postInput['CONTACT_CELULARS'] = [];

        foreach ($request->CONTACT_CELULARS as $number){
            array_push($postInput['CONTACT_CELULARS'], $number['CONTACT_CELULARS']);
        }

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.contact.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }
}
