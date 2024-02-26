<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('portal.auth.login');
    }

    public function checkNumber(Request $request)
    {
        $this->validate($request, [
            'USER_NAME' => 'required',
        ]);

        $apiURL = config('app.api').'/PortalUsersApi/api/auth/CheckVatNumberModule';

        $postInput = [
            'USER_NAME' => $request->USER_NAME,
        ];

        try {
            $response = Http::post($apiURL, $postInput);
            $responseBody = json_decode($response->getBody(), true);
        } catch (\Exception $ex) {
            $status = false;
            $msg = 'حدث خطأ ما الرجاء المحاولة فيما بعد';
            $url = route('portal.home');
            return response()->json(compact('url', 'status', 'msg'));
        }

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $data = $responseBody['data'];

        return response()->json(compact('status', 'msg', 'data'));

    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'USER_NAME' => 'required',
            'EMAIL' => $request->MODULE_ID==1?'nullable':'required',
            'USER_PASS' => 'required',
        ]);

        $apiURL = config('app.api').'/PortalUsersApi/api/auth/Login';
        $postInput = [
            'USER_NAME' => $request->USER_NAME,
            'USER_PASS' => $request->USER_PASS,
            'MODULE_ID' => 1,
        ];
        if($request->EMAIL){
            $postInput['EMAIL'] = $request->EMAIL;
        }

        try {
            $response = Http::post($apiURL, $postInput);
            $responseBody = json_decode($response->getBody(), true);
        } catch (\Exception $ex) {
            $status = false;
            $msg = 'حدث خطأ ما الرجاء المحاولة فيما بعد';
            $url = route('portal.home');
            return response()->json(compact('url', 'status', 'msg'));
        }

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            Session::put('userData', $responseBody['data']['USER_INFO'][0]);
            $user = getUserData();
            if($user['code']==401) return redirect()->route('portal.logout');
            Session::put('user', $user['data']['USER'][0]);
        }

        $url = $request->MODULE_ID==1?route('portal.home'):route('portal.home');
        return response()->json(compact('url', 'status', 'msg'));
    }

    public function logout(Request $request)
    {
        Session::forget('userData');
        return redirect()->route('portal.login');
    }
}
