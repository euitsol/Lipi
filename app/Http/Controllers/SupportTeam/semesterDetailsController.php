<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Requests\Subject\SubjectCreate;
use App\Http\Requests\Subject\SubjectUpdate;
use App\Repositories\MyClassRepo;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;
//Models
use App\Models\departmentModel;
use App\Models\n_subjectModel;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\semester;
use App\Models\Semester_detail;
// use Request;
use Illuminate\Http\Request;

class semesterDetailsController extends Controller
{
    protected $my_class, $user;

    public function __construct(MyClassRepo $my_class, UserRepo $user)
    {
        $this->middleware('teamSA', ['except' => ['destroy',] ]);
        $this->middleware('super_admin', ['only' => ['destroy',] ]);
        $this->my_class = $my_class;
        $this->user = $user;
    }

    public function index()
    {
        $query_semester_details =Semester_detail::all();
        $d['department_db'] = departmentModel::all();
        $d['subject_db'] = n_subjectModel::all();
        $d['teachers'] = Teacher::all();
        $d['semester'] = semester::all();
        // dd(semester::all());
        // $d['teachers'] = $this->user->getUserByType('teacher');
        // $d['subjects'] = $this->my_class->getAllSubjects();

        return view('pages.support_team.semester_details.index',$d,compact('query_semester_details'));
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'departments_id' => 'required',
            'my_class_id' => 'required',
            'teacher_id' => 'required',
            'subject_id' => 'required'
        ],
        [
            'departments_id.required' => 'Select Department Name',
            'my_class_id.required' => 'Select Semester Name',
            'teacher_id.required' => 'Select Teacher Name',
            'subject_id.required' => 'Select Subject Name',
        ]);
        $departments_id = Qs::decodeHash($req->departments_id);
        $my_class_id = Qs::decodeHash($req->my_class_id);
        $teacher_id = Qs::decodeHash($req->teacher_id);
        $subject_id = Qs::decodeHash($req->subject_id);
        // $data = $req->all();
        // dd($departments_id, $subject_id, $teacher_id,$subject_id);
        $insert = new Semester_detail;
        $insert->department_id = $departments_id;
        $insert->semester_id = $my_class_id;
        $insert->subject_id = $teacher_id;
        $insert->teacher_id = $subject_id;
        $insert->save();
        return back()->with('msg',"Successfully inserted");
    }

    public function edit($id)
    {
        $id = Qs::decodeHash($id);
        // dd($id);
        $query_semester_details =Semester_detail::find($id);
        $d['department_db'] = departmentModel::all();
        $d['subject_db'] = n_subjectModel::all();
        $d['teachers'] = Teacher::all();
        $d['semester'] = semester::all();

        // dd($d);
        return  view('pages.support_team.semester_details.edit', $d,compact('query_semester_details'));
    }
    

    public function update(Request $req, $id)
    {
        // $data = $req->all();
        // $this->my_class->updateSubject($id, $data);
        $id = Qs::decodeHash($id);
        
        $departments_id = Qs::decodeHash($req->departments_id);
        $my_class_id = Qs::decodeHash($req->my_class_id);
        $teacher_id = Qs::decodeHash($req->teacher_id);
        $subject_id = Qs::decodeHash($req->subject_id);

        $update = Semester_detail::find($id);
        $update->department_id = $departments_id;
        $update->semester_id = $my_class_id;
        $update->subject_id = $teacher_id;
        $update->teacher_id = $subject_id;
        $update->save();
        return back()->with('msg',"Successfully inserted");

        return Qs::jsonUpdateOk();
    }
    

    public function destroy($id)
    {
        $id = Qs::decodeHash($id);
        $delete = Semester_detail::find($id);
        $delete->delete();
        
        return back()->with('msg', __('Seccessfully deleted'));
    }
}