<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OrdersStepController extends Controller
{
    public function getSteps(Request $request)
    {
        $responseBody = $this->getRequestSteps($request->all());

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $steps = $responseBody['data']['COMMAND_STEPS'];
            $extra['APPROVAL_STATUS_ID'] = $request->status;
            if($request->type == 1){
                $extra['BENEFICIARY_SEQ'] = $request->seq;
                $html = view('portal_v2.orders.beneficiaries.steps', compact('steps', 'extra'))->render();
            }elseif($request->type == 2){
                $extra['VOUCHER_SEQ'] = $request->seq;
                $html = view('portal_v2.orders.transfers.steps', compact('steps', 'extra'))->render();
            }elseif($request->type == 3){
                $extra['TICKET_SEQ'] = $request->seq;
                $html = view('portal_v2.orders.tickets.steps', compact('steps', 'extra'))->render();
            }elseif($request->type == 4){
                $extra['DEPOSIT_SEQ'] = $request->seq;
                $html = view('portal_v2.orders.deposits.steps', compact('steps', 'extra'))->render();
            }else{
                $extra['DEPOSIT_SEQ'] = $request->seq;
                $html = view('portal_v2.orders.deposits.steps', compact('steps', 'extra'))->render();
            }
            return response()->json(compact('status', 'html'));
        }

        return response()->json(compact('status', 'msg'));
    }

    public function change(Request $request)
    {
        if($request->type == 1){
            $apiURL = config('app.api').'/BeneficiariesApi/api/Beneficiary/ChangeTmpCustomerBeneficiary?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        }elseif($request->type == 2){
            $apiURL = config('app.api').'/TransfersApi/api/Transfer/ChangeTmpTransfer?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        }elseif($request->type == 3){
            $apiURL = config('app.api').'/CompanyPortalApi/API/ProfileTickets/ChangeTmpCrmTickets?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        }elseif($request->type == 4){
            $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/ChangeTmpDeposit?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        }else{
            $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/ChangeTmpDeposit?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $approval = false;
        $status = true;
        $msg = '';

        if(isset($request->REQUEST_STEPS) && count($request->REQUEST_STEPS)>0){
            $postInput = $request->all();
            $steps = $postInput['REQUEST_STEPS'];
            unset($postInput['type']);
            $after = [];
            foreach ($steps as $item){
                if(isset($item['COMMAND_STEP_ROLES'])){
                    $new = [
                        'STEP_ID' => $item['STEP_ID'],
                        'COMMAND_STEP_ROLES' => array_values($item['COMMAND_STEP_ROLES']),
                    ];
                    array_push($after, $new);
                }
            }
            $postInput['REQUEST_STEPS'] = array_values($after);

            if(isset($postInput['REQUEST_STEPS']) && count($postInput['REQUEST_STEPS']) > 0){
                $response = Http::withHeaders($headers)->post($apiURL, $postInput);
                $responseBody = json_decode($response->getBody(), true);
                $status = $responseBody['status'];
                $msg = $responseBody['message'];
                if(isset($responseBody['data']['APPROVAL_STATUS_ID'])){
                    $approval = $responseBody['data']['APPROVAL_STATUS_ID']!=1?true:false;
                }
            }
        }

        return response()->json(compact('status', 'msg', 'approval'));
    }

    public function undo(Request $request)
    {
        if($request->type == 1){
            $apiURL = config('app.api').'/BeneficiariesApi/api/Beneficiary/UndoChangeRequestStepsApprovalStatus?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $postInput['BENEFICIARY_SEQ'] = $request->seq;
        }elseif($request->type == 2){
            $apiURL = config('app.api').'/TransfersApi/api/Transfer/UndoChangeRequestStepsApprovalStatus?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $postInput['VOUCHER_SEQ'] = $request->seq;
        }elseif($request->type == 3){
            $apiURL = config('app.api').'/CompanyPortalApi/API/ProfileTickets/UndoChangeRequestStepsTmpCrmTickets?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $postInput['TICKET_SEQ'] = $request->seq;
        }elseif($request->type == 4){
            $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/UndoChangeRequestStepsTmpDeposit?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $postInput['DEPOSIT_SEQ'] = $request->seq;
        }else{
            $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/UndoChangeRequestStepsTmpDeposit?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $postInput['DEPOSIT_SEQ'] = $request->seq;
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        try {
            $postInput['REQUEST_STEPS'] = [
                [
                    'STEP_ID' => $request->step,
                    'COMMAND_STEP_ROLES' => [
                        [
                            'ROLE_ID' => $request->role,
                        ]
                    ]
                ]
            ];

            $response = Http::withHeaders($headers)->post($apiURL, $postInput);
            $responseBody = json_decode($response->getBody(), true);
            $status = $responseBody['status'];
            $msg = $responseBody['message'];
            if(isset($responseBody['data']['APPROVAL_STATUS_ID'])){
                $approval = $responseBody['data']['APPROVAL_STATUS_ID']!=1?true:false;
            }else{
                $approval = false;
            }
        }catch (\Exception $e){
            $approval = false;
            $status = true;
            $msg = $e->getMessage();
        }

        return response()->json(compact('status', 'msg', 'approval'));
    }

    public function return(Request $request)
    {
        if($request->type == 1){
            $apiURL = config('app.api').'/BeneficiariesApi/api/Beneficiary/ReturnRequestToEntry?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $postInput['BENEFICIARY_SEQ'] = $request->seq;
        }elseif($request->type == 2){
            $apiURL = config('app.api').'/TransfersApi/api/Transfer/ReturnRequestToEntry?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $postInput['VOUCHER_SEQ'] = $request->seq;
        }elseif($request->type == 3){
            $apiURL = config('app.api').'/CompanyPortalApi/API/ProfileTickets/ReturnRequestToEntry?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $postInput['TICKET_SEQ'] = $request->seq;
        }elseif($request->type == 4){
            $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/ReturnRequestToEntry?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $postInput['DEPOSIT_SEQ'] = $request->seq;
        }else{
            $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/ReturnRequestToEntry?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $postInput['DEPOSIT_SEQ'] = $request->seq;
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        try {
            $response = Http::withHeaders($headers)->post($apiURL, $postInput);
            $responseBody = json_decode($response->getBody(), true);
            $status = $responseBody['status'];
            $msg = $responseBody['message'];
        }catch (\Exception $e){
            $status = true;
            $msg = $e->getMessage();
        }

        return response()->json(compact('status', 'msg'));
    }

    function getRequestSteps($data){

        if($data['type'] == 1){
            $apiURL = config('app.api').'/BeneficiariesApi/api/Beneficiary/GetCustomerBeneficiaryRequestSteps?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $apiURL = $apiURL.'&BENEFICIARY_SEQ='.$data['seq'];
        }elseif($data['type'] == 2){
            $apiURL = config('app.api').'/TransfersApi/api/Transfer/GetTransferRequestSteps?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $apiURL = $apiURL.'&VOUCHER_SEQ='.$data['seq'];
        }elseif($data['type'] == 3){
            $apiURL = config('app.api').'/CompanyPortalApi/API/ProfileTickets/GetTmpTicketRequestSteps?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $apiURL = $apiURL.'&TICKET_SEQ='.$data['seq'];
        }elseif($data['type'] == 4){
            $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/GetTmpDepositRequestSteps?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $apiURL = $apiURL.'&DEPOSIT_SEQ='.$data['seq'];
        }else{
            $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/GetTmpDepositRequestSteps?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $apiURL = $apiURL.'&DEPOSIT_SEQ='.$data['seq'];
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }
}
