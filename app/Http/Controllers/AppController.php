<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vlfdata;

class AppController extends Controller
{
    public function index()
    {
        $vlf = vlfdata::get();

		// if (Auth::user()->designation !== 'dev'){
        //     $this->authorize('root-dev', $config);
        // }
           	
    	return view('app.index',compact('vlf'));
    }

    public function type()
    {
        $types = vlfdata::distinct()->get('vehicle_type');
           	
        return view('app.index', compact('types'));
    }

    public function make($vehicle_type)
    {
        $makes['data'] = vlfdata::distinct()->where('vehicle_type', $vehicle_type)->get('vehicle_make');
           	
        return Response()->json($makes);
    }

    public function model($vehicle_make)
    {
        $models['data'] = vlfdata::distinct()->where('vehicle_make', $vehicle_make)->get('vehicle_model');
           	
        return Response()->json($models);
    }

    public function fuelType($vehicle_model)
    {
        $fueltypes['data'] = vlfdata::distinct()->where('vehicle_model', $vehicle_model)
                                                ->where('fuel_type', '!=', '')->get('fuel_type');
           	
        return Response()->json($fueltypes);
    }

    public function variant($vehicle_model, $fuel_type)
    {
        $variants['data'] = vlfdata::distinct()->where('vehicle_model', $vehicle_model)
                                                ->where('fuel_type', $fuel_type)->get('variant');
           	
        return Response()->json($variants);
    }
}
