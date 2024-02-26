<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

function getBanks(){
    $apiURL = config('app.api').'/ServicesApi/API/Constants/GetBanks?MODULE_ID='.Session::get('userData')['MODULE_ID'];

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}

function getBankBankBranches($CONSTANT_ID){
    $apiURL = config('app.api').'/ServicesApi/API/Constants/GetBankBranches?MODULE_ID='.Session::get('userData')['MODULE_ID'].'&CONSTANT_ID='.$CONSTANT_ID;

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody['data']['BANK_BRANCHES'];
}

function getBeneficiaryConstants(){
    $apiURL = config('app.api').'/BeneficiariesApi/api/beneficiary/GetAddUpdateBeneficiaryConstants?MODULE_ID='.Session::get('userData')['MODULE_ID'];

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}

function GetCustomerExternalBeneficiary(){
    $apiURL = config('app.api').'/BeneficiariesApi/api/beneficiary/GetCustomerExternalBeneficiary?MODULE_ID='.Session::get('userData')['MODULE_ID'];

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody['data'];
}

function GetCustomerBeneficiaries($page=0, $data=[]){
    $apiURL = config('app.api').'/BeneficiariesApi/api/beneficiary/GetCustomerBeneficiaries?MODULE_ID='.Session::get('userData')['MODULE_ID'];
    $apiURL = $apiURL.'&PAGE='.$page;
    if(isset($data['BENEFICIARY_FULL_NAME'])){
        $apiURL = $apiURL.'&BENEFICIARY_FULL_NAME='.$data['BENEFICIARY_FULL_NAME'];
    }
    if(isset($data['BANK_LOCATION']) && $data['BANK_LOCATION']!=0){
        $apiURL = $apiURL.'&BANK_LOCATION='.$data['BANK_LOCATION'];
    }

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}

function getCurrencies(){
    $apiURL = config('app.api').'/ServicesApi/API/Constants/GetCurrencies?MODULE_ID='.Session::get('userData')['MODULE_ID'];

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}

function GetSearchAccountsDepositsConstatns(){
    $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyDeposits/GetDepositsBindConstants?MODULE_ID='.Session::get('userData')['MODULE_ID'];

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}

function NumberFormat($num ,$places=2){
    return number_format($num, $places);
}
