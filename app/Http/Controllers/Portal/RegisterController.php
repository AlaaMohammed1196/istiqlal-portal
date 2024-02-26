<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        $apiURL = config('app.api').'/PortalUsersApi/api/auth/GetSignUpConstants';

        $response = Http::get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        $countries = $responseBody['data']['COUNTRIES'];
        $relations = $responseBody['data']['RELATIONS_WITH_COMPANIES'];

        return view('portal.register', compact('countries', 'relations'));
    }

    public function checkUserData(Request $request)
    {
        $this->validate($request, [
            'USER_FULL_NAME' => 'required',
            'ID_NUM' => 'required|digits:9',
            'EMAIL' => 'required|email',
            'CELULAR' => 'required|digits_between:9,10|starts_with:056,059',
            'CELULAR_COUNTRY_ID' => 'required',
            'registerCheck' => 'required',
        ]);

        $apiURL = config('app.api').'/PortalUsersApi/api/auth/CheckUserData';

        $postInput = [
            'USER_FULL_NAME' => $request->USER_FULL_NAME,
            'ID_NUM' => $request->ID_NUM,
            'EMAIL' => $request->EMAIL,
            "CELULAR_COUNTRY_ID" => $request->CELULAR_COUNTRY_ID,
            'CELULAR' => $request->CELULAR,
        ];

        $response = Http::post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        return response()->json(compact('status', 'msg'));
    }

    public function checkCompanyData(Request $request)
    {
        $this->validate($request, [
            'COMPANY_NAME_NA' => 'required',
            'COMPANY_ID_NUM' => 'required',
            'COMPANY_RELATION_ID' => 'required',
        ]);

        $apiURL = config('app.api').'/PortalUsersApi/api/auth/CheckCompanyData';

        $postInput = [
            'COMPANY_ID_NUM' => $request->COMPANY_ID_NUM,
        ];

        $response = Http::post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];

        if($status){
            $responseBody = register($request->all());
            $status = $responseBody['status'];
            if($status){
                $msg = $responseBody['message'];
                $USER_SEQ = $responseBody['data']['USER_SEQ'];
                return response()->json(compact('status', 'msg', 'USER_SEQ'));
            }else{
                $msg = $responseBody['message'];
                return response()->json(compact('status', 'msg'));
            }
        }else{
            $msg = $responseBody['message'];
            return response()->json(compact('status', 'msg'));
        }
    }

    public function codeResend(Request $request)
    {
        $responseBody = register($request->all());
        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $USER_SEQ = $responseBody['data']['USER_SEQ'];
        return response()->json(compact('status', 'msg', 'USER_SEQ'));
    }

    public function checkCode(Request $request)
    {
        $apiURL = config('app.api').'/PortalUsersApi/api/auth/ConfirmUser';

        $postInput = $request->all();

        $response = Http::post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        if($status){
            $user_id = $responseBody['data']['USER_ID'];
        }else{
            $user_id = null;
        }
        return response()->json(compact('status', 'msg', 'user_id'));
    }

    public function CreatePassword(Request $request)
    {
        $this->validate($request, [
            'USER_PASS' => 'required|confirmed',
            'USER_PASS_confirmation' => 'required',
        ]);

        $apiURL = config('app.api').'/PortalUsersApi/api/auth/CreatePassword';

        $postInput = [
            'USER_ID' => $request->USER_ID,
            'VERIFY_CODE' => $request->VERIFY_CODE,
            'USER_PASS' => $request->USER_PASS,
        ];

        $response = Http::post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        return response()->json(compact('status', 'msg'));
    }
}
