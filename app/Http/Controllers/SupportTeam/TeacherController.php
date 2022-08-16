<?php

namespace App\Http\Controllers\SupportTeam;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\departmentModel;

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
        $d['user'] = $this->user->find($id);
        $d['states'] = $this->loc->getStates();
        $d['users'] = $this->user->getPTAUsers();
        $d['blood_groups'] = $this->user->getBloodGroups();
        $d['nationals'] = $this->loc->getAllNationals();
        return view('pages.support_team.users.edit', $d);
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

    public function store(Request $req)
    {

        $insert = new Teacher;
        $insert->department_name = $req->department_name;
        $insert->name =  $req->name;
        $insert->address = $req->address;
        $insert->email = $req->email;
        $insert->phone = $req->phone;
        $insert->emp_date =  $req->emp_date;
        $insert->gender =  $req->gender;
        $insert->nationality =  $req->nationality;
        $insert->username = $req->username;
        $insert->password =  $req->password;

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

        return Qs::jsonStoreOk();
    }

    public function update(UserRequest $req, $id)
    {
        $id = Qs::decodeHash($id);

        // Redirect if Making Changes to Head of Super Admins
        if(Qs::headSA($id)){
            return Qs::json(__('msg.denied'), FALSE);
        }

        $user = $this->user->find($id);

        $user_type = $user->user_type;
        $user_is_staff = in_array($user_type, Qs::getStaff());
        $user_is_teamSA = in_array($user_type, Qs::getTeamSA());

        $data = $req->except(Qs::getStaffRecord());
        $data['name'] = ucwords($req->name);

        if($user_is_staff && !$user_is_teamSA){
            $data['username'] = Qs::getAppCode().'/STAFF/'.date('Y/m', strtotime($req->emp_date)).'/'.mt_rand(1000, 9999);
        }
        else {
            $data['username'] = $user->username;
        }

        if($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = 'photo.' . $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath($user_type).$user->code, $f['name']);
            $data['photo'] = asset('storage/' . $f['path']);
        }

        $this->user->update($id, $data);   /* UPDATE USER RECORD */

        /* UPDATE STAFF RECORD */
        if($user_is_staff){
            $d2 = $req->only(Qs::getStaffRecord());
            $d2['code'] = $data['username'];
            $this->user->updateStaffRecord(['user_id' => $id], $d2);
        }

        return Qs::jsonUpdateOk();
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

        // Redirect if Making Changes to Head of Super Admins
        if(Qs::headSA($id)){
            return back()->with('pop_error', __('msg.denied'));
        }

        $user = $this->user->find($id);

        if($user->user_type == 'teacher' && $this->userTeachesSubject($user)) {
            return back()->with('pop_error', __('msg.del_teacher'));
        }

        $path = Qs::getUploadPath($user->user_type).$user->code;
        Storage::exists($path) ? Storage::deleteDirectory($path) : true;
        $this->user->delete($user->id);

        return back()->with('flash_success', __('msg.del_ok'));
    }

    protected function userTeachesSubject($user)
    {
        $subjects = $this->my_class->findSubjectByTeacher($user->id);
        return ($subjects->count() > 0) ? true : false;
    }

}
