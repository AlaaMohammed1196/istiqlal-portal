<?php

namespace App\Http\Controllers\Portal\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['CompanyGeneralInfo']['CompanyGeneralInfo'][0];

        return view('portal.company.notes.index', compact('data', 'constants'));
    }

    public function edit(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['CompanyGeneralInfo']['CompanyGeneralInfo'][0];

        return view('portal.company.notes.edit', compact('data', 'constants'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'NOTES' => 'required|string|max:4000',
        ],[],[
            'NOTES' => 'الملاحظات',
        ]);

        $postInput = $request->all();

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/UpdateCompanyNote?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.note.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }
}
