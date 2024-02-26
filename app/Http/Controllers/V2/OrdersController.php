<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page??1;
        $data = [
            'REQUEST_SEQ' => $request->REQUEST_SEQ??'',
            'APPROVAL_STATUS_ID' => $request->APPROVAL_STATUS_ID??1,
        ];
        $tab = $request->tab;

        try {
            $responseBody = $this->GetCustomerRequestsConstants();
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $constants = $responseBody['data'];

            $responseBody = $this->GetCustomerBeneficiaryRequests($page, $data);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $b_status = $responseBody['status'];
            $beneficiaries = $responseBody['data']['CUSTOMER_BENEFICIARIES'];
            $beneficiary_pages = $responseBody['data'];
            unset($beneficiary_pages['CUSTOMER_BENEFICIARIES']);

            $responseBody = $this->GetTransferRequests($page, $data);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $t_status = $responseBody['status'];
            $transfers = $responseBody['data']['TRANSFERS'];
            $transfer_pages = $responseBody['data'];
            unset($transfer_pages['TRANSFERS']);

            $responseBody = $this->GetTicketsRequests($page, $data);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $tkt_status = $responseBody['status'];
            $tickets = $responseBody['data']['CRM_TICKETS'];
            $ticket_pages = $responseBody['data'];
            unset($ticket_pages['CRM_TICKETS']);

            $responseBody = $this->GetDepositsRequests($page, $data);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $d_status = $responseBody['status'];
            $deposits = $responseBody['data']['DEPOSITS'];
            $deposit_pages = $responseBody['data'];
            unset($deposit_pages['DEPOSITS']);

        }catch (\Exception $e){
            $constants = [
                'TWO_FACTOR_AUTHENTICATION_STATUSES' => []
            ];
            $beneficiaries = [];
            $beneficiary_pages = [];
            $transfers = [];
            $transfer_pages = [];
            $tickets = [];
            $ticket_pages = [];
            $deposits = [];
            $deposit_pages = [];
        }

        if($request->ajax()){
            if($request->type==1){
                $status = $b_status;
                $html = view('portal_v2.orders.beneficiaries.index', compact('beneficiary_pages', 'beneficiaries'))->render();
                return response()->json(compact('status', 'html'));
            }
            if($request->type==2){
                $status = $t_status;
                $html = view('portal_v2.orders.transfers.index', compact('transfer_pages', 'transfers'))->render();
                return response()->json(compact('status', 'html'));
            }
            if($request->type==3){
                $status = $tkt_status;
                $html = view('portal_v2.orders.tickets.index', compact('ticket_pages', 'tickets'))->render();
                return response()->json(compact('status', 'html'));
            }
            if($request->type==4){
                $status = $d_status;
                $html = view('portal_v2.orders.deposits.index', compact('deposit_pages', 'deposits'))->render();
                return response()->json(compact('status', 'html'));
            }
        }

        return view('portal_v2.orders.index', compact('constants',
            'beneficiary_pages',
            'beneficiaries',
            'transfer_pages',
            'transfers',
            'tickets',
            'ticket_pages',
            'deposits',
            'deposit_pages',
            'tab'));
    }

    public function filter(Request $request)
    {
        try {
            $responseBody = $this->GetCustomerBeneficiaryRequests(1, $request->all());
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $b_status = $responseBody['status'];
            $beneficiaries = $responseBody['data']['CUSTOMER_BENEFICIARIES'];
            $beneficiary_pages = $responseBody['data'];
            unset($beneficiary_pages['CUSTOMER_BENEFICIARIES']);

            $responseBody = $this->GetTransferRequests(1, $request->all());
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $t_status = $responseBody['status'];
            $transfers = $responseBody['data']['TRANSFERS'];
            $transfer_pages = $responseBody['data'];
            unset($transfer_pages['TRANSFERS']);

            $responseBody = $this->GetTicketsRequests(1, $request->all());
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $tkt_status = $responseBody['status'];
            $tickets = $responseBody['data']['CRM_TICKETS'];
            $ticket_pages = $responseBody['data'];
            unset($transfer_pages['CRM_TICKETS']);

            $responseBody = $this->GetDepositsRequests(1, $request->all());
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $d_status = $responseBody['status'];
            $deposits = $responseBody['data']['DEPOSITS'];
            $deposit_pages = $responseBody['data'];
            unset($deposit_pages['DEPOSITS']);

            $status = true;
        }catch (\Exception $ex){
            $beneficiaries = [];
            $beneficiary_pages = [];
            $transfers = [];
            $transfer_pages = [];
            $tickets = [];
            $ticket_pages = [];
            $deposits = [];
            $deposit_pages = [];
            $status = false;
            $msg = $ex->getMessage();
        }

        if($status){
            $beneficiaries_html = view('portal_v2.orders.beneficiaries.index', compact('beneficiary_pages', 'beneficiaries'))->render();
            $transfers_html = view('portal_v2.orders.transfers.index', compact('transfer_pages', 'transfers'))->render();
            $tickets_html = view('portal_v2.orders.tickets.index', compact('ticket_pages', 'tickets'))->render();
            $deposits_html = view('portal_v2.orders.deposits.index', compact('deposit_pages', 'deposits'))->render();
            return response()->json(compact('status', 'beneficiaries_html', 'transfers_html', 'tickets_html', 'deposits_html'));
        }

        $msg = 'حدث خطأ ما!';
        return response()->json(compact('status', 'msg'));
    }

    public function details(Request $request)
    {
        $data = [
            'APPROVAL_STATUS_ID' => $request->status,
        ];
        if($request->type==1){
            $responseBody = $this->GetCustomerBeneficiaryRequests(0, $data);
            $beneficiaries = $responseBody['data']['CUSTOMER_BENEFICIARIES'];
            $status = $responseBody['status'];
            $msg = $responseBody['message'];
            $data = collect($beneficiaries)->where('BENEFICIARY_SEQ', $request->seq)->first();
            $html = view('portal_v2.orders.beneficiaries.details', compact('data'))->render();
            return response()->json(compact('status', 'html'));
        }elseif($request->type==2) {
            $responseBody = $this->GetTransferRequests(0, $data);
            $status = $responseBody['status'];
            $msg = $responseBody['message'];
            $transfers = $responseBody['data']['TRANSFERS'];
            $data = collect($transfers)->where('VOUCHER_SEQ', $request->seq)->first();
            $html = view('portal_v2.orders.transfers.details', compact('data'))->render();
        }elseif($request->type==3) {
            $responseBody = $this->GetTicketsRequests(0, $data);
            $status = $responseBody['status'];
            $msg = $responseBody['message'];
            $tickets = $responseBody['data']['CRM_TICKETS'];
            $data = collect($tickets)->where('TICKET_SEQ', $request->seq)->first();
            $html = view('portal_v2.orders.tickets.details', compact('data'))->render();
        }elseif($request->type==4){
            $responseBody = $this->GetDepositsRequests(0, $data);
            $status = $responseBody['status'];
            $msg = $responseBody['message'];
            $deposits = $responseBody['data']['DEPOSITS'];
            $data = collect($deposits)->where('DEPOSIT_SEQ', $request->seq)->first();
            $html = view('portal_v2.orders.deposits.details', compact('data'))->render();
        }else{
            $html = '';
            $status = false;
            $msg = 'حدث خطأ ما';
        }

        return response()->json(compact('status', 'html', 'msg'));
    }

    public function reject(Request $request)
    {
        if($request->type == 1){
            $apiURL = config('app.api').'/BeneficiariesApi/api/Beneficiary/ChangeTmpCustomerBeneficiary?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $postInput = [
                'BENEFICIARY_SEQ' => $request->seq,
            ];
        }elseif($request->type == 2){
            $apiURL = config('app.api').'/TransfersApi/api/Transfer/ChangeTmpTransfer?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $postInput = [
                'VOUCHER_SEQ' => $request->seq,
            ];
        }elseif($request->type == 3){
            $apiURL = config('app.api').'/CompanyPortalApi/API/ProfileTickets/ChangeTmpCrmTickets?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $postInput = [
                'TICKET_SEQ' => $request->seq,
            ];
        }else{
            $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/ChangeTmpDeposit?MODULE_ID='.Session::get('userData')['MODULE_ID'];
            $postInput = [
                'DEPOSIT_SEQ' => $request->seq,
            ];
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput['APPROVAL_STATUS'] = $request->answer;
        $postInput['REJECT_NOTES'] = '';

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);
        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        return response()->json(compact('status', 'msg'));
    }

    public function print(Request $request)
    {
        $apiURL = config('app.reports').'/RhodesBankingReports/Portalreports/TransferRequest?VOUCHER_SEQ='.$request->VOUCHER_SEQ;

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $file = $response->getBody()->getContents();

        $status = true;
        $file = base64_encode($file);

        return response()->json(compact('status', 'file'));
    }

    function GetCustomerBeneficiaryRequests($page=1, $data=[]){
        $apiURL = config('app.api').'/BeneficiariesApi/api/beneficiary/GetCustomerBeneficiaryRequests?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL = $apiURL.'&PAGE='.$page;

        if(isset($data['REQUEST_SEQ'])){
            $apiURL = $apiURL.'&REQUEST_SEQ='.$data['REQUEST_SEQ'];
        }
        if(isset($data['APPROVAL_STATUS_ID']) && $data['APPROVAL_STATUS_ID'] != 0){
            $apiURL = $apiURL.'&APPROVAL_STATUS_ID='.$data['APPROVAL_STATUS_ID'];
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }

    function GetTransferRequests($page=1, $data=[]){
        $apiURL = config('app.api').'/TransfersApi/api/Transfer/GetTransferRequests?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL = $apiURL.'&PAGE='.$page;

        if(isset($data['REQUEST_SEQ'])){
            $apiURL = $apiURL.'&REQUEST_SEQ='.$data['REQUEST_SEQ'];
        }
        if(isset($data['APPROVAL_STATUS_ID']) && $data['APPROVAL_STATUS_ID'] != 0){
            $apiURL = $apiURL.'&APPROVAL_STATUS_ID='.$data['APPROVAL_STATUS_ID'];
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }

    function GetTicketsRequests($page=1, $data=[]){
        $apiURL = config('app.api').'/CompanyPortalApi/API/ProfileTickets/GetTmpTickets?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL = $apiURL.'&PAGE='.$page;

        if(isset($data['REQUEST_SEQ']) && $data['REQUEST_SEQ']){
            $apiURL = $apiURL.'&REQUEST_SEQ='.$data['REQUEST_SEQ'];
        }
        if(isset($data['APPROVAL_STATUS_ID']) && $data['APPROVAL_STATUS_ID'] != 0){
            $apiURL = $apiURL.'&APPROVAL_STATUS_ID='.$data['APPROVAL_STATUS_ID'];
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }

    function GetDepositsRequests($page=1, $data=[]){
        $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/GetTmpDeposits?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL = $apiURL.'&PAGE='.$page;

        if(isset($data['REQUEST_SEQ']) && $data['REQUEST_SEQ']){
            $apiURL = $apiURL.'&DEPOSIT_SEQ='.$data['REQUEST_SEQ'];
        }
        if(isset($data['APPROVAL_STATUS_ID']) && $data['APPROVAL_STATUS_ID'] != 0){
            $apiURL = $apiURL.'&APPROVAL_STATUS_ID='.$data['APPROVAL_STATUS_ID'];
        }

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }

    function GetCustomerRequestsConstants(){
        $apiURL = config('app.api').'/BeneficiariesApi/api/beneficiary/GetCustomerBeneficiaryRequestsConstants?MODULE_ID='.Session::get('userData')['MODULE_ID'];

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }
}
