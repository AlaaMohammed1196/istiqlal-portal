<?php

namespace App\Http\Controllers\Portal\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class InfoController extends Controller
{
    public function index(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['CompanyGeneralInfo'];
        $approval = $constants['APPROVAL_STATUS_ID'];
        if($approval == 1 || $approval == 3){
            return view('portal.company.deny', compact('data', 'constants'));
        }
        return view('portal.company.info.index', compact('data', 'constants'));
    }

    public function edit(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['CompanyGeneralInfo'];

        $activity_types = [];
        if(isset($data['CompanyGeneralInfo'][0]['ECONOMIC_ACTIVITY_ID'])){
            $activity_types = getActivities($data['CompanyGeneralInfo'][0]['ECONOMIC_ACTIVITY_ID']);
        }

        return view('portal.company.info.edit', compact('data', 'constants', 'activity_types'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'FIRM_LEGAL_TYPE_ID' => 'required',
            'ISTABLISHMENT_DATE' => 'required|date_format:d-m-Y|after:01-01-1900',
            'CAPITAL' => 'required',
            'ISSUE_DATE' => 'required|date_format:d-m-Y|after:01-01-1900',
            'ECONOMIC_ACTIVITY_ID' => 'required',
            'ACTIVITY_ID' => 'required',
            'ANNUAL_SALES_RATE' => 'required',
            'EMPLOYEES_MALE_CNT' => 'required',
            'EMPLOYEES_FEMALE_CNT' => 'required',
            'AUTHORIZATION_LETTER_COMPANY_FILE' => $request->is_file_exist==1?'required|min:1|max:'.maxSize().'|mimes:'.acceptImagePdfType(0):'nullable|min:1|max:'.maxSize().'|mimes:'.acceptImagePdfType(0),
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/UpdateCompanyGeneral?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();
        $postInput['CAPITAL'] = str_replace([','], "", $postInput['CAPITAL']);
        $postInput['ANNUAL_SALES_RATE'] = str_replace([','], "", $postInput['ANNUAL_SALES_RATE']);
        unset($postInput['AUTHORIZATION_LETTER_COMPANY_FILE']);

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.info.index');

        if($request->AUTHORIZATION_LETTER_COMPANY_FILE){
            $path = generalUpload('attachments', $request->AUTHORIZATION_LETTER_COMPANY_FILE);
            if($path){
                deleteUpload($path);
                $apiURL = config('app.api_attach').'/CompanyPortalApi/api/CompanyProfile/UpdateAuthorizationLetterCompany?MODULE_ID='.config('app.MODULE_ID');
                $response = Http::attach(
                    'AUTHORIZATION_LETTER_COMPANY_FILE', file_get_contents($request->AUTHORIZATION_LETTER_COMPANY_FILE), $request->AUTHORIZATION_LETTER_COMPANY_FILE->getClientOriginalName()
                )->withHeaders($headers)->post($apiURL, $postInput);
                $responseBody = json_decode($response->getBody(), true);
                if(!$responseBody['status']){
                    $status = $responseBody['status'];
                    $msg = $responseBody['message'];
                    return response()->json(compact('status', 'msg', 'url'));
                }
            }
        }

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }
}
