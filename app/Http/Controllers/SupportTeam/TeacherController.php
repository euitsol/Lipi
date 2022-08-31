<?php

namespace App\Http\Controllers\SupportTeam;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\departmentModel;
use App\Models\dssts_jt;
use App\User;

use App\Helpers\Qs;
use App\Http\Requests\UserRequest;
use App\Repositories\LocationRepo;
use App\Repositories\MyClassRepo;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
// use Request;

class TeacherController extends Controller
{
    protected $user, $loc, $my_class;

    public function __construct(UserRepo $user, LocationRepo $loc, MyClassRepo $my_class)
    {
        $this->middleware('teamSA', ['only' => ['index', 'store', 'edit', 'update'] ]);
        $this->middleware('super_admin', ['only' => ['reset_pass','destroy'] ]);

        $this->user = $user;
        $this->loc = $loc;
        $this->my_class = $my_class;
    }

    public function index()
    {
        // $ut = $this->user->getAllTypes();
        // $ut2 = $ut->where('level', '>', 2);

        // $d['user_types'] = Qs::userIsAdmin() ? $ut2 : $ut;
        // $d['states'] = $this->loc->getStates();
        // $d['users'] = $this->user->getPTAUsers();
        // $d['nationals'] = $this->loc->getAllNationals();
        $data['blood_groups'] = $this->user->getBloodGroups();
        $data['departments'] = departmentModel::all();
        $data['teacher'] = Teacher::all();

        // dd($data['departments']);

        return view('pages.support_team.teachers.index', $data);
    }

    public function edit($id)
    {
        $id = Qs::decodeHash($id);
        $data['blood_groups'] = $this->user->getBloodGroups();
        $data["teachers"] = Teacher::find($id);

        return view('pages.support_team.teachers.edit', $data);
    }

    public function reset_pass($id)
    {
        // Redirect if Making Changes to Head of Super Admins
        if(Qs::headSA($id)){
            return back()->with('flash_danger', __('msg.denied'));
        }

        $data['password'] = Hash::make('user');
        $this->user->update($id, $data);
        return back()->with('flash_success', __('msg.pu_reset'));
    }


