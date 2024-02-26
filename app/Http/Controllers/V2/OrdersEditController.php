<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OrdersEditController extends Controller
{
    public function transfersEdit(Request $request, $seq){
        try {
            $responseBody = (new TransfersController)->GetAddTransferConstants();
            $constants = $responseBody['data'];

            $responseBody = (new OrdersController())->GetTransferRequests(0);
            $transfers = $responseBody['data']['TRANSFERS'];
            $data = collect($transfers)->where('VOUCHER_SEQ', $seq)->first();

            $internal_beneficiaries = [];
            $external_beneficiaries = [];
            if($data['PAY_TYPE_ID'] == 7 || $data['PAY_TYPE_ID'] == 8){
                $beneficiaries = GetCustomerBeneficiaries();
                $beneficiaries = $beneficiaries['data']['CUSTOMER_BENEFICIARIES'];
                $external_beneficiaries = collect($beneficiaries)->where('BANK_LOCATION', '!=', 3);
                $internal_beneficiaries = collect($beneficiaries)->where('BANK_LOCATION', 3);
            }

        }catch (\Exception $ex){
            $constants = [];
            $data = [];
            $internal_beneficiaries = [];
            $external_beneficiaries = [];
        }

        return view('portal_v2.orders.transfers.edit', compact('constants', 'data', 'external_beneficiaries', 'internal_beneficiaries'));
    }

    public function beneficiariesEdit(Request $request, $seq){
        try {
            $responseBody = (new OrdersController())->GetCustomerBeneficiaryRequests(0);
            $transfers = $responseBody['data']['CUSTOMER_BENEFICIARIES'];
            $data = collect($transfers)->where('BENEFICIARY_SEQ', $seq)->first();

            $responseBody = getBeneficiaryConstants();
            $constants = $responseBody['data'];

            $types = collect($constants['BeneficiaryTypes'])->sortByDesc('VALUE');
            $currencies = $constants['Currencies'];
            $ledgers = $constants['LedgerTypes'];

            $banks = getBanks();
            if($banks['code']==401) return redirect()->route('portal.v2.logout');
            $banks = $banks['data']['BANKS'];
            $branches = [];
            if(isset($data['BANK_ID'])){
                $branches = getBankBankBranches($data['BANK_ID']);
            }

        }catch (\Exception $ex){
            $data = [];
            $banks = [];
            $branches = [];
            $types = [];
            $currencies = [];
            $ledgers = [];
        }

        return view('portal_v2.orders.beneficiaries.edit', compact('banks', 'types', 'currencies', 'branches', 'ledgers', 'data'));
    }
}
