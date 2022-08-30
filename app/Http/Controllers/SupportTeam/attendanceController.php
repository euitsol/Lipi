<?php

namespace App\Http\Controllers\SupportTeam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\attendance;

//Models

use App\Models\departmentModel;
use App\Models\n_subjectModel;
use App\Models\Subject;
use App\Models\semester;
use App\Models\Semester_detail;
use App\Models\section;
use App\Helpers\Qs;


class attendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query_semester_details =Semester_detail::all();
        $d['department_db'] = departmentModel::all();
        $d['subject_db'] = n_subjectModel::all();
        $d['semester'] = semester::all();
        $d['sections'] = section::all();
        // dd(semester::all());
        // $d['teachers'] = $this->user->getUserByType('teacher');
        // $d['subjects'] = $this->my_class->getAllSubjects();

        return view('pages.support_team.attendance.index',$d,compact('query_semester_details'));
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
    public function store(Request $req)
    {
        //
        $this->validate($req,[
            'departments_id' => 'required',
            'my_class_id' => 'required',
            'subject_id' => 'required',
            'section_id' => 'required'
        ],
        [
            'departments_id.required' => 'Select Department Name',
            'my_class_id.required' => 'Select Semester Name',
            'subject_id.required' => 'Select Subject Name',
            'section_id.required' => 'Select Section Name',
        ]);
        $departments_id = Qs::decodeHash($req->departments_id);
        $my_class_id = Qs::decodeHash($req->my_class_id);
        $subject_id = Qs::decodeHash($req->subject_id);
        $section_id = Qs::decodeHash($req->section_id);
        // $data = $req->all();
        // dd($departments_id, $subject_id, $teacher_id,$subject_id);
        $insert = new attendance;
        $insert->department = $departments_id;
        $insert->semester = $my_class_id;
        $insert->course = $subject_id;
        $insert->group = $section_id;
        $insert->save();
        return back()->with('msg',"Successfully inserted");
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function attendance_student_list_view(){
        
    }
}
