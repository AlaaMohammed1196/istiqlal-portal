<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class TransfersController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page??1;
        $data = $request->all();
        $sort = [
            'col' => $request->ORDER_COLUMN_NAME,
            'type' => $request->ORDER_TYPE,
        ];
        try {
            $responseBody = $this->GetAllCustomerTransfers($page, $data);
            if($responseBody['code']==403) return view('portal_v2.beneficiaries.no_permission', ['msg' => $responseBody['message']]);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $status = $responseBody['status'];
            $transfers = $responseBody['data']['TRANSFERS'];
            $pages = $responseBody['data'];
            unset($pages['TRANSFERS']);

            $responseBody = $this->GetAddTransferConstants();
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $types = $responseBody['data']['TransferTypes'];
            $currencies = $responseBody['data']['Currencies'];
            $sources = $responseBody['data']['TransferSources'];

        }catch (\Exception $ex){
            $status = false;
            $transfers = [];
            $pages = [];
            $types = [];
            $currencies = [];
            $sources = [];
        }

        if($request->ajax()){
            $html = view('portal_v2.transfers.table', compact('transfers', 'pages', 'sort'))->render();
            return response()->json(compact('status', 'html'));
        }

        return view('portal_v2.transfers.index', compact('transfers', 'pages', 'types', 'currencies', 'sources', 'sort'));
    }

    public function show(Request $request)
    {
        $id = $request->id;
        try {
            $responseBody = $this->GetAllCustomerTransfers(0);
            $status = $responseBody['status'];
            $transfers = collect($responseBody['data']['TRANSFERS']);
            $data = $transfers->where('VOUCHER_NO', $id)->first();
        }catch (\Exception $ex){
            $status = false;
            $data = [];
        }

        $html = view('portal_v2.transfers.details', compact('data'))->render();
        return response()->json(compact('status', 'html'));
    }

    public function create(Request $request)
    {
        try {
            $responseBody = getCurrencies();
            if($responseBody['code']==403) return view('portal_v2.beneficiaries.no_permission', ['msg' => $responseBody['message']]);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $currencies = $responseBody['data']['CURRENCIES'];
            $responseBody = $this->GetAddTransferConstants();
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $constants = $responseBody['data'];
            $beneficiaries = GetCustomerBeneficiaries();
            if($beneficiaries['code']==401) return redirect()->route('portal.v2.logout');
            $beneficiaries = $beneficiaries['data']['CUSTOMER_BENEFICIARIES'];
            $external_beneficiaries = collect($beneficiaries)->where('BANK_LOCATION', '!=', 3);
            $internal_beneficiaries = collect($beneficiaries)->where('BANK_LOCATION', 3);
        }catch (\Exception $ex){
            $currencies = [];
            $constants = [];
            $internal_beneficiaries = [];
            $external_beneficiaries = [];
        }

        return view('portal_v2.transfers.create', compact('constants', 'external_beneficiaries', 'internal_beneficiaries', 'currencies'));
    }

    public function GetTransferSummary(Request $request)
    {
        if($request->transfer_type == 8){
            if(!isset($request->BENEFICIARY_ID)){
                return response()->json(['status'=>false, 'msg'=>'يحب ان يكون هناك مستفيد واحد على الأقل']);
            }
            $rules = [
                'CUST_LEDGER_ID' => 'required',
                'CURR_ID' => 'required',
                'NOTES' => 'nullable',
                'AMOUNT.*' => 'required|numeric|min:1',
            ];
        }elseif ($request->transfer_type == 7){
            if(!isset($request->BENEFICIARY_ID)){
                return response()->json(['status'=>false, 'msg'=>'يحب ان يكون هناك مستفيد واحد على الأقل']);
            }
            $rules = [
                'CUST_LEDGER_ID' => 'required',
                'INCLUDE_COMMISSION' => count($request->BENEFICIARY_ID)>1?'nullable':'required',
                'CURR_ID' => 'required',
                'NOTES' => 'nullable',
                'ATTACHMENTS.*' => 'nullable|max:'.maxSize().'|mimes:'.acceptImagePdfType(0),
                'AMOUNT.*' => 'required|numeric|min:1',
            ];
        }else{
            $rules = [
                'FROM_LEDGER_ID' => 'required',
                'TO_LEDGER_ID' => 'required',
                'CURR_ID' => 'required',
                'AMOUNT' => 'required|numeric|min:1',
                'REMITTANCE_PURPOSE_ID' => 'required',
                'NOTES' => 'nullable',
            ];
        }
        $this->validate($request, $rules, [], [
            'BENEFICIARY_ID' => 'إلى حساب',
        ]);

        if($request->transfer_type == 8){
            $apiURL = config('app.api').'/TransfersApi/api/transfer/GetInternalTransferSummary?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        }elseif ($request->transfer_type == 7){
            $apiURL = config('app.api').'/TransfersApi/api/transfer/GetExternalTransferSummary?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        }else{
            $apiURL = config('app.api').'/TransfersApi/api/transfer/GetTransferBetweenAccountsSummary?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        if($request->transfer_type == 8 || $request->transfer_type == 7){
            $postInput = $request->all();
            $postInput['BEN'] = array_values(collect($postInput['BENEFICIARY_ID'])->zip($postInput['AMOUNT'],
                $postInput['REMITTANCE_PURPOSE_ID'])
                ->transform(function ($values) {
                    return [
                        'BENEFICIARY_ID' => $values[0],
                        'AMOUNT' => $values[1],
                        'REMITTANCE_PURPOSE_ID' => $values[2],
                    ];
                })->all());

            unset($postInput['BENEFICIARY_ID'], $postInput['AMOUNT'], $postInput['REMITTANCE_PURPOSE_ID'], $postInput['transfer_type']);
            unset($postInput['transfer_type']);
            if(isset($postInput['ATTACHMENTS'])){
                unset($postInput['ATTACHMENTS']);
            }

            $newJsonString = [
                "JSON"=> json_encode($postInput)
            ];
            $response = Http::asForm()->withHeaders($headers)->post($apiURL, $newJsonString);
        }else{
            $newJsonString = $request->all();
            unset($newJsonString['transfer_type']);
            $response = Http::withHeaders($headers)->post($apiURL, $newJsonString);
        }
        $responseBody = json_decode($response->getBody(), true);

        $transfer_type = $request->transfer_type;
        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $html = '';

        if($status){
            $data = $responseBody['data'][0];
            $html = view('portal_v2.transfers.confirm_data', compact('data', 'transfer_type'))->render();
        }

        return response()->json(compact('status', 'msg', 'html'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'VERIFY_CODE' => isset($request->code_is_required)&&$request->code_is_required==1?'required':'nullable',
        ]);

        if($request->VOUCHER_SEQ){
            if($request->transfer_type == 8){
                $apiURL = config('app.api').'/TransfersApi/api/transfer/UpdateInternalTransfer?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            }elseif ($request->transfer_type == 7){
                $apiURL = config('app.api').'/TransfersApi/api/transfer/UpdateExternalTransfer?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            }else{
                $apiURL = config('app.api').'/TransfersApi/api/transfer/UpdateTransferBetweenAccounts?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            }
        }else{
            if($request->transfer_type == 8){
                $apiURL = config('app.api').'/TransfersApi/api/transfer/AddInternalTransfer?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            }elseif ($request->transfer_type == 7){
                $apiURL = config('app.api').'/TransfersApi/api/transfer/AddExternalTransfer?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            }else{
                $apiURL = config('app.api').'/TransfersApi/api/transfer/AddTransferBetweenAccounts?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            }
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        if($request->transfer_type == 8 || $request->transfer_type == 7){
            $postInput = $request->all();
            $postInput['BEN'] = array_values(collect($postInput['BENEFICIARY_ID'])->zip($postInput['AMOUNT'],
                $postInput['REMITTANCE_PURPOSE_ID'])
                ->transform(function ($values) {
                    return [
                        'BENEFICIARY_ID' => $values[0],
                        'AMOUNT' => $values[1],
                        'REMITTANCE_PURPOSE_ID' => $values[2],
                    ];
                })->all());

            unset($postInput['BENEFICIARY_ID'], $postInput['AMOUNT'], $postInput['REMITTANCE_PURPOSE_ID'], $postInput['transfer_type']);
            unset($postInput['transfer_type'], $postInput['ATTACHMENTS']);

            $newJsonString = [
                "JSON"=> json_encode($postInput)
            ];

            if(isset($request->ATTACHMENTS) && count($request->ATTACHMENTS) > 0){
                $response = Http::withHeaders($headers);
                foreach ($request->ATTACHMENTS as $attach){
                    $response = $response->attach('ATTACHMENTS', file_get_contents($attach), $attach->getClientOriginalName());
                }
            }else{
                $response = Http::asForm()->withHeaders($headers);
            }
            $response = $response->post($apiURL, $newJsonString);
        }else{
            $newJsonString = $request->all();
            unset($newJsonString['transfer_type']);
            $response = Http::asForm()->withHeaders($headers)->post($apiURL, $newJsonString);
        }
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];
        $url = route('portal.v2.orders.index').'?tab=transfers';

        return response()->json(compact('status', 'msg', 'url'));
    }

    public function print(Request $request)
    {
        $apiURL = config('app.api').'/TransfersApi/api/Transfer/GetTransfersExcel?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL = $apiURL.'&PAGE=0';

        $data = $request->all();

        if(isset($data['FROM_DATE'])){
            $apiURL = $apiURL.'&FROM_DATE='.$data['FROM_DATE'];
        }
        if(isset($data['TO_DATE'])){
            $apiURL = $apiURL.'&TO_DATE='.$data['TO_DATE'];
        }
        if(isset($data['PAY_TYPE_ID']) && $data['PAY_TYPE_ID']!=-1){
            $apiURL = $apiURL.'&PAY_TYPE_ID='.$data['PAY_TYPE_ID'];
        }
        if(isset($data['FROM_AMOUNT'])){
            $apiURL = $apiURL.'&FROM_AMOUNT='.$data['FROM_AMOUNT'];
        }
        if(isset($data['TO_AMOUNT'])){
            $apiURL = $apiURL.'&TO_AMOUNT='.$data['TO_AMOUNT'];
        }
        if(isset($data['CURR_ID'])  && $data['CURR_ID']!=-1){
            $apiURL = $apiURL.'&CURR_ID='.$data['CURR_ID'];
        }
        if(isset($data['TRANSFER_SOURCE'])  && $data['TRANSFER_SOURCE']!=-1){
            $apiURL = $apiURL.'&TRANSFER_SOURCE='.$data['TRANSFER_SOURCE'];
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $file = $response->getBody()->getContents();

        $status = true;
        $file = base64_encode($file);

        return response()->json(compact('status', 'file'));
    }
    function GetAllCustomerTransfers($page=0, $data=[]){
        $apiURL = config('app.api').'/TransfersApi/api/Transfer/GetTransfers?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL = $apiURL.'&PAGE='.$page;
        if(isset($data['FROM_DATE'])){
            $apiURL = $apiURL.'&FROM_DATE='.$data['FROM_DATE'];
        }
        if(isset($data['TO_DATE'])){
            $apiURL = $apiURL.'&TO_DATE='.$data['TO_DATE'];
        }
        if(isset($data['PAY_TYPE_ID']) && $data['PAY_TYPE_ID']!=-1){
            $apiURL = $apiURL.'&PAY_TYPE_ID='.$data['PAY_TYPE_ID'];
        }
        if(isset($data['FROM_AMOUNT'])){
            $apiURL = $apiURL.'&FROM_AMOUNT='.$data['FROM_AMOUNT'];
        }
        if(isset($data['TO_AMOUNT'])){
            $apiURL = $apiURL.'&TO_AMOUNT='.$data['TO_AMOUNT'];
        }
        if(isset($data['CURR_ID'])  && $data['CURR_ID']!=-1){
            $apiURL = $apiURL.'&CURR_ID='.$data['CURR_ID'];
        }
        if(isset($data['TRANSFER_SOURCE'])  && $data['TRANSFER_SOURCE']!=-1){
            $apiURL = $apiURL.'&TRANSFER_SOURCE='.$data['TRANSFER_SOURCE'];
        }
        if(isset($data['ORDER_COLUMN_NAME'])){
            $apiURL = $apiURL.'&ORDER_COLUMN_NAME='.$data['ORDER_COLUMN_NAME'];
        }
        if(isset($data['ORDER_TYPE'])){
            $apiURL = $apiURL.'&ORDER_TYPE='.$data['ORDER_TYPE'];
        }
        if(isset($data['IS_COLUMN_DATE'])){
            $apiURL = $apiURL.'&IS_COLUMN_DATE='.$data['IS_COLUMN_DATE'];
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }

    function GetAddTransferConstants(){
        $apiURL = config('app.api').'/TransfersApi/api/transfer/GetAddTransferConstants?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL = $apiURL.'&VOUCHER_NO=""';

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }

    public function pdfPrint(Request $request)
    {
        $apiURL = config('app.reports').'/RhodesBankingReports/Portalreports/Transfers';

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $file = $response->getBody()->getContents();

        $status = true;
        $file = base64_encode($file);

        return response()->json(compact('status', 'file'));
    }
}
