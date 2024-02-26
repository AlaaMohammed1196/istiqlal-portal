<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class TechnicalSupportController extends Controller
{
    public function index(Request $request)
    {
        try {
             $data = $this->getData();
            if ($data['status'] == true) {

                $data = $data['data']['BRANCH'];
                if (count($data) > 0) {
                    $info_branch = $data[0];
                } else {
                    $info_branch = [];
                }
              } else {
                $info_branch = [];
            }
        } catch (\Exception $ex) {
            $info_branch = [];
        }
        return view('portal.technicalSupport.index', compact('info_branch'));

    }

    public function getData()
    {
        $apiURL = config('app.api') . '/ServicesApi/API/Data/GetCenteralBranchContactsInformation?MODULE_ID=' . config('app.MODULE_ID');

        $headers = [
            'Authorization' => 'Bearer ' . Session::get('userData')['TOKEN_KEY'],
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }

}
