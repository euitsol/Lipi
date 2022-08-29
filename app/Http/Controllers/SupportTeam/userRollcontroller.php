<?php

namespace App\Http\Controllers\SupportTeam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\userRoll;
use App\Helpers\Qs;

class userRollcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $d["userRoll"] = userRoll::all();
        
        // $d["section"] = userRoll::all();
        return view("pages.support_team.userRoll.index",$d);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insert = new userRoll;
        $insert->name = $request->name;
        $insert->save();
        
        return redirect()->back()->with('msg','Successfully Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Qs::decodeHash($id);
        $d['userRoll'] = userRoll::find($id);
        return view("pages.support_team.userRoll.edit",$d);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = Qs::decodeHash($id);
        $update = userRoll::find($id);
        $update->name = $request->name;
        $update->save();
        
        return redirect()->route("userRollCreation.index")->with('msg','Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Qs::decodeHash($id);
        $delete = userRoll::find($id);
        $delete->delete();
        return redirect()->back()->with('msg','Successfully Deleted');
    }
}