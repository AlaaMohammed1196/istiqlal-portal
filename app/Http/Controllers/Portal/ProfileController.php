<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = getUserData();
        if($user['code']==401) return redirect()->route('portal.logout');
        $data = $user['data']['USER'][0];

        return view('portal.profile.index', compact('data'));
    }

    public function edit(Request $request)
    {
        $constants = $this->getConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');

        $countries = $constants['data']['COUNTRIES'];
        $genders = $constants['data']['GENDERS'];
        $nationalities = $constants['data']['NATIONALITIES'];
        $jobs = $constants['data']['JOBS'];

        $user = getUserData();
        if($user['code']==401) return redirect()->route('portal.logout');
        $data = $user['data']['USER'][0];

        return view('portal.profile.create', compact('countries', 'genders', 'nationalities', 'jobs', 'data'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'USER_PICTURE' => 'nullable|max:'.maxSize().'|mimes:'.acceptImageType(0),
            'EMAIL' => 'required|email',
        ]);

        $apiURL = config('app.api').'/PortalUsersApi/api/auth/UpdateUser?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->except('USER_PICTURE');

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.profile.index');

        if($request->USER_PICTURE){
            $path = generalUpload('attachments', $request->USER_PICTURE);
            if($path){
                deleteUpload($path);
                $apiURL = config('app.api_attach').'/PortalUsersApi/api/auth/UpdateUserPicture?MODULE_ID='.config('app.MODULE_ID');
                $response = Http::attach(
                    'USER_PICTURE', file_get_contents($request->USER_PICTURE), $request->USER_PICTURE->getClientOriginalName()
                )->withHeaders($headers)->post($apiURL, $postInput);
                $responseBody = json_decode($response->getBody(), true);
            }
        }

        if($status){
            $user = getUserData();
            if($user['code']==401) return redirect()->route('portal.logout');
            Session::put('user', $user['data']['USER'][0]);
        }

        Session::put('success', $responseBody['message']);
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function getConstants(){
        $apiURL = config('app.api').'/PortalUsersApi/api/auth/GetUserConstants?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }

    public function updatePhone(Request $request){
        $this->validate($request, [
            'CELULAR' => 'required|digits_between:9,10|starts_with:056,059',
        ]);

        $apiURL = config('app.api').'/PortalUsersApi/api/auth/UpdateUserCelular?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'CELULAR_COUNTRY_ID' => $request->CELULAR_COUNTRY_ID,
            'CELULAR' => $request->CELULAR,
            'IS_VERIFIED' => $request->IS_VERIFIED,
            'VERIFY_CODE' => $request->code4.''.$request->code3.''.$request->code2.''.$request->code1,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        return response()->json(compact('status', 'msg'));
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'USER_PASS' => 'required',
            'NEW_USER_PASS' => 'required|confirmed',
            'NEW_USER_PASS_confirmation' => 'required',
        ]);

        $apiURL = config('app.api').'/PortalUsersApi/api/auth/ChangePassword?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'USER_PASS' => $request->USER_PASS,
            'NEW_USER_PASS' => $request->NEW_USER_PASS,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $user = getUserData();
            if($user['code']==401) return redirect()->route('portal.logout');
            Session::put('user', $user['data']['USER'][0]);
        }

        return response()->json(compact('status', 'msg'));
    }
}