    //Store 
    public function store(Request $req)
    {
        $user_id = $req->teacher_id;
        $phone = $req->phone;
        $email = $req->email;
        // dd($user_id);
        $user_id = Teacher::where("user_id","=",$user_id)
                        ->get();
        $user_phone = Teacher::where("phone","=",$phone)
                        ->get();
        $user_email = Teacher::where("email","=",$email)
                        ->get();

        if(count($user_id)>0){
            return redirect()->route("teachers.index")->with("msg","You already registered");
        } 
        elseif(count($user_email)>0){
            return redirect()->route("teachers.index")->with("msg","Please choose a different email");
        }           
        elseif(count($user_phone)>0){
            return redirect()->route("teachers.index")->with("msg","Please choose a different phone number");
        } else{
            // dd();
            
                $user_table = User::where("user_id","=",$req->teacher_id)->get();
                           
                if(count($user_table)>0)
                {
                
                // Teacher info store 
                $insert = new Teacher;
                $insert->user_id = $req->teacher_id;
                $insert->department_id = Qs::decodeHash($req->department_id);
                $insert->name =  $req->name;
                $insert->address = $req->address;
                $insert->email = $req->email;
                $insert->phone = $req->phone;
                $insert->emp_date =  $req->emp_date;
                $insert->gender =  $req->gender;
                $insert->nationality =  $req->nationality;
                $insert->bg_name =  $req->bg_name;
                // $insert->photo =  $req->photo;
                // $insert->resume =  $req->resume;

                if($req->hasFile('photo')) {
                    $photo = $req->file('photo');
                    $f = Qs::getFileMetaData($photo);
                    $f['name_photo'] = 'nobir_'.time().'.' . $f['ext'];
                    $f['path_photo'] = $photo->storeAs(Qs::getUploadPath('Teachers_Photo'), $f['name_photo']);
                    // $insert->photo = $request->photo;
                    $insert->photo = asset('storage/' . $f['path_photo']);
                }

                if($req->hasFile('resume')) {
                    $resume = $req->file('resume');
                    $f = Qs::getFileMetaData($resume);
                    $f['name_resume'] = 'nobir_'.time().'.' . $f['ext'];
                    $f['path_resume'] = $resume->storeAs(Qs::getUploadPath('Teachers_Resume'), $f['name_resume']);
                    // $insert->resume = $request->resume;
                    $insert->resume = asset('storage/' . $f['path_resume']);
                }


                $insert->save();

                // Department Semester Teache Section junction table record create 
                // $insert_dssts_jt = new dssts_jt;
                // $insert_dssts_jt->department_id = $department_id;
                // $insert_dssts_jt->semester_id = $semester_id;
                // $insert_dssts_jt->student_id = $student_id;
                // $insert_dssts_jt->section_id = $section_id;
                // $insert_dssts_jt->session = $session;
                // user create
                $user_table_update = User::where("user_id","=",$req->teacher_id)
                                    ->first();
                $user_table_update->name =  $req->name;
                $user_table_update->email = $req->email;
                $user_table_update->phone = $req->phone;
                $user_table_update->user_table_id =  $insert->id;
                $user_table_update->password =  Hash::make($req->password);

                $user_table_update->save();

                // $insert->bg_name =  $req->bg_name;
                // $insert->blood_group_name = $req->blood_group_name;
                // $insert->exam_name =  $req->exam_name;
                // $insert->passing_year = $req->passing_year;
                // $insert->division =  $req->division;
                // $insert->board =  $req->board;
                // $insert->roll =  $req->roll;
                // $insert->registration_no =  $req->registration_no;
                // $insert->gpa =  $req->gpa;
                // $user_type = $this->user->findType($req->user_type)->title;

                // $data = $req->except(Qs::getStaffRecord());
                // $data['name'] = ucwords($req->name);
                // $data['user_type'] = $user_type;
                // $data['photo'] = Qs::getDefaultUserImage();
                // $data['code'] = strtoupper(Str::random(10));

                // $user_is_staff = in_array($user_type, Qs::getStaff());
                // $user_is_teamSA = in_array($user_type, Qs::getTeamSA());

                // $staff_id = Qs::getAppCode().'/STAFF/'.date('Y/m', strtotime($req->emp_date)).'/'.mt_rand(1000, 9999);
                // $data['username'] = $uname = ($user_is_teamSA) ? $req->username : $staff_id;

                // $pass = $req->password ?: $user_type;
                // $data['password'] = Hash::make($pass);

                // if($req->hasFile('photo')) {
                //     $photo = $req->file('photo');
                //     $f = Qs::getFileMetaData($photo);
                //     $f['name'] = 'photo.' . $f['ext'];
                //     $f['path'] = $photo->storeAs(Qs::getUploadPath($user_type).$data['code'], $f['name']);
                //     $data['photo'] = asset('storage/' . $f['path']);
                // }

                // /* Ensure that both username and Email are not blank*/
                // if(!$uname && !$req->email){
                //     return back()->with('pop_error', __('msg.user_invalid'));
                // }

                // $user = $this->user->create($data); // Create User

                // /* CREATE STAFF RECORD */
                // if($user_is_staff){
                //     $d2 = $req->only(Qs::getStaffRecord());
                //     $d2['user_id'] = $user->id;
                //     $d2['code'] = $staff_id;
                //     $this->user->createStaffRecord($d2);
                // }

            return redirect()->route("teachers.index")->with("msg","Your Registration has been successfull");
        }
        else{
            return redirect()->route("teachers.index")->with("msg","Teacher ID is not found");
        }
        }        


        if(count($user_id)<1)
        {
       
        }else{
            return redirect()->route("teachers.index")->with("msg","You already registered");
        }

       


    }

