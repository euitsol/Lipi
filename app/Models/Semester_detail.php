<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester_detail extends Model
{
    use HasFactory;
    
    protected $table = "semester_details";
    
 protected $fillable = ['department_id','semester_id','subject_id','teacher_id'];

 
 public function departments(){
    return $this->belongsTo(departmentModel::class, 'department_id');
}
public function semesters(){
    return $this->belongsTo(semester::class, 'semester_id');
}
public function nsubjects(){
    return $this->belongsTo(n_subjectModel::class, 'subject_id');
}
public function teacher(){
    return $this->belongsTo(Teacher::class, 'teacher_id');
}
}