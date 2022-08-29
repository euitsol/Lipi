<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
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
                'name' => 'Nobir',
                'user_id' => 'student',
                'father_name' => 'Shohidul Islam',
                'mother_name' => '-----',
                'present_address' => 'Agargoan',
                'parmanent_address' => 'Chuadanga',
                'email' => 'nobir@nobir.com',
                'gender' => 'male',
                'phone' => '01988406007',
                'dob' => '10-06-2000',
                'nationality' => 'Bangladeshi',
                'semester_name' => 'Semester-1',
                'group_name' => 'A',
            ],
            [
                'name' => 'Nobir',
                'user_id' => 'student2',
                'father_name' => 'Shohidul Islam',
                'mother_name' => '-----',
                'present_address' => 'Agargoan',
                'parmanent_address' => 'Chuadanga',
                'email' => 'nobir1@nobir.com',
                'gender' => 'male',
                'phone' => '01518460933',
                'dob' => '10-06-2000',
                'nationality' => 'Bangladeshi',
                'semester_name' => 'Semester-2',
                'group_name' => 'B',
            ]
            ];
            DB::table('student_infos')->insert($n);
    }
}