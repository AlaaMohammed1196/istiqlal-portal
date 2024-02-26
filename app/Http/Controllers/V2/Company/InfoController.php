<?php

namespace App\Http\Controllers\V2\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class InfoController extends Controller
{
    public function index(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.v2.logout');
        $constants = $constants['data'];

        $data = $constants['CompanyProfileData']['CompanyGeneralInfo'];
        $approval = $constants['APPROVAL_STATUS_ID'];
        if($approval == 1 || $approval == 3){
            return view('portal_v2.company.deny', compact('data', 'constants'));
        }
        return view('portal_v2.company.info.index', compact('data', 'constants'));
    }
}
