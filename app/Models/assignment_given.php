<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assignment_given extends Model
{
    use HasFactory;
    protected $table = "assignments_given";
    public function assignmentSubmit(){
        
        return $this->hasMany(assignmentSumbit::class);
    }

}