<?php

namespace App\Http\Controllers\Portal\RequestLoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class RequestLoanController extends Controller
{
    public function index(Request $request)
    {
        $constants = companyProfileComplete();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $complete = $constants['data']['IS_PORTAL_COMPLEATED'];
        if($complete == 0){
            return view('portal.request_loans.notComplete');
        }

        $constants = fundConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];

        $program = $request->program;
        $product = $request->product;
        $list = [];

        if($program && $product){
            $response = fetchProgram($program);
            if($response['code']==401) return redirect()->route('portal.logout');
            $status = $response['status'];
            if($status){
                $list = $response['data']['PRODUCT_TYPES'];
            }
        }

        return view('portal.request_loans.index', compact('constants', 'program', 'product', 'list'));
    }

    public function edit(Request $request, $id)
    {
        $is_active=false;
        $constants = companyProfileComplete();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $complete = $constants['data']['IS_PORTAL_COMPLEATED'];
        if($complete == 0){
            return view('portal.request_loans.notComplete');
        }

        $constants = fundConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];

        $data = getFundData($id);
        if($data['code']==401) return redirect()->route('portal.logout');
        $data = $data['data'];
        $currency = $data['Fund_Data'][0]['GOOD_CURR_NAME'];

        $FINANCING_PURPOSES_list = [];
        if($data['Fund_Data'][0]['FUND_SECTOR_ID']) {
            $responseBody = fetchPurpose($data['Fund_Data'][0]['FUND_SECTOR_ID']);
            $FINANCING_PURPOSES_list = $responseBody['data']['FINANCING_PURPOSES'];
        }

        $sources_list = getFundSources($id);
        $sources_list = $sources_list['data']['FUND_SOURCES'];
        if($request->ajax())
            return view('portal.request_loans_edit.components.list',compact('data','is_active'));

        $is_active=true;
        return view('portal.request_loans_edit.index', compact('constants', 'data', 'sources_list', 'FINANCING_PURPOSES_list', 'currency','is_active'));

    }

    public function duplicate(Request $request, $id)
    {
        $is_active=false;
        $constants = companyProfileComplete();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $complete = $constants['data']['IS_PORTAL_COMPLEATED'];
        if($complete == 0){
            return view('portal.request_loans.notComplete');
        }

        $constants = fundConstants();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $constants = $constants['data'];

        $data = getFundData($id);
        if($data['code']==401) return redirect()->route('portal.logout');
        $data = $data['data'];
        $currency = $data['Fund_Data'][0]['GOOD_CURR_NAME'];

        $responseBody = fetchPurpose($data['Fund_Data'][0]['FUND_SECTOR_ID']);
        $FINANCING_PURPOSES_list = $responseBody['data']['FINANCING_PURPOSES'];

        $sources_list = getFundSources($id);
        $sources_list = $sources_list['data']['FUND_SOURCES'];

        $duplicate = 1;

        if($request->ajax())
            return view('portal.request_loans_edit.components.list',compact('data','is_active'));

        $is_active=true;
        return view('portal.request_loans_edit.index', compact('constants', 'data', 'FINANCING_PURPOSES_list',
            'sources_list', 'duplicate', 'currency','is_active'));
    }
}
