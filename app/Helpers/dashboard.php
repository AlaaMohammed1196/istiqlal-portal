<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

function getLocale(){
    if(app()->getLocale()=='ar'){
        return 'NA';
    }else{
        return 'FO';
    }
}

function acceptImageType($val=1){
    if($val==0){
        return 'png,svg,jpg,jpeg';
    }
    return '.png, .svg, .jpg, .jpeg';
}
function acceptFileType($val=1){
    if($val==0){
        return 'pdf,ppt,pptx,doc,docx,xls,xlsx,rtf';
    }
    return '.pdf, .ppt, .pptx, .doc, .docx, .xls, .xlsx, .rtf';
}
function acceptImagePdfType($val=1){
    if($val==0){
        return 'png,svg,jpg,jpeg,pdf,ppt,pptx,doc,docx,xls,xlsx,rtf';
    }
    return '.png, .svg, .jpg, .jpeg, .pdf, .ppt, .pptx, .doc, .docx, .xls, .xlsx, .rtf';
}

function register($input){
    $apiURL = config('app.api').'/PortalUsersApi/api/auth/SignUp';

    $postInput = [
        'USER_FULL_NAME' => $input['USER_FULL_NAME'],
        'ID_NUM' => $input['ID_NUM'],
        'CELULAR_COUNTRY_ID' => $input['CELULAR_COUNTRY_ID'],
        'CELULAR' => $input['CELULAR'],
        'EMAIL' => $input['EMAIL'],
        'COMPANY_NAME_NA' => $input['COMPANY_NAME_NA'],
        'COMPANY_ID_NUM' => $input['COMPANY_ID_NUM'],
        'COMPANY_RELATION_ID' => $input['COMPANY_RELATION_ID'],
    ];

    $response = Http::post($apiURL, $postInput);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}

function getUserData(){
    $apiURL = config('app.api').'/PortalUsersApi/api/auth/GetUserData?MODULE_ID='.Session::get('userData')['MODULE_ID'];

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}

function companyConstants(){
    $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/GetCompanyProfileConstants?MODULE_ID='.Session::get('userData')['MODULE_ID'];

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}
function getCountries(){
    $apiURL = config('app.api').'/ServicesApi/API/Constants/GetCountries?MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody['data']['COUNTRIES'];
}
function getStates($id){
    $apiURL = config('app.api').'/ServicesApi/API/Constants/GetStates?MODULE_ID='.config('app.MODULE_ID').'&CONSTANT_ID='.$id;

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody['data']['STATES'];
}
function getCities($id){
    $apiURL = config('app.api').'/ServicesApi/API/Constants/GetCities?MODULE_ID='.config('app.MODULE_ID').'&CONSTANT_ID='.$id;

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody['data']['CITIES'];
}
function fundConstants(){
    $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/GetFundConstants?MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}
function getFundData($fundId){
    $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/GetFundApplicationData?FUND_ID='.$fundId.'&MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}
function getMyFunds(){
    $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/GetMyFundApplications?&MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);
  

    return $responseBody;
}

function getFundComments($fundId){
    $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/GetFundApplicationComments?FUND_ID='.$fundId.'&MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody['data'];
}

function getMyTamweels(){
    $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/GetMyTamweels?&MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}

function getFundInstallments($fundId){
    $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/GetFundInstallments?FUND_ID='.$fundId.'&MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}
function fetchProgram($PROGRAM_TYPE_ID){
    $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/FetchProductByProgram?MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $postInput = [
        'PROGRAM_TYPE_ID' => $PROGRAM_TYPE_ID,
    ];

    $response = Http::withHeaders($headers)->post($apiURL, $postInput);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}
function fetchPurpose($FUND_SECTOR_ID){
    $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/GetPurposesData?MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $postInput = [
        'FUND_SECTOR_ID' => $FUND_SECTOR_ID,
    ];

    $response = Http::withHeaders($headers)->post($apiURL, $postInput);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}
function getProgram(){
    $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/GetPrograms?MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}
function getProgramLoans($PROGRAM_TYPE_ID){
    $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/GetProductPrograms?MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $postInput = [
        'PROGRAM_TYPE_ID' => $PROGRAM_TYPE_ID,
    ];

    $response = Http::withHeaders($headers)->post($apiURL, $postInput);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}
