<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\vlfdata;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $fetchall = vlfdata::get();
        $modelcount = vlfdata::distinct('vehicle_model')->count();
        $variantcount = vlfdata::where('parent_SKU', '!=', '')->count();
        $totalrecords = vlfdata::distinct('SKU')->count();
        $withoutgains = vlfdata::where('power_bhp', '=', '')
                        ->where('torque_nm', '=', '')
                        ->where('parent_SKU', '!=', '')->count();
        $newupdates = vlfdata::where('parent_SKU', '!=', '')->orderby('updated_at', 'desc')->take(10)->get();
        $newuploads = vlfdata::where('parent_SKU', '!=', '')->orderby('created_at', 'desc')->take(5)->get();
        $nogains = vlfdata::where('power_bhp', '=', '')
                        ->where('torque_nm', '=', '')
                        ->where('parent_SKU', '!=', '')->take(10)->get();

        return view('home', compact('fetchall', 'modelcount', 'variantcount', 'totalrecords', 'withoutgains',
                                    'newupdates', 'newuploads', 'nogains'
    ));   
    }

    public function motherChild(Request $request)
    {

	    // $vlfdata  = vlfdata::where('SKU', '=', $request->SKU)
        //                         ->orwhere('SKU', 'like', $request->SKU.'-%')->first();
        $where = array('id' => $request->id);
	    $vlfdata  = vlfdata::where($where)->first();
	 
	    return Response()->json($vlfdata);
    }
    
}
