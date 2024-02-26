<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $response = calculaterConstants();
            if($response['code']==401) return redirect()->route('portal.logout');
            if($response['status']){
                $constants = $response['data'];
            }else{
                $constants = [
                    'CURRENCIES' => [],
                    'PROJECT_TYPES' => [],
                    'PRODUCT_TYPES' => [],
                ];
            }
        } catch (\Exception $ex) {
            $constants = [
                'CURRENCIES' => [],
                'PROJECT_TYPES' => [],
                'PRODUCT_TYPES' => [],
            ];
        }

        try {
            $response = getProgram();
            if($response['code']==401) return redirect()->route('portal.logout');
            if($response['status']){
                $programs = $response['data']['PROGRAMS_TYPES'];
            }else{
                $programs = [];
            }
        } catch (\Exception $ex) {
            $programs = [];
        }

        try {
            $response = getProfileInstallments();
            if($response['code']==401) return redirect()->route('portal.logout');
            if($response['status']){
                $installments = $response['data']['FundInstallments'];
            }else{
                $installments = [];
            }
        } catch (\Exception $ex) {
            $installments = [];
        }

        try {
            $response = getLastFund();
            if($response['code']==401) return redirect()->route('portal.logout');
            if($response['status']){
                $last = $response['data']['Funds'];
                if(count($last) > 0){
                    $last = $last[0];
                }else{
                    $last = [];
                }
            }else{
                $last = [];
            }
        } catch (\Exception $ex) {
            $last = [];
        }

        return view('portal.home', compact('constants', 'programs', 'installments', 'last'));
    }

    public function getLoans(Request $request){
        try {
            $response = getProgramLoans($request->id);
            if($response['code']==401) return redirect()->route('portal.logout');
            if($response['status']){
                $data = $response['data']['ProgramData'];
                if (count($data) > 0) {
                    $program = $data[0];
                } else {
                    $program = [];
                }
                $loans = $response['data']['ProductData'];
            }else{
                $program = [];
                $loans = [];
            }
        } catch (\Exception $ex) {
            $program = [];
            $loans = [];
        }

        $status = true;
        $html = view('portal.components.loans_modal', compact('program', 'loans'))->render();
        return response()->json(compact('status', 'html'));

    }
}
