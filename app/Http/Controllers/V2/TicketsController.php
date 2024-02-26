<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class TicketsController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page??1;
        $data = $request->all();
        $sort = [
            'col' => $request->ORDER_COLUMN_NAME,
            'type' => $request->ORDER_TYPE,
        ];
        $responseBody = $this->GetTicketsConstnats();
        if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
        $constants = $responseBody['data'];
        $responseBody = $this->GetTickets($page, $data);
        if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
        $status = $responseBody['status'];
        $tickets = $responseBody['data']['CRM_TICKETS'];
        $pages = $responseBody['data'];
        unset($pages['CRM_TICKETS']);

        if($request->ajax()){
            $html = view('portal_v2.tickets.table', compact('tickets', 'pages', 'sort'))->render();
            return response()->json(compact('status', 'html'));
        }

        return view('portal_v2.tickets.index', compact('constants', 'tickets', 'pages', 'sort'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'TICKET_TITLE' => 'required',
            'TICKET_DESCRIPTION' => 'required',
            'TICKET_TYPE_ID' => 'required',
            'TICKET_PRIORITY_ID' => 'required',
            'TICKET_ATTACHMENTS' => 'nullable|max:3',
            'TICKET_ATTACHMENTS.*' => 'nullable|max:'.maxSize().'|mimes:'.acceptImagePdfType(0),
            'VERIFY_CODE' => isset($request->code_is_required)&&$request->code_is_required==1?'required':'nullable',
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/API/ProfileTickets/AddTicket?&MODULE_ID='.Session::get('userData')['MODULE_ID'];

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();

        if(isset($postInput['TICKET_ATTACHMENTS']) && count($postInput['TICKET_ATTACHMENTS']) > 0){
            $response = Http::withHeaders($headers);
            foreach ($postInput['TICKET_ATTACHMENTS'] as $attach){
                $response = $response->attach('TICKET_ATTACHMENTS', file_get_contents($attach), $attach->getClientOriginalName());
            }
            unset($postInput['TICKET_ATTACHMENTS']);
        }else{
            $response = Http::asForm()->withHeaders($headers);
        }

        $response = $response->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
//            $responseBody = $this->GetTickets(1);
//            $tickets = $responseBody['data']['CRM_TICKETS'];
//            $pages = $responseBody['data'];
//            unset($pages['CRM_TICKETS']);
//            $sort = [
//                'col' => $request->ORDER_COLUMN_NAME,
//                'type' => $request->ORDER_TYPE,
//            ];
//            $html = view('portal_v2.tickets.table', compact('tickets', 'pages', 'sort'))->render();
            $url = route('portal.v2.orders.index').'?tab=tickets';
            return response()->json(compact('status', 'msg', 'url'));
        }

        return response()->json(compact('status', 'msg'));
    }

    public function show(Request $request, $id)
    {
        $responseBody = $this->GetTicketDetails($id);
        if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
        $data = $responseBody['data']['CRM_TICKETS'][0];
        return view('portal_v2.tickets.show', compact('data'));
    }

    public function storeComment(Request $request)
    {
        $this->validate($request, [
            'TICKET_ID' => 'required',
            'COMMENT_DESCRIPTION' => 'required',
            'COMMENT_ATTACHMENTS' => 'nullable|max:3',
            'COMMENT_ATTACHMENTS.*' => 'nullable|max:'.maxSize().'|mimes:'.acceptImagePdfType(0),
        ]);

        $apiURL = config('app.api').'/CompanyPortalApi/API/ProfileTickets/AddTicketComment?&MODULE_ID='.Session::get('userData')['MODULE_ID'];

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = $request->all();
        unset($postInput['index']);

        if(isset($postInput['COMMENT_ATTACHMENTS']) && count($postInput['COMMENT_ATTACHMENTS']) > 0){
            $response = Http::withHeaders($headers);
            foreach ($postInput['COMMENT_ATTACHMENTS'] as $attach){
                $response = $response->attach('COMMENT_ATTACHMENTS', file_get_contents($attach), $attach->getClientOriginalName());
            }
            unset($postInput['COMMENT_ATTACHMENTS']);
        }else{
            $response = Http::asForm()->withHeaders($headers);
        }

        $response = $response->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        $status = $responseBody['status'];
        $msg = $responseBody['message'];

        if($status){
            $responseBody = $this->GetTicketDetails($postInput['TICKET_ID']);
            if($responseBody['code']==401) return redirect()->route('portal.v2.logout');
            $data = $responseBody['data']['CRM_TICKETS'][0];
            $html = view('portal_v2.tickets.chat', compact('data'))->render();
            return response()->json(compact('status', 'msg', 'html'));
        }

        return response()->json(compact('status', 'msg'));
    }

    function GetTickets($page=0, $data=[]){
        $apiURL = config('app.api').'/CompanyPortalApi/API/ProfileTickets/GetTickets?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL = $apiURL.'&PAGE='.$page;
        if(isset($data['DATE_FROM'])){
            $apiURL = $apiURL.'&DATE_FROM='.$data['DATE_FROM'];
        }
        if(isset($data['DATE_TO'])){
            $apiURL = $apiURL.'&DATE_TO='.$data['DATE_TO'];
        }
        if(isset($data['TICKET_TITLE'])){
            $apiURL = $apiURL.'&TICKET_TITLE='.$data['TICKET_TITLE'];
        }
        if(isset($data['TICKET_TYPE_ID'])){
            $apiURL = $apiURL.'&TICKET_TYPE_ID='.$data['TICKET_TYPE_ID'];
        }
        if(isset($data['TICKET_STATUS_ID'])){
            $apiURL = $apiURL.'&TICKET_STATUS_ID='.$data['TICKET_STATUS_ID'];
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

    function GetTicketDetails($id){
        $apiURL = config('app.api').'/CompanyPortalApi/API/ProfileTickets/GetTicketDetails?MODULE_ID='.Session::get('userData')['MODULE_ID'];
        $apiURL = $apiURL.'&TICKET_ID='.$id;

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }

    function GetTicketsConstnats(){
        $apiURL = config('app.api').'/CompanyPortalApi/API/ProfileTickets/GetTicketsConstnats?MODULE_ID='.Session::get('userData')['MODULE_ID'];

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }
}
