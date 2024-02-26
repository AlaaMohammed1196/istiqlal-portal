<?php

namespace App\Http\Controllers\Portal\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BoardController extends Controller
{
    public function index(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['BoardMembers'];
        $hasMembers = $constants['CompanyProfileData']['CompanyGeneralInfo']['CompanyGeneralInfo'][0]['HAS_BOARD_MEMBERS_FLAG'];

        return view('portal.company.board.index', compact('data', 'hasMembers', 'constants'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'MEMBER_FULL_NAME' => 'required',
            'REPERSENTATIVE_NAME' => 'required',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/AddBoardMember?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.board.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'MEMBER_FULL_NAME' => 'required',
            'REPERSENTATIVE_NAME' => 'required',
            'IS_PARTNER' => 'required',
            'IS_SIGNER' => 'required',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/UpdateBoardMember?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.board.index');

        if($status){
            Session::put('success', $msg);
        }
        return response()->json(compact('status', 'msg', 'url'));
    }

    public function delete(Request $request)
    {
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/DeleteBoardMember?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'MEMBER_ID' => $request->id,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        return response()->json(compact('status', 'msg'));
    }

    public function noMember(Request $request){
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/UpdateProfileHasBoardMembers?MODULE_ID='.config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'HAS_BOARD_MEMBERS_FLAG' => $request->HAS_BOARD_MEMBERS_FLAG,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.company.board.index');

        return response()->json(compact('status', 'msg', 'url'));
    }
}