    public function update(Request $req, $id)
    {
        $user_id = $req->teacher_id;
        $phone = $req->phone;
        $email = $req->email;


        $user_id = Teacher::where("user_id","=",$user_id)
                            ->where("id","!=",$id)
                            ->get();
        $user_phone = Teacher::where("phone","=",$phone)
                            ->where("id","!=",$id)
                            ->get();
        $user_email = Teacher::where("email","=",$email)
                            ->where("id","!=",$id)
                            ->get();

        if(count($user_id)>0){
            return redirect()->route("teachers.index")->with("msg","You already registered");
        } 
        elseif(count($user_email)>0){
            return redirect()->route("teachers.index")->with("msg","Please choose a different email");
        }           
        elseif(count($user_phone)>0){
            return redirect()->route("teachers.index")->with("msg","Please choose a different phone number");
        } 
        else{

            $id = Qs::decodeHash($id);
            $update = Teacher::find($id);
            // dd($update);
            // $update->department_name = $req->department_name;
            $update->name =  $req->name;
            $update->address = $req->address;
            $update->email = $req->email;
            $update->phone = $req->phone;
            $update->emp_date =  $req->emp_date;
            $update->gender =  $req->gender;
            $update->nationality =  $req->nationality;
            $update->bg_name =  $req->bg_name;
            // $update->photo =  $req->photo;
            // $update->resume =  $req->resume;
    
            if($req->hasFile('photo')) {
                $photo = $req->file('photo');
                $f = Qs::getFileMetaData($photo);
                $f['name_photo'] = 'nobir_'.time().'.' . $f['ext'];
                $f['path_photo'] = $photo->storeAs(Qs::getUploadPath('Teachers_Photo'), $f['name_photo']);
                // $update->photo = $request->photo;
                $update->photo = asset('storage/' . $f['path_photo']);
            }
    
            if($req->hasFile('resume')) {
                $resume = $req->file('resume');
                $f = Qs::getFileMetaData($resume);
                $f['name_resume'] = 'nobir_'.time().'.' . $f['ext'];
                $f['path_resume'] = $resume->storeAs(Qs::getUploadPath('Teachers_Resume'), $f['name_resume']);
                // $update->resume = $request->resume;
                $update->resume = asset('storage/' . $f['path_resume']);
            }
       
            $update->save();   
            return back();
        }

       
    }


    public function show($user_id)
    {
        $user_id = Qs::decodeHash($user_id);
        if(!$user_id){return back();}

        $data['user'] = $this->user->find($user_id);

        /* Prevent Other Students from viewing Profile of others*/
        if(Auth::user()->id != $user_id && !Qs::userIsTeamSAT() && !Qs::userIsMyChild(Auth::user()->id, $user_id)){
            return redirect(route('dashboard'))->with('pop_error', __('msg.denied'));
        }

        return view('pages.support_team.users.show', $data);
    }

    public function destroy($id)
    {
        $id = Qs::decodeHash($id);

        $delete = Teacher::find($id);
        // $st_id = Qs::decodeHash($st_id);
        // if(!$st_id){return Qs::goWithDanger();}
        // $sr = $this->student->getRecord(['user_id' => $st_id])->first();

        $path_photo = Qs::getUploadPath('Teachers_Photo').$delete->photo;
        $path_resume = Qs::getUploadPath('Teachers_Resume').$delete->resume;
        Storage::exists($path_photo) ? Storage::deleteDirectory($path_photo) : false;
        Storage::exists($path_resume) ? Storage::deleteDirectory($path_resume) : false;

        $delete->delete();

        // return back()->with('flash_success', __('msg.del_ok'));
        // Redirect if Making Changes to Head of Super Admins
        // if(Qs::headSA($id)){
        //     return back()->with('pop_error', __('msg.denied'));
        // }

        // $user = $this->user->find($id);

        // if($user->user_type == 'teacher' && $this->userTeachesSubject($user)) {
        //     return back()->with('pop_error', __('msg.del_teacher'));
        // }

        // $path = Qs::getUploadPath($user->user_type).$user->code;
        // Storage::exists($path) ? Storage::deleteDirectory($path) : true;
        // $this->user->delete($user->id);

        return back()->with('flash_success', __('msg.del_ok'));
    }

    protected function userTeachesSubject($user)
    {
        $subjects = $this->my_class->findSubjectByTeacher($user->id);
        return ($subjects->count() > 0) ? true : false;
    }

}