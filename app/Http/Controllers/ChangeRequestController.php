<?php

namespace App\Http\Controllers;

use App\Models\ChangeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangeRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->designation !== 'dev' && Auth::user()->designation !== 'adm'){
            $this->authorize('show-change-request', User::class);
        }

        $crequests = ChangeRequest::paginate(15);

        return view('changerequest.index', compact('crequests'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('changerequest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recId = $request->id;
        $crequests   =   ChangeRequest::updateOrCreate(
            [
             'id' => $recId
            ],
            [
            'user_id' => Auth::user()->id, 
            'user_email' => Auth::user()->email, 
            'type' => $request->type, 
            'description' => $request->description, 
            ]);  
                
        return Response()->json($crequests);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChangeRequest  $changeRequest
     * @return \Illuminate\Http\Response
     */
    // public function show(ChangeRequest $changeRequest)
    public function show(Request $request)
    {
        
        $where = array('id' => $request->id);
	    $crequests  = ChangeRequest::where($where)->first();
	 
	    return Response()->json($crequests);
    }

    public function approval(Request $request)
    {
        if (Auth::user()->designation !== 'dev'){
            $this->authorize('approval', User::class);
        }

        $approval = ChangeRequest::where('id', $request->id)->update(array('status' => '1'));

        return Response()->json($approval);
    }

    public function denial(Request $request)
    {
        if (Auth::user()->designation !== 'dev'){
            $this->authorize('approval', User::class);
        }

        $denial = ChangeRequest::where('id', $request->id)->update(array('status' => '3'));

        return Response()->json($denial);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChangeRequest  $changeRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ChangeRequest $changeRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChangeRequest  $changeRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChangeRequest $changeRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChangeRequest  $changeRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (Auth::user()->designation !== 'dev' && Auth::user()->designation !== 'adm'){
            $this->authorize('delete-crequest', ChangeRequest::class);
        }

        $deletecr = ChangeRequest::where('id', $request->id)->delete();
	 
	    return Response()->json($deletecr);
    }
}
