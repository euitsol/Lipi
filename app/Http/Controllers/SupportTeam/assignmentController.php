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
use App\Models\studentInfo;

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
        
            $d["assignments_given"] = assignment::where('user_id', Auth::user()->user_id)
                                    ->where('user_roll','=',Auth::user()->user_roll)
                                    ->get();
            $d["assignments_taken"] = assignment::where('user_id', Auth::user()->user_id)
                                    ->where('user_roll','=','student')
                                    ->get();
        
        $current_date= date("Y-m-d");
        // dd($current_date);
        if(Auth::user()->user_roll=='student')
        {
            
            $student_locate = studentInfo::where('user_id', Auth::user()->user_id)->first();
            // $assignment_info = assignment::where('user_id', Auth::user()->user_id)->first();
            // dd($student_locate);
            $semester = $student_locate->semester_name;
            $group = $student_locate->group_name;
           
            // dd($semester,$group);
            $d['assignment_submited_by_st'] = assignment::where('student_user_id', Auth::user()->user_id)
                                            ->where('user_roll','=',Auth::user()->user_roll)
                                            ->where('semester_name','=',$semester)
                                            ->where('group','=',$group)
                                            ->get();
            
            $d['new_assignment'] = assignment::where('start_date','<=',$current_date)
                                    ->where('end_date','>=',$current_date)
                                    ->where('student_user_id','=',null)
                                    ->where('semester_name','=',$semester)
                                    ->where('group','=',$group)
                                    ->get();
                                    
            $d['new_assignment2'] = assignment::where('start_date','<=',$current_date)
                                    ->where('end_date','>=',$current_date)
                                    ->where('student_user_id','=',null)
                                    ->where('semester_name','=',$semester)
                                    ->where('group','=',$group)
                                    ->get();
                                    
            // Upcoming Feature Cause A field status have to add name status
            $d['upcomming_assignment'] = assignment::where('start_date','<=',$current_date)
                                        ->where('end_date','<=',$current_date)
                                        ->where('student_user_id','==' ,null)
                                        ->where('semester_name','=',$semester)
                                        ->where('group','=',$group)
                                        ->get();

                                        // dd( $d['new_assignment'],$d['assignment_submited_by_st']);
                                       
          
            
     
        }    
        // $d['submitted_assignment'] = assignment::where('user_id','=',Auth::user()->user_id)->get();
        // dd($d['new_assignment']);
        
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
        $insert->user_roll = Auth::user()->user_roll;
        
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

        $insert = new assignment;
        $id = Qs::decodeHash($request->assignment_id);
        
        $assignment_info = assignment::find($id);
        
        $insert->user_id = $assignment_info->user_id;
        $insert->semester_name = $assignment_info->semester_name;
        $insert->group = $assignment_info->group;
        $insert->assignment_title = $assignment_info->assignment_title;
        $insert->assignment_given_file = $assignment_info->assignment_given_file;
        $insert->start_date = $assignment_info->start_date;
        $insert->end_date = $assignment_info->end_date;
        $insert->student_user_id = Auth::user()->user_id;
        $insert->user_roll = Auth::user()->user_roll;
    
        if($request->hasFile('assignment_submited_file')) {
            $file = $request->file('assignment_submited_file');
            $f = Qs::getFileMetaData($file);
            $f['name_file'] = 'nobir_'.time().'.' . $f['ext'];
            $f['path_file'] = $file->storeAs(Qs::getUploadPath('assignment_submited_file'), $f['name_file']);
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