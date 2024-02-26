<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AccountActivateController extends Controller
{
    public function index(Request $request)
    {
        try {
            $apiURL = config('app.api').'/PortalUsersApi/api/auth/GetInvitationData?ACTIVATION_TOKEN='.$request->ACTIVATION_TOKEN;
            $response = Http::get($apiURL);
            $responseBody = json_decode($response->getBody(), true);
            $status = $responseBody['status'];
            $msg = $responseBody['message'];
            $data = $responseBody['data'];
            $data['ACTIVATION_TOKEN'] = $request->ACTIVATION_TOKEN;
        }catch (\Exception $ex){
            $status = false;
            $msg = $ex->getMessage();
            $data = [];
        }
        return view('auth.account_activate', compact('data', 'status', 'msg'));
    }

    public function requestCode(Request $request){
        try {
            $apiURL = config('app.api').'/PortalUsersApi/api/auth/GetInvitationData?ACTIVATION_TOKEN='.$request->ACTIVATION_TOKEN;
            $response = Http::get($apiURL);
            $responseBody = json_decode($response->getBody(), true);
            $status = $responseBody['status'];
            $msg = $responseBody['message'];
        }catch (\Exception $ex){
            $status = false;
            $msg = $ex->getMessage();
            $data = [];
        }
        return response()->json(compact('status', 'msg'));
    }
    public function checkCode(Request $request)
    {
        $apiURL = config('app.api').'/PortalUsersApi/api/auth/ConfirmInvitationUser';

        $postInput = [
            'USER_ID' => $request->USER_ID,
            'VERIFY_CODE' => $request->code4.''.$request->code3.''.$request->code2.''.$request->code1,
            'ACTIVATION_TOKEN' => $request->ACTIVATION_TOKEN,
        ];

        $response = Http::post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        return response()->json(compact('status', 'msg'));
    }
}
