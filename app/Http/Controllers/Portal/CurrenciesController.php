<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CurrenciesController extends Controller
{
    public function index(Request $request)
    {
        try {
            $responseBody = $this->GetCurrenciesDataApi();
            $data = $responseBody['data'];
        }catch (\Exception $ex){
            $data = [];
        }
        return view('portal.currencies.index', compact('data'));
    }

    public function updateCurrenciesData(Request $request)
    {
        try {
            $responseBody = $this->GetCurrenciesDataApi();
            $data = $responseBody['data'];
        }catch (\Exception $ex){
            $data = [];
        }
        $html = view('portal.currencies.rows', compact('data'))->render();
        return response()->json(compact('data', 'html'));
    }

    public function GetCurrenciesDataApi()
    {
        $apiURL = config('app.api') . '/PortalFundsApi/api/Currency/GetCurrenciesData?MODULE_ID=' . config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer ' . Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }

    public function currencyExchange(Request $request)
    {
        $apiURL = config('app.api') . '/PortalFundsApi/api/Currency/GetAmmountEq?MODULE_ID=' . config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer ' . Session::get('userData')['TOKEN_KEY'],
            'Accept-Language' => getLocale(),
        ];

        $postInput = [
            'VALUE' => $request->cu_value,
            'FROM_CURR_ID' => $request->from,
            'TO_CURR_ID' =>  $request->to,
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
     }
}
