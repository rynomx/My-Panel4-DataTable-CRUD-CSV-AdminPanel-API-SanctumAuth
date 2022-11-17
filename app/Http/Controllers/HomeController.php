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
        $modelcount = vlfdata::distinct('vehicle_model')->count();
        $variantcount = vlfdata::where('parent_SKU', '!=', '')->count();
        $totalrecords = vlfdata::distinct('SKU')->count();
        $withoutgains = vlfdata::where('power_bhp', '=', '')
                        ->where('torque_nm', '=', '')->count();
        $newupdates = vlfdata::orderby('updated_at', 'desc')->take(10)->get();
        $newuploads = vlfdata::orderby('created_at', 'desc')->take(5)->get();
        return view('home', compact('modelcount', 'variantcount', 'totalrecords', 'withoutgains',
                                    'newupdates', 'newuploads'
    ));   
    }
    
}
