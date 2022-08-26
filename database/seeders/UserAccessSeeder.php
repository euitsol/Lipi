<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $n = [
            [
                'user_roll' => "super_admin",
                'create' => "yes",
                'edit' => "yes",
                'delete' => "yes",
                'department' => "yes",
                'semester' => "yes",
                'subject' => "yes",
                'semester_details' => "yes",
                'group' => "yes",
                'class_room' => "yes",
                'routine' => "yes",
                'attendance' => "yes",
                'assignment' => "yes",
                'assignment_given' => "yes",
                'assignment_taken' => "yes",
                'notice' => "yes",
                'user' => "yes",             
                'teacher' => "yes",             
                'exam' => "yes",             
            ],
            [
                'user_roll' => "admin",
                'create' => "yes",
                'edit' => "yes",
                'delete' => "no",
                'department' => "yes",
                'semester' => "yes",
                'subject' => "yes",
                'semester_details' => "yes",
                'group' => "yes",
                'class_room' => "yes",
                'routine' => "yes",
                'attendance' => "yes",
                'assignment' => "yes",
                'assignment_given' => "yes",
                'assignment_taken' => "yes",
                'notice' => "yes",
                'user' => "yes", 
                'teacher' => "yes",             
                'exam' => "yes",              
            ],
            [
            'user_roll' => "teacher",
            'create' => "yes",
            'edit' => "yes",
            'delete' => "no",
            'department' => "no",
            'semester' => "no",
            'subject' => "no",
            'semester_details' => "no",
            'group' => "yes",
            'class_room' => "no",
            'routine' => "no",
            'attendance' => "yes",
            'assignment' => "yes",
            'assignment_given' => "yes",
            'assignment_taken' => "no",
            'notice' => "yes",
            'user' => "no", 
            'teacher' => "yes",             
            'exam' => "yes",           
            ],
            [
                'user_roll' => "student",
                'create' => "yes",
                'edit' => "yes",
                'delete' => "no",
                'department' => "no",
                'semester' => "no",
                'subject' => "no",
                'semester_details' => "no",
                'group' => "no",
                'class_room' => "no",
                'routine' => "no",
                'attendance' => "no",
                'assignment' => "yes",
                'assignment_given' => "no",
                'assignment_taken' => "yes",
                'notice' => "no",
                'user' => "no",
                'teacher' => "no",             
                'exam' => "yes",  
            ],
            [
                'user_roll' => "admission",
                'create' => "no",
                'edit' => "no",
                'delete' => "no",
                'department' => "no",
                'semester' => "no",
                'subject' => "no",
                'semester_details' => "no",
                'group' => "no",
                'class_room' => "no",
                'routine' => "no",
                'attendance' => "no",
                'assignment' => "no",
                'assignment_given' => "no",
                'assignment_taken' => "no",
                'notice' => "no",
                'user' => "no", 
                'teacher' => "no",             
                'exam' => "no", 
            ]
        ];
        DB::table('user_accesses')->insert($n);
    }
}