<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BeneficiariesController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page??1;
        $data = $request->all()??[];
        try {
            $responseBody = GetCustomerBeneficiaries($page, $data);
            if($responseBody['code']==403) return view('portal_v2.beneficiaries.no_permission', ['msg' => $responseBody['message']]);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $status = $responseBody['status'];
            $beneficiaries = $responseBody['data']['CUSTOMER_BENEFICIARIES'];
            $pages = $responseBody['data'];
            unset($pages['CUSTOMER_BENEFICIARIES']);

            $constants = getBeneficiaryConstants();
            if($constants['code']==401) return redirect()->route('portal.v2.logout');
            $constants = $constants['data'];
            $types = collect($constants['BeneficiaryTypes'])->sortByDesc('VALUE');
        }catch (\Exception $ex){
            $status = false;
            $beneficiaries = [];
            $pages = [];
            $types = [];
        }

        if($request->ajax()){
            $html = view('portal_v2.beneficiaries.table', compact('beneficiaries', 'pages'))->render();
            return response()->json(compact('status', 'html'));
        }

        return view('portal_v2.beneficiaries.index', compact('beneficiaries', 'pages', 'types'));
    }

    public function show(Request $request)
    {
        $id = $request->id;
        try {
            $responseBody = GetCustomerBeneficiaries(0);
            $status = $responseBody['status'];
            $beneficiaries = collect($responseBody['data']['CUSTOMER_BENEFICIARIES']);
            $data = $beneficiaries->where('BENEFICIARY_ID', $id)->first();
        }catch (\Exception $ex){
            $status = false;
            $data = [];
        }

        $html = view('portal_v2.beneficiaries.details', compact('data'))->render();
        return response()->json(compact('status', 'html'));
    }

    public function create(Request $request)
    {
        try {
            $banks = getBanks();
            if($banks['code']==403) return view('portal_v2.beneficiaries.no_permission', ['msg' => $responseBody['message']]);
            if($banks['code']==401) return redirect()->route('portal.v2.logout');
            $banks = $banks['data']['BANKS'];
            $constants = getBeneficiaryConstants();
            if($constants['code']==401) return redirect()->route('portal.v2.logout');
            $constants = $constants['data'];
            $types = collect($constants['BeneficiaryTypes'])->sortBy('CONSTANT_CODE1');
            $currencies = $constants['Currencies'];
            $ledgers = $constants['LedgerTypes'];
        }catch (\Exception $ex){
            $banks = [];
            $types = [];
            $currencies = [];
            $ledgers = [];
        }

        return view('portal_v2.beneficiaries.create', compact('banks', 'types', 'currencies', 'ledgers'));
    }

    public function edit(Request $request, $id)
    {
        try {
            $responseBody = GetCustomerBeneficiaries();
            if($responseBody['code']==403) return view('portal_v2.beneficiaries.no_permission', ['msg' => $responseBody['message']]);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $data = $responseBody['data']['CUSTOMER_BENEFICIARIES'];
            $data = collect($data)->where('BENEFICIARY_ID', $id)->first();
            $banks = getBanks();
            if($banks['code']==401) return redirect()->route('portal.v2.logout');
            $banks = $banks['data']['BANKS'];
            $branches = [];
            if(isset($data['BANK_ID'])){
                $branches = getBankBankBranches($data['BANK_ID']);
            }
            $constants = getBeneficiaryConstants();
            if($constants['code']==401) return redirect()->route('portal.v2.logout');
            $constants = $constants['data'];
            $types = collect($constants['BeneficiaryTypes'])->sortByDesc('VALUE');
            $currencies = $constants['Currencies'];
            $ledgers = $constants['LedgerTypes'];
        }catch (\Exception $ex){
            $data = [];
            $banks = [];
            $branches = [];
            $types = [];
            $currencies = [];
            $ledgers = [];
        }

        return view('portal_v2.beneficiaries.edit', compact('banks', 'types', 'currencies', 'branches', 'ledgers', 'data'));
    }

    public function storeOrUpdate(Request $request)
    {
        if($request->BANK_LOCATION == 2){
            $rules = [
                'BENEFICIARY_FULL_NAME' => 'required',
                'BENEFICIARY_ADDRESS' => 'required',
                'IBAN' => 'required',
                'BANK_NAME' => 'required',
                'BANK_BRANCH_NAME' => 'required',
                'SWIFT_CODE' => 'required',
                'NOTES' => 'nullable',
                'VERIFY_CODE' => isset($request->code_is_required)&&$request->code_is_required==1?'required':'nullable',
            ];
            $labels = [
                'IBAN' => 'رقم الحساب الدولي',
            ];
        }elseif ($request->BANK_LOCATION == 1){
            $rules = [
                'BENEFICIARY_FULL_NAME' => 'required',
                'BENEFICIARY_ADDRESS' => 'required',
                'IBAN' => 'required',
                'BANK_ID' => 'required',
                'BANK_BRANCH_ID' => 'required',
                'NOTES' => 'nullable',
                'VERIFY_CODE' => isset($request->code_is_required)&&$request->code_is_required==1?'required':'nullable',
            ];
            $labels = [
                'IBAN' => 'IBAN',
            ];
        }else{
            $rules = [
                'BENEFICIARY_FULL_NAME' => 'required',
                'BENEFICIARY_ADDRESS' => 'required',
                'BANK_ACCOUNT_NUMBER' => 'required',
                'BENEFICIARY_CURR_ID' => 'required',
                'BENEFICIARY_LEDGER_ID' => 'required',
                'BENEFICIARY_ACC_SUB_NUM' => 'required',
                'NOTES' => 'nullable',
                'VERIFY_CODE' => isset($request->code_is_required)&&$request->code_is_required==1?'required':'nullable',
            ];
            $labels = [];
        }
        $this->validate($request, $rules, [], $labels);


        if($request->BENEFICIARY_SEQ && $request->BENEFICIARY_ID){
            $apiURL = config('app.api').'/BeneficiariesApi/api/beneficiary/UpdateCustomerBeneficiaryRequest?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        }elseif ($request->BENEFICIARY_ID){
            $apiURL = config('app.api').'/BeneficiariesApi/api/beneficiary/UpdateCustomerBeneficiary?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        }else{
            $apiURL = config('app.api').'/BeneficiariesApi/api/beneficiary/AddCustomerBeneficiary?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();
        unset($postInput['code_is_required']);

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.v2.orders.index');

        return response()->json(compact('status', 'msg', 'url'));
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'VERIFY_CODE' => isset($request->code_is_required)&&$request->code_is_required==1?'required':'nullable',
        ]);

        $apiURL = config('app.api').'/BeneficiariesApi/api/beneficiary/DeleteCustomerBeneficiary?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL = $apiURL.'&BENEFICIARY_ID='.$request->id;

        if(isset($request->VERIFY_CODE) && $request->VERIFY_CODE){
            $apiURL = $apiURL.'&VERIFY_CODE='.$request->VERIFY_CODE;
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->post($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.v2.orders.index');

        return response()->json(compact('status', 'msg', 'url'));
    }
}
