<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ForgetPasswordController extends Controller
{
    public function index(Request $request)
    {
        return view('portal.forget_password');
    }

    public function requestCode(Request $request)
    {
        $apiURL = config('app.api').'/PortalUsersApi/api/auth/RequestVerfyCode';
        $postInput = [
            'USER_NAME' => $request->USER_NAME,
        ];

        $response = Http::post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $user_id = '';
        $phone = '';
        if($status){
            $user_id = $responseBody['data']['USER_ID'];
            $phone = $responseBody['data']['CELULLAR'];
        }

        return response()->json(compact('status', 'msg', 'user_id', 'phone'));
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
