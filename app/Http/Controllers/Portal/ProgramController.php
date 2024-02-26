<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
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
        return view('portal.programs.index', compact('programs'));
    }

    public function show(Request $request, $id)
    {
        try {
            $response = getProgramLoans($id);
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
        return view('portal.programs.show', compact('program', 'loans'));
    }

    public function productDetails(Request $request)
    {
        try {
            $response = getProductDetails($request->id);
            $status = $response['status'];
            if($response['status']){
                $product = $response['data']['ProductDescriptions'];
            }else{
                $product = [];
            }
        } catch (\Exception $ex) {
            $product = [];
        }
        $html = view('portal.programs.products', compact('product'))->render();
        return response()->json(compact('status', 'html'));
    }
}