function getProductDetails($PROGRAM_TYPE_ID){
    $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/GetProductDescription?MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $postInput = [
        'PRODUCT_TYPE_ID' => $PROGRAM_TYPE_ID,
    ];

    $response = Http::withHeaders($headers)->post($apiURL, $postInput);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}
function calculaterConstants(){
    $apiURL = config('app.api').'/CalculaterApi/API/CalculateFunds/CalculaterConstants';

    $headers = [
        'Authorization' => 'Bearer NGHQ1DF6D6fIs7Z82TQMYCZKVASFiS88AQ6MAEWJUKCQV82AKM7FIIIssSPODG2KLNPSQ1Y463DYIJO5DD7JLXU3SW267WBQQJ9',
        'MODULE_ID' => 1,
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}
function getProfileInstallments(){
    $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/GetProfileInstallments?MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}
function getLastFund(){
    $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/GetMyTamweels?MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}
function getFundSources($FUND_ID){
    $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/GetFundSources?FUND_ID='.$FUND_ID.'&MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}
function companyProfileComplete(){
    $apiURL = config('app.api').'/CompanyPortalApi/api/CompanyProfile/GetCompanyProfileCompleted?MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}
function getActivities($id){
    $apiURL = config('app.api').'/ServicesApi/API/Constants/GetActivityTypeEconomicActivity?MODULE_ID='.config('app.MODULE_ID').'&CONSTANT_ID='.$id;

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $response = Http::withHeaders($headers)->get($apiURL);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody['data']['PROFILE_SUFFIX_TITLES'];
}
function storeYear($input){
    $apiURL = config('app.api').'/PortalFundsApi/api/PortalFunds/UpdateFinanceInfoMasterData?MODULE_ID='.config('app.MODULE_ID');

    $headers = [
        'Authorization' => 'Bearer '.Session::get('userData')['TOKEN_KEY'],
    ];

    $postInput = [
        'FUND_ID' => $input['FUND_ID'],
        'AUDITED_ENTITY_NAME' => $input['AUDITED_ENTITY_NAME'],
        'FINANCE_INFO_CURR_ID' => $input['FINANCE_INFO_CURR_ID'],
        'FINANCE_INFO_PREPARED_ON' => Carbon::createFromFormat('m-d-Y', $input['FINANCE_INFO_PREPARED_ON'])->format('d-m-Y'),
        'FISCAL_YEAR' => $input['FISCAL_YEAR'],
        'THIS_YEAR' => $input['FISCAL_YEAR'],
        'LAST_YEAR' => $input['FISCAL_YEAR'] - 1,
    ];

    $response = Http::withHeaders($headers)->post($apiURL, $postInput);
    $responseBody = json_decode($response->getBody(), true);

    return $responseBody;
}
function calcChange($sub, $year){
    if($sub == $year){
        $result = '0%';
    }elseif ($sub < 0 && $year == 0 || $sub == 0 && $year > 0){
        $result = '100%';
    }elseif ($sub > 0 && $year == 0 || $sub == 0 && $year < 0){
        $result = '-100%';
    }else{
        $result = number_format((($year - $sub) / $sub) * 100, 2) . '%';
    }
    return $result;
}
function textMaxSize(){
    return 4000;
}
function textMaxSize2(){
    return 2000;
}

function generalUpload($model, $file){
    if ($file) {
        $dir = 'uploads/' . $model;

        if (!file_exists($dir)) {
            try {
                \File::makeDirectory($dir);
            } catch (\Exception $e) {
            }
        }

        $name = rand(0, 99999) . time();
        $ext = $file->getClientOriginalExtension();
        $fileName = $name . '.' . $ext;

        $newDir = $dir . '/' . $fileName;

        $status = \File::copy($file, $newDir);

        if ($status) {
            return 'uploads/'.$model.'/'.$fileName;
        }
    }
    return false;
}
function deleteUpload($path){
    if(\File::exists(public_path($path))){
        \File::delete(public_path($path));
        return true;
    }else{
        return true;
    }
}
function maxSize(){
    return 20480;
}
