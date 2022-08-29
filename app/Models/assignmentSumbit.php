<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assignmentSumbit extends Model
{
    use HasFactory;
    public function assignment_given(){

        return $this->belongsTo(assignment_given::class,'assignment_given_id');
    }
}