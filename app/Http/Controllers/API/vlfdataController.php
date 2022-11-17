<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use App\Models\vlfdata;
use App\Http\Resources\vlfdataResource;

class vlfdataController extends Controller
{
    public function index()
    {
        $data = vlfdata::latest()->get();
        return response()->json([vlfdataResource::collection($data), 'VLF Data fetched.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'SKU' => 'required',
            'parent_SKU' => 'nullable', 
            'parent_id' => 'nullable', 
            'vehicle_type' => 'nullable', 
            'vehicle_make' => 'nullable', 
            'vehicle_model' => 'nullable', 
            'variant' => 'nullable', 
            'vlf_type' => 'nullable', 
            'fuel_type' => 'nullable', 
            'price' => 'nullable', 
            'k_type' => 'nullable', 
            'economy_gain_bhp' => 'nullable', 
            'economy_gain_nm' => 'nullable', 
            'fuel_saving' => 'nullable', 
            'original_bhp' => 'nullable', 
            'original_torque' => 'nullable', 
            'power_bhp' => 'nullable', 
            'torque_nm' => 'nullable', 
            'vswitch_support' => 'nullable', 
            'perm_type' => 'nullable', 
            'perm_make' => 'nullable', 
            'perm_model' => 'nullable'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $vlfdata = vlfdata::create([
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
        
        return response()->json(['VLF Data created successfully.', new vlfdataResource($vlfdata)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vlfdata = vlfdata::find($id);
        if (is_null($vlfdata)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new vlfdataResource($vlfdata)]);
    }

    public function lookup($vType, $vMake, $vModel, $fType, $variant)
    {
        $vlfdata = vlfdata::where('perm_type', $vType)
                    ->where('perm_make', $vMake)
                    ->where('perm_model', $vModel)
                    ->where('fuel_type', $fType)
                    ->where('variant', $variant)
                    ->first();

        if (is_null($vlfdata)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new vlfdataResource($vlfdata)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vlfdata $vlfdata)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'SKU' => 'required',
            'parent_SKU' => 'nullable', 
            'parent_id' => 'nullable', 
            'vehicle_type' => 'nullable', 
            'vehicle_make' => 'nullable', 
            'vehicle_model' => 'nullable', 
            'variant' => 'nullable', 
            'vlf_type' => 'nullable', 
            'fuel_type' => 'nullable', 
            'price' => 'nullable', 
            'k_type' => 'nullable', 
            'economy_gain_bhp' => 'nullable', 
            'economy_gain_nm' => 'nullable', 
            'fuel_saving' => 'nullable', 
            'original_bhp' => 'nullable', 
            'original_torque' => 'nullable', 
            'power_bhp' => 'nullable', 
            'torque_nm' => 'nullable', 
            'vswitch_support' => 'nullable', 
            'perm_type' => 'nullable', 
            'perm_make' => 'nullable', 
            'perm_model' => 'nullable'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $vlfdata->name = $request->name;
        $vlfdata->desc = $request->desc;
        $vlfdata->save();
        
        return response()->json(['VLF Data updated successfully.', new vlfdataResource($vlfdata)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(vlfdata $vlfdata)
    {
        $vlfdata->delete();

        return response()->json('VLF Data deleted successfully');
    }
    //
}
