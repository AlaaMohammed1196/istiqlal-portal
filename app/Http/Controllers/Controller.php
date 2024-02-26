<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if(Session::has('userData')){
                $apiURL = config('app.api').'/NotificationsAPI/api/Notifications/GetAllNotifications?&MODULE_ID='.Session::get('userData')['MODULE_ID'];
                $headers = [
                    'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
                ];
                $postInput = [
                    'CUST_ID' => 2,
                    'SEND_TYPE_ID' => 1,
                    'SYSTEM_ID' => Session::get('userData')['MODULE_ID']==2?5:4,
                ];
                try {
                    $response = Http::withHeaders($headers)->post($apiURL, $postInput);
                    $notifications = json_decode($response->getBody(), true);

                    $constants = GetSearchAccountsDepositsConstatns();
                    if($constants['status']){
                        $deposit_types = $constants['data']['DEPOSIT_TYPES'];
                        $currencies = $constants['data']['CURRENCIES'];
                    }else{
                        $deposit_types = [];
                        $currencies = [];
                    }
                } catch (\Exception $ex) {
                    $deposit_types = [];
                    $currencies = [];
                    $notifications = [
                        'UnReadNotifications' => [
                            "Notifications" => []
                        ],
                        'ReadNotifications' => [
                            "Notifications" => []
                        ],
                        'AllNotifications' => [
                            "Notifications" => []
                        ],
                    ];
                }
            }else{
                $deposit_types = [];
                $currencies = [];
                $notifications = [
                    'UnReadNotifications' => [
                        "Notifications" => []
                    ],
                    'ReadNotifications' => [
                        "Notifications" => []
                    ],
                    'AllNotifications' => [
                        "Notifications" => []
                    ],
                ];
            }

            View::share(compact('notifications', 'deposit_types', 'currencies'));
            return $next($request);
        });
    }

}
