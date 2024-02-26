<?php

namespace App\Http\Controllers\V2\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $constants = companyConstants();
        if($constants['code']==401) return redirect()->route('portal.v2.logout');
        $constants = $constants['data'];
        $data = $constants['CompanyProfileData']['CompanyGeneralInfo']['CompanyContactInfo'];

        return view('portal_v2.company.contact.index', compact('data', 'constants'));
    }
}
