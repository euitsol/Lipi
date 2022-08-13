<?php

namespace App\Models;

use App\User;
use Eloquent;

class Subject extends Eloquent
{
    protected $fillable = ['my_class_id', 'teacher_id','department_id','subject_id'];

    public function my_class()
    {
        return $this->belongsTo(MyClass::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function departments()
    {
        return $this->belongsTo(departmentModel::class,"departments_id");
    }
    public function nsubjects()
    {
        return $this->belongsTo(n_subjectModel::class, 'subject_id');
    }
}
