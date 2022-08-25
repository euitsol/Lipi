<?php

namespace App\Http\Controllers\SupportTeam;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\assignment_given;
use App\Helpers\Qs;
use App\Models\semester;
use App\Models\Section;

class assignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $semester = semester::all();
        $section = Section::all();
        $data = assignment_given::all();
        return view("pages.support_team.assignment.index",compact("data",'semester','section'));
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
        $insert = new assignment_given;

        $insert->semester_name = $request->semester_name;
        $insert->group = $request->group;
        $insert->assignment_title = $request->assignment_title;
        $insert->user_id = Auth::user()->user_id;
        
        if($request->hasFile('assignment_file')) {
            $assignment_file = $request->file('assignment_file');
            $f = Qs::getFileMetaData($assignment_file);
            $f['name_assignment_file'] = 'nobir_'.time().'.' . $f['ext'];
            $f['path_assignment_file'] = $assignment_file->storeAs(Qs::getUploadPath('assignment_file'), $f['name_assignment_file']);
            $insert->assignment_file = asset('storage/' . $f['path_assignment_file']);
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
        $assignment = assignment_given::find($id);
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
        $update = assignment_given::find($id);
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
        $delete = assignment_given::find($id);
        $path = $delete->assignment_file;
        Storage::exists($path)? Storage::deleteDirectory($path): false;
        $delete->delete();
        return redirect()->back()->with("msg", 'Successfully Deleted');
    }
}