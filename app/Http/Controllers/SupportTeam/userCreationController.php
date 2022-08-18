<?php

namespace App\Http\Controllers\SupportTeam;
use App\Helpers\Qs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class userCreationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d=[];
       $d["users"] = User::all();
       return view('pages.support_team.user_creation.index', $d);
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
        $this->validate($request,[
            "user_id"=>"required",
            "user_roll"=>"required"
        ],[
            "user_id.required"=>"Please Insert User ID",
            "user_roll.required"=>"Please, Select User Roll",
        ]);

        $insert = new User;
        $insert->name= "";
        $insert->email= time();
        $insert->phone= time();
        $insert->user_table_id= "";
        $insert->user_id= $request->user_id;
        $insert->user_roll= $request->user_roll;
        $insert->password= "";
        $insert->save();

      return Qs::jsonStoreOk();
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
        // $u = User::find($id);
        $d=[];
       $d["data_update"] = User::find($id);
       return view('pages.support_team.user_creation.edit', $d);
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
        $this->validate($request,[
            "user_id"=>"required",
            "user_roll"=>"required"
        ],[
            "user_id.required"=>"Please Insert User ID",
            "user_roll.required"=>"Please, Select User Roll",
        ]);

        $update = User::find($id);
        $update->user_id= $request->user_id;
        $update->user_roll= $request->user_roll;
        $update->save();

      return redirect()->route("userCreation.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $update = User::find($id);
        $update->delete();
    }
}
