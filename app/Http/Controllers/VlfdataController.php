<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vlfdata;
use DataTables;
use Illuminate\Support\Facades\Auth;

class VlfdataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function xindex()
    {
        if(request()->ajax()) {
	        return datatables()->of(vlfdata::select('*'))
	        ->addColumn('action', 'vlf.lookup-action')
	        ->rawColumns(['action'])
	        ->addIndexColumn()
	        ->make(true);
	    }
        //return view('lookup');
        return view('vlf.index');
    }


    // public function getVlf(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = vlfdata::latest()->get();
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
    //                 $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vlfId = $request->id;

        if (Auth::user()->designation !== 'dev' && Auth::user()->designation !== 'adm'){
            $this->authorize('store-vlfdata', vlfdata::class);
        }

	    $vlfdata   =   vlfdata::updateOrCreate(
	    	        [
	    	         'id' => $vlfId
	    	        ],
	                [
                    'title' => $request->title, 
                    'SKU' => $request->SKU, 
                    'parent_SKU' => $request->parent_SKU, 
                    'parent_id' => $request->parent_id, 
                    'vehicle_type' => $request->vehicle_type, 
                    'vehicle_make' => $request->vehicle_make, 
                    'vehicle_model' => $request->vehicle_model, 
                    'variant' => $request->variant, 
                    'vlf_type' => $request->vlf_type, 
                    'fuel_type' => $request->fuel_type, 
                    'price' => $request->price, 
                    'k_type' => $request->k_type, 
                    'economy_gain_bhp' => $request->economy_gain_bhp, 
                    'economy_gain_nm' => $request->economy_gain_nm, 
                    'fuel_saving' => $request->fuel_saving, 
                    'original_bhp' => $request->original_bhp, 
                    'original_torque' => $request->original_torque, 
                    'power_bhp' => $request->power_bhp, 
                    'torque_nm' => $request->torque_nm, 
                    'vswitch_support' => $request->vswitch_support, 
                    'perm_type' => $request->perm_type, 
                    'perm_make' => $request->perm_make, 
                    'perm_model' => $request->perm_model
	                ]);    
	                    
	    return Response()->json($vlfdata);
    }


    //public function edit(vlfdata $vlfdata)
    public function edit(Request $request)
    {
        if (Auth::user()->designation !== 'dev' && Auth::user()->designation !== 'adm'){
            $this->authorize('store-vlfdata', vlfdata::class);
        }

        $where = array('id' => $request->id);
	    $vlfdata  = vlfdata::where($where)->first();
	 
	    return Response()->json($vlfdata);
    }


    public function destroy(Request $request)
    {
        if (Auth::user()->designation !== 'dev' && Auth::user()->designation !== 'adm'){
            $this->authorize('delete-vlfdata', vlfdata::class);
        }

        $vlfdata = vlfdata::where('id',$request->id)->delete();
	 
	    return Response()->json($vlfdata);
    }


    ///////////////////////
    public function createx()
    {
        if (Auth::user()->designation !== 'dev' && Auth::user()->designation !== 'adm'){
            $this->authorize('import-vlfdata', vlfdata::class);
        }

        return view('import');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storex(Request $request)
    {
        if (Auth::user()->designation !== 'dev' && Auth::user()->designation !== 'adm'){
            $this->authorize('import-vlfdata', vlfdata::class);
        }

        //dd($request->all());
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        //$filename = $file->getClientOriginalName();
        $file =  file($request->file->getRealPath());
        $data = array_slice($file, 1);
        $parts = array_chunk($data, 5000);

        foreach($parts as $index => $part){
            $index++;
            //$fileName = resource_path('./pending-files/'.date('y-m-d-H-i-s-').$index.".csv");
            $fileName = resource_path('./'.date('y-m-d-H-i-s-').$index.".csv");
            file_put_contents($fileName, $part);
        }
        
        (new vlfdata())->importToDb();
        //vlfdata::importToDb();

        session()->flash('status', 'Queued For Importing');

        //return redirect('import');
        return redirect('vlfdata');
    }


}
