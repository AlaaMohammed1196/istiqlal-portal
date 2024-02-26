<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ForgetPasswordController extends Controller
{
    public function by(Request $request)
    {
        return view('auth.forget_password_by');
    }

    public function index(Request $request)
    {
        try {
            $apiURL = config('app.api').'/PortalUsersApi/api/auth/GetSignUpConstants';
            $response = Http::get($apiURL);
            $responseBody = json_decode($response->getBody(), true);
            $time = $responseBody['VALIDITY_OF_VERIFY_CODE_IN_MINUTES'];
        }catch (\Exception $ex) {
            $time = 1;
        }

        return view('portal.forget_password', compact('time'));
    }

    public function indexByMobile(Request $request)
    {
        try {
            $apiURL = config('app.api').'/PortalUsersApi/api/auth/GetSignUpConstants';
            $response = Http::get($apiURL);
            $responseBody = json_decode($response->getBody(), true);
            $time = $responseBody['VALIDITY_OF_VERIFY_CODE_IN_MINUTES'];
        }catch (\Exception $ex) {
            $time = 1;
        }

        return view('auth.forget_password_mobile', compact('time'));
    }

    public function indexByEmail(Request $request)
    {
        try {
            $apiURL = config('app.api').'/PortalUsersApi/api/auth/GetSignUpConstants';
            $response = Http::get($apiURL);
            $responseBody = json_decode($response->getBody(), true);
            $time = $responseBody['VALIDITY_OF_VERIFY_CODE_IN_MINUTES'];
        }catch (\Exception $ex) {
            $time = 1;
        }

        return view('auth.forget_password_email', compact('time'));
    }

    public function requestCode(Request $request)
    {
        $apiURL = config('app.api').'/PortalUsersApi/api/auth/RequestVerfyCode';
        $postInput = [
            'SENDING_METHOD_TYPE_ID' => $request->SENDING_METHOD_TYPE_ID,
            'USER_NAME' => $request->USER_NAME,
        ];
        if($request->EMAIL){
            $postInput['EMAIL'] = $request->EMAIL;
        }

        $response = Http::post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $user_id = '';
        $phone = '';
        $email = '';
        if($status){
            $user_id = $responseBody['data']['USER_ID'];
            $phone = $responseBody['data']['CELULLAR'];
            if($request->SENDING_METHOD_TYPE_ID == 2){
                $email = $responseBody['data']['EMAIL'];
            }
        }

        return response()->json(compact('status', 'msg', 'user_id', 'phone', 'email'));
    }

    public function verifyCode(Request $request)
    {
        $apiURL = config('app.api').'/PortalUsersApi/api/auth/CheckVerfyCode';

        $postInput = [
            'USER_ID' => $request->USER_ID,
            'VERIFY_CODE' => $request->code4.''.$request->code3.''.$request->code2.''.$request->code1,
        ];

        $response = Http::post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        return response()->json(compact('status', 'msg'));
    }
}
