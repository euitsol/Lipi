<?php

namespace App\Http\Controllers\SupportTeam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admissionModel;
use App\Models\studentInfo;
use App\Models\semester;
use App\Helpers\Qs;

class admissionPromotController extends Controller
{
    public function Admission_std_show()
    {
       
        $d["promotion_list"] = admissionModel::where('status','=','not approved')->get();

        return view('pages.support_team.students.promotion.admissionPromossion', $d);
    }

    
     public function Admission_std_promotion(Request $request)
    {
        
    //    $id = Qs::decodeHash($id);
       $status = $request->status;
       $id = $request->id;
       $name = $request->name;
       $id = Qs::decodeHash($id);
       
       if($status == 'aprove'){
        $update = admissionModel::find($id);
        $update->status = 'Aproved';
        $update->save();
        
        $randon_number = rand(1,999999);
        $f_year = date('Y');
        $year = substr($f_year,-2);
        $user_id = $year-$randon_number;
        $semester = semester::first();

        $insert = new studentInfo;
        $insert->user_id = $user_id;
        $insert->name = $update->name;
        $insert->father_name =  $update->father_name;
        $insert->mother_name = $update->mother_name;
        $insert->present_address = $update->present_address;
        $insert->parmanent_address = $update->address;
        $insert->email = $update->email;
        $insert->gender = $update->gender;
        $insert->phone =  $update->phone;
        $insert->phone2 =  $update->phone2;
        $insert->dob =  $update->dob;
        $insert->Quota =  $update->Quota;
        $insert->nationality =  $update->nationality;
        $insert->blood_group_name = $update->blood_group_name;
        $insert->exam_name =  $update->exam_name;
        $insert->Department_name =  $update->Department_name;
        $insert->semester_name = $semester->name;
        $insert->registration_no =  $update->registration_no;
        $insert->reg_card =  $update->reg_card;
        $insert->marksheet =  $update->marksheet;
        $insert->photo =  $update->photo;
        $insert->status =  "not approved";

        
        return redirect()->back()->with('msg',"Successfully Aproved $name to Semester-1,See in Semester-1 student list");
       }

       if($status == 'decline')
       {
        $update = admissionModel::find($id);
        $update->status = 'Declined';
        $update->save();
        return redirect()->back()->with("msg','Successfully Declined $name");
       }
        
        

        // return view('pages.support_team.students.promotion.admissionPromossion', $d);
    }
}