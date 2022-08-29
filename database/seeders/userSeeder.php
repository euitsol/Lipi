<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $n =[
            ['name' => "Md Nobir Hasan",
            'email' => "nobir.wd@gmail.com",
            'phone' => "01988406007",
            'user_id' => "123",
            'user_roll' => "super_admin",
            'password' => Hash::make(123456),
            ],
            ['name' => "Nobir Admin",
            'email' => "nobir.wd.1@gmail.com",
            'phone' => "01518460933",
            'user_id' => "admin",
            'user_roll' => "admin",
            'password' => Hash::make(123456),
            ],
            ['name' => " Nobir Teacher",
            'email' => "nobir.sau@gmail.com",
            'phone' => "019884060070",
            'user_id' => "teacher",
            'user_roll' => "teacher",
            'password' => Hash::make(123456)
            ],
            ['name' => "Nobir Student",
            'email' => "nobir.pd@gmail.com",
            'phone' => "019884060071",
            'user_id' => "student",
            'user_roll' => "student",
            'password' => Hash::make(123456),
            ],
            ['name' => "Admission Student",
            'email' => "mdnobirhasan78@gmail.com",
            'phone' => "019884060072",
            'user_id' => "admission",
            'user_roll' => "admission",
            'password' => Hash::make(123456),
            ],
        ];
        DB::table('users')->insert($n);
    }
}
