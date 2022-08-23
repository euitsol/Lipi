<?php

namespace App\Http\Controllers\SupportTeam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\departmentModel;
use App\Models\n_subjectModel;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\semester;
use App\Models\routine;
use App\Models\Semester_detail;

class routineController extends Controller
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
        $d['teachers'] = Teacher::all();
        $d['semester'] = semester::all();
       $show_routine = routine::all();
    //    $show_semester_details = Semester_detail::all();
       return view('pages.support_team.routine.index',$d, compact('show_routine','query_semester_details'));
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
        //
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
}