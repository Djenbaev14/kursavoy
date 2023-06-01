<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'group_id'=>null,
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make(123),
            'photo'=>'21104.png',
            'role'=>'admin'
        ]);
        User::create([
            'group_id'=>1,
            'name'=>'Abat',
            'email'=>'abat@gmail.com',
            'password'=>Hash::make(123),
            'photo'=>'21104.png',
            'role'=>'student'
        ]);
        User::create([
            'group_id'=>1,
            'name'=>'Asad',
            'email'=>'asad@gmail.com',
            'password'=>Hash::make(123),
            'photo'=>'21104.png',
            'role'=>'student'
        ]);
        User::create([
            'group_id'=>null,
            'name'=>'Aybergen',
            'email'=>'ayba@gmail.com',
            'password'=>Hash::make(123),
            'photo'=>'21104.png',
            'role'=>'teacher'
        ]);
        
        Group::create([
            'name'=>'304-20',
        ]);
        Subject::create([
            'name'=>'matematika',
        ]);

        Student::create([
            'user_id'=>2,
            'group_id'=>1,
            'subject_id'=>1,
            'teacher_id'=>4,
        ]);

        Student::create([
            'user_id'=>3,
            'group_id'=>1,
            'subject_id'=>1,
            'teacher_id'=>4,
        ]);
        Teacher::create([
            'user_id'=>4,
            'group_id'=>1,
            'subject_id'=>1,
        ]);
        

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        }
}
