<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $data = getMyTamweels();
        if($data['code']==401) return redirect()->route('portal.logout');
        $data = $data['data']['Funds'];
        return view('portal.my_loans.index', compact('data'));
    }

    public function show(Request $request, $id)
    {
        $constants = getMyTamweels();
        if($constants['code']==401) return redirect()->route('portal.logout');
        $item = collect($constants['data']['Funds'])->where('FUND_ID', $id)->first();

        $constants = getFundInstallments($id);
        if($constants['code']==401) return redirect()->route('portal.logout');
        $installments = $constants['data']['FundInstallments'];

        return view('portal.my_loans.show', compact('item', 'installments'));
    }

    public function print(Request $request, $id)
    {
        $apiURL = config('app.reports').'/RhodesBankingReports/PortalFundApplication/FundInstallmentsReport';

        $headers = [
            'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
        ];

        $postInput = [
            'FUND_ID' => $id
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $file = $response->getBody()->getContents();
        $filename = 'FinancingApplicationsInstallmentsReport.pdf';

        return response()->streamDownload(function () use($file) {
            echo $file;
        }, $filename, [
            'Content-Type'=> 'application/json',
            'Accept'=> 'application/pdf',
        ]);
    }
}
