<?php

namespace App\Http\Controllers;
// use Illuminate\Foundation\Http\FormRequest;
// use App\Http\Controllers\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Qs;
use App\Helpers\Mk;
use App\Http\Requests\Student\StudentRecordCreate;
use App\Http\Requests\Student\StudentRecordUpdate;
use App\Repositories\LocationRepo;
use App\Repositories\MyClassRepo;
use App\Repositories\StudentRepo;
use App\Repositories\UserRepo;
use App\Models\admissionModel;
use App\Models\user;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdmissionController extends Controller
{
    protected $loc, $my_class, $user, $student;

   public function __construct(LocationRepo $loc, MyClassRepo $my_class, UserRepo $user, StudentRepo $student)
   {
    //    $this->middleware('teamSA', ['only' => ['edit','update', 'reset_pass', 'create', 'store', 'graduated'] ]);
    //    $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->loc = $loc;
        $this->my_class = $my_class;
        $this->user = $user;
        $this->student = $student;
   }

    public function reset_pass($st_id)
    {
        $st_id = Qs::decodeHash($st_id);
        $data['password'] = Hash::make('student');
        $this->user->update($st_id, $data);
        return back()->with('flash_success', __('msg.p_reset'));
    }

    public function create()
    {
        // echo "Admission";
        // $data['states'] = $this->loc->getStates();
        // $data['my_classes'] = $this->my_class->all();
        // $data['parents'] = $this->user->getUserByType('parent');
        // $data['dorms'] = $this->student->getAllDorms();
        // $data['nationals'] = $this->loc->getAllNationals();
        // dd($data['nationals']);
        return view('pages.support_team.admission.add');
    }

    public function store(Request $req)
    {
    //    $data =  $req->only(Qs::getUserRecord());
    //    dd($data);
    //    $sr =  $req->only(Qs::getStudentData());

        // $ct = $this->my_class->findTypeByClass($req->my_class_id)->code;
       /* $ct = ($ct == 'J') ? 'JSS' : $ct;
        $ct = ($ct == 'S') ? 'SS' : $ct;*/
// $this->validate($req,[
//         'name' => 'required|string|min:6|max:150',
//         'father_name' => 'sometimes|nullable|alpha_num|min:3|max:150|unique:student_records',
//         'mother_name' => 'required|string',
//         'present_address' => 'required|string',
//         'phone2' => 'required',
//         'address' => 'required',
//         'email' => 'sometimes|nullable|email|max:100|unique:users',
//         'gender' => 'required',
//         'phone' => 'required',
//         'dob' => 'required',
//         'nationality' => 'required',
//         'exam_name' => 'required',
//         'passing_year' => 'required',
//         'division' => 'required',
//         'board' => 'required',
//         'roll' => 'required',
//         'registration_no' => 'required',
//         'gpa' => 'required',
//         'reg_card' => 'required|mimes:jpeg,png,pdf,jpg',
//         'marksheet' => 'required|mimes:png,jpg,jpeg,pdf',
//         'photo' => 'photo|required|mimes:png,jpg,jpeg'
//     ],[
//         'name.required' => 'You have to insert your name',
//         'father_name.required' => "Father's name required",
//         'mother_name.required' => "Mother's name is required",
//         'present_address.required' => 'Present address required',
//         'address.required' => 'Permanent address is required',
//         'email.required' => 'E-mail is required',
//         'gender.required' => 'Select gender',
//         'phone.required' => 'Phone number is required',
//         'dob.required' => 'Select date of birth',
//         'nationality.required' => 'Nationality filed is required',
//         'exam_name.required' => 'Select exame name',
//         'passing_year.required' => 'Select passing year',
//         'division.required' => 'Select division',
//         'board.required' => 'Select board',
//         'roll.required' => 'Roll is required',
//         'registration_no.required' => 'Registration number is required',
//         'gpa.required' => 'G.P.A is required',
//         'reg_card.required' => "You have to upload your registration card's photo or pdf",
//         'marksheet.required' => "You have to upload your Marksheet's photo or pdf",
//         'photo.required' => "You have to upload your image"
//     ]);
    $insert = new admissionModel ;

    $insert->Departments_id = $req->Departments_id;
    $insert->name = $req->name;
    $insert->father_name =  $req->father_name;
    $insert->mother_name = $req->mother_name;
    $insert->present_address = $req->present_address;
    $insert->address = $req->address;
    $insert->email = $req->email;
    $insert->gender = $req->gender;
    $insert->phone =  $req->phone;
    $insert->phone2 =  $req->phone2;
    $insert->dob =  $req->dob;
    $insert->Quota =  $req->Quota;
    $insert->nationality =  $req->nationality;
    $insert->blood_group_name = $req->blood_group_name;
    $insert->exam_name =  $req->exam_name;
    $insert->passing_year = $req->passing_year;
    $insert->division =  $req->division;
    $insert->board =  $req->board;
    $insert->roll =  $req->roll;
    $insert->registration_no =  $req->registration_no;
    $insert->gpa =  $req->gpa;
    $insert->status =  "wait for approved";

    $data['code'] = strtoupper(Str::random(10));

    if($req->hasFile('reg_card')) {
        $reg_card = $req->file('reg_card');
        $f = Qs::getFileMetaData($reg_card);
        $f['name_reg_card'] = 'nobir_'.$data['code'].'.' . $f['ext'];
        $f['path_reg_card'] = $reg_card-> storeAs(Qs::getUploadPath('student').$data['code'], $f['name_reg_card']);
        $insert->reg_card = asset('storage/' . $f['path_reg_card']);
    }
    if($req->hasFile('marksheet')) {
        $marksheet = $req->file('marksheet');
        $f = Qs::getFileMetaData($marksheet);
        $f['name_marksheet'] = 'nobir_'.$data['code'].'.' . $f['ext'];
        $f['path_marksheet'] = $marksheet->storeAs(Qs::getUploadPath('student').$data['code'], $f['name_marksheet']);
        $insert->marksheet = asset('storage/' . $f['path_marksheet']);
    }
    if($req->hasFile('photo')) {
        $photo = $req->file('photo');
        $f = Qs::getFileMetaData($photo);
        $f['name'] = 'nobir_'.$data['code'].'.' . $f['ext'];
        $f['path'] = $photo->storeAs(Qs::getUploadPath('student').$data['code'], $f['name']);
        $insert->photo = asset('storage/' . $f['path']);
    }


    $query_roll_validation = admissionModel::where("roll","=",$req->roll)
                                        ->get();
    $query_reg_validation = admissionModel::where("registration_no","=",$req->registration_no)
                                        ->get();
 if(count($query_roll_validation)>0){
    $exist_aler_msg = "Please Insert Correct Roll Number";
    return view("pages.support_team.admission.back")->with("message","Please Insert Correct Roll Number");
    // view("pages.support_team.admission.back",compact("xist_aler_msg"))
 }
 elseif(count($query_reg_validation)>0){
    $exist_aler_msg = "Please Insert Correct Registration Number";
    return view("pages.support_team.admission.back")->with("message","Please Insert Correct Registration Number");
    // view("pages.support_team.admission.back",compact("exist_aler_msg"))
 }
 else{
    $insert->save();
    return view("pages.support_team.admission.admission_info_show");
 }


    // $admission_field = [$req->name,$req->father_name,$req->mother_name,$req->present_address,$req->address,$req->email,$req->gender,$req->phone,$req->phone2,$req->dob,$req->Quota,$req->nationality,$req->blood_roup_name,$req->exam_name,$req->passing_year,$req->division,$req->board,$req->roll,$req->registration_no, $req->gpa,$data['reg_card'],$data['marksheet'],$data['photo']];



// admissionModel::create($req->all());

        // $data['user_type'] = 'student';
        // $data['name'] = ucwords($req->name);
        // $data['code'] = strtoupper(Str::random(10));
        // $data['password'] = Hash::make('student');
        // $data['photo'] = Qs::getDefaultUserImage();
        // $adm_no = $req->adm_no;
        // $data['username'] = strtoupper(Qs::getAppCode().'/'.$ct.'/'.$sr['year_admitted'].'/'.($adm_no ?: mt_rand(1000, 99999)));



        // $user = $this->user->create($data); // Create User

        // $sr['adm_no'] = $data['username'];
        // $sr['user_id'] = $user->id;
        // $sr['session'] = Qs::getSetting('current_session');

        // $this->student->createRecord($sr); // Create Student

    }


    public function listByClass($class_id)
    {
        $data['my_class'] = $mc = $this->my_class->getMC(['id' => $class_id])->first();
        $data['students'] = $this->student->findStudentsByClass($class_id);
        $data['sections'] = $this->my_class->getClassSections($class_id);

        return is_null($mc) ? Qs::goWithDanger() : view('pages.support_team.students.list', $data);
    }

    public function graduated()
    {
        $data['my_classes'] = $this->my_class->all();
        $data['students'] = $this->student->allGradStudents();

        return view('pages.support_team.students.graduated', $data);
    }

    public function not_graduated($sr_id)
    {
        $d['grad'] = 0;
        $d['grad_date'] = NULL;
        $d['session'] = Qs::getSetting('current_session');
        $this->student->updateRecord($sr_id, $d);

        return back()->with('flash_success', __('msg.update_ok'));
    }

    public function show($sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $data['sr'] = $this->student->getRecord(['id' => $sr_id])->first();

        /* Prevent Other Students/Parents from viewing Profile of others */
        if(Auth::user()->id != $data['sr']->user_id && !Qs::userIsTeamSAT() && !Qs::userIsMyChild($data['sr']->user_id, Auth::user()->id)){
            return redirect(route('dashboard'))->with('pop_error', __('msg.denied'));
        }

        return view('pages.support_team.students.show', $data);
    }

    public function edit($sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $data['sr'] = $this->student->getRecord(['id' => $sr_id])->first();
        $data['my_classes'] = $this->my_class->all();
        $data['parents'] = $this->user->getUserByType('parent');
        $data['dorms'] = $this->student->getAllDorms();
        $data['states'] = $this->loc->getStates();
        $data['nationals'] = $this->loc->getAllNationals();
        return view('pages.support_team.students.edit', $data);
    }

    public function update(StudentRecordUpdate $req, $sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $sr = $this->student->getRecord(['id' => $sr_id])->first();
        $d =  $req->only(Qs::getUserRecord());
        $d['name'] = ucwords($req->name);

        if($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = 'photo.' . $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath('student').$sr->user->code, $f['name']);
            $d['photo'] = asset('storage/' . $f['path']);
        }

        $this->user->update($sr->user->id, $d); // Update User Details

        $srec = $req->only(Qs::getStudentData());

        $this->student->updateRecord($sr_id, $srec); // Update St Rec

        /*** If Class/Section is Changed in Same Year, Delete Marks/ExamRecord of Previous Class/Section ****/
        Mk::deleteOldRecord($sr->user->id, $srec['my_class_id']);

        return Qs::jsonUpdateOk();
    }

    public function destroy($st_id)
    {
        $st_id = Qs::decodeHash($st_id);
        if(!$st_id){return Qs::goWithDanger();}

        $sr = $this->student->getRecord(['user_id' => $st_id])->first();
        $path = Qs::getUploadPath('student').$sr->user->code;
        Storage::exists($path) ? Storage::deleteDirectory($path) : false;
        $this->user->delete($sr->user->id);

        return back()->with('flash_success', __('msg.del_ok'));
    }

}