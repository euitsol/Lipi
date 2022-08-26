<?php

namespace App\Http\Controllers\SupportTeam;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\assignment;
use App\Helpers\Qs;
use App\Models\semester;
use App\Models\Section;
use App\Models\assignmentSumbit;

class assignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Qs::UserAccess()[0]->user_roll);    
        $d = [];
        $d["semester"] = semester::all();
        $d["section"] = Section::all();
        
        if(Auth::user()->user_roll=="admin"){
            $d["assignments_given"] = assignment::where('user_id', Auth::user()->user_id)->get();
            $d["assignments_taken"] = assignment::where('user_id','!='. Auth::user()->user_id)->get();
        }
        elseif(Auth::user()->user_roll=="super_admin"){
            $d["assignments_given"] = assignment::where('user_id', Auth::user()->user_id)->get();
            $d["assignments_taken"] = assignment::where('user_id','!='. Auth::user()->user_id)->get();
        }
        elseif(Auth::user()->user_roll=="teacher"){
            $d["assignments_given"] = assignment::where('user_id', Auth::user()->user_id)->get();
            $d["assignments_taken"] = assignment::where('user_id','!='. Auth::user()->user_id)->get();
        }
        elseif(Auth::user()->user_roll=="student"){
            $user_id = Auth::user()->user_id;
            $current_date = date("Y-m-d");
            $d["new_assignment"] = assignment::where('user_id', Auth::user()->user_id)->where('user_id', Auth::user()->user_id)->get();
            $d["assignments_taken"] = assignment::where('user_id','!='. Auth::user()->user_id)->get();
        }
        
       
        // $d=[];
        // $d['new_assignment'] = assignment::where('end_date','>=',$current_date)
        //                                     ->where('start_date','<=',$current_date)->get();
        // $d['new_assignment2'] = assignment::where('end_date','>=',$current_date)
        //                                     ->where('start_date','<=',$current_date)->get();
        
        // $d['submitted_assignment'] = assignment::where('user_id','=',Auth::user()->user_id)->get();
        // dd($new_assignment);
        
        return view("pages.support_team.assignment.index",$d);
    }

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
        $insert = new assignment;

        $insert->user_id = Auth::user()->user_id;
        $insert->semester_name = $request->semester_name;
        $insert->group = $request->group;
        $insert->assignment_title = $request->assignment_title;
        $insert->start_date = $request->start_date;
        $insert->end_date = $request->end_date;
        
        // $insert->student_user_id = $request->student_user_id;
        // $insert->assignment_taken_file = $request->assignment_taken_file;
        
        if($request->hasFile('assignment_given_file')) {
            $file = $request->file('assignment_given_file');
            $f = Qs::getFileMetaData($file);
            $f['name_file'] = 'nobir_'.time().'.' . $f['ext'];
            $f['path_file'] = $file->storeAs(Qs::getUploadPath('file'), $f['name_file']);
            $insert->assignment_given_file = asset('storage/' . $f['path_file']);
        }

        $insert->save();
        return  Qs::jsonStoreOk();
    }


    //Assignment Submit by students
    public function assignmentSubmit(Request $request){

        $insert = new assignmentSumbit;

        $insert->user_id = Auth::user()->user_id;
        $insert->assignment_given_id = Qs::decodeHash($request->assignment_given_id);
        // $insert->assignment_submited_file = Auth::user()->user_id;
        if($request->hasFile('assignment_taken_file')) {
            $file = $request->file('assignment_taken_file');
            $f = Qs::getFileMetaData($file);
            $f['name_file'] = 'nobir_'.time().'.' . $f['ext'];
            $f['path_file'] = $file->storeAs(Qs::getUploadPath('file'), $f['name_file']);
            $insert->assignment_taken_file = asset('storage/' . $f['path_file']);
        }
        $insert->save();
        return  Qs::jsonStoreOk();
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
        $semester = semester::all();
        $section = Section::all();
        $assignment = assignment::find($id);
        return view("pages.support_team.assignment.edit",compact("assignment",'semester','section'));
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
        $update = assignment::find($id);
        $update->semester_name = $request->semester_name;
        $update->group = $request->group;
        $update->assignment_title = $request->assignment_title;
        $update->user_id = Auth::user()->user_id;
        
        if($request->hasFile('assignment_file')) {
            $assignment_file = $request->file('assignment_file');
            $f = Qs::getFileMetaData($assignment_file);
            $f['name_assignment_file'] = 'nobir_'.time().'.' . $f['ext'];
            $f['path_assignment_file'] = $assignment_file->storeAs(Qs::getUploadPath('assignment_file'), $f['name_assignment_file']);
            $update->assignment_file = asset('storage/' . $f['path_assignment_file']);
        }

        $update->save();
        return redirect()->route('assignment.index')->with("msg", 'Successfully updated');
        
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
        $delete = assignment::find($id);
        $path = $delete->assignment_file;
        Storage::exists($path)? Storage::deleteDirectory($path): false;
        $delete->delete();
        return redirect()->back()->with("msg", 'Successfully Deleted');
    }
}