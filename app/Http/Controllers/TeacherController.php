<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCheckPostRequest;
use App\Http\Requests\CreateTeacherPostRequest;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Topics;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function createTeacherToSubPage(){
        $groups=Group::all();
        $subjects=Subject::all();
        $teachers=User::where('role','teacher')->get();
        return view('admin.createTeacherToSub',['groups'=>$groups,'subjects'=>$subjects,'teachers'=>$teachers]);
    }
    public function createTeacherToSub(Request $request){
        if(!Teacher::where('user_id',$request->user_id)->where('group_id',$request->group_id)->where('subject_id',$request->subject_id)->exists()){
            Teacher::create($request->all());
    
            $students=User::where('role','student')->where('group_id',$request->group_id)->get();
            foreach ($students as $student) {
                Student::create([
                    'user_id'=>$student->id,
                    'group_id'=>$student->group_id,
                    'subject_id'=>$request->subject_id,
                    'teacher_id'=>$request->user_id,
                ]);
            }
            return redirect()->route('admin.home');
        }
        return redirect()->route('createTeacherToSubPage');
    }
    
    public function createTeacherPage(){
        return view('admin.createTeacher');
    }
    public function createTeacher(CreateTeacherPostRequest $request){
        // dd($request->validated('name'));
        $photo=$request->validated('photo');
        $photo->move(public_path('images/teachers'),$photo->getClientOriginalName());
        
            User::create([
                'user_id'=>Auth::user()->id,
                'group_id'=>null,
                'name'=>$request->validated('name'),
                'email'=>$request->validated('email'),
                'password'=>Hash::make($request->validated('password')),
                'photo'=>$photo->getClientOriginalName(),
                'role'=>'teacher'
            ]);
            
        return redirect()->route('admin.home');
        
    }
    public function groups(){
        return DB::table('users')
        ->join('teachers','users.id','=','teachers.user_id')
        ->join('subjects','teachers.subject_id','=','subjects.id')
        ->join('groups','teachers.group_id','=','groups.id')
        ->where('user_id',Auth::user()->id)
        ->select('groups.id as group_id','subjects.id as subject_id','groups.name as group_name','subjects.name as subject_name')
        ->get();
    }
    public function teacherHome(){
        return view('teacher.home',['groups'=>$this->groups()]);
    }

    
    public function teacherProfile(){
        return view('teacher.profile');
    }

    public function profileUpdate(Request $request){
        if($request->password == $request->password1){
            User::where('id',Auth::user()->id)->update([
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'created_at'=>now()->toDateTimeString()
            ]);
        };
        return redirect()->route('teacher.home');
    }

    public function checkPage($g_id,$s_id){
        $students=DB::table('students')
        ->where('students.group_id',$g_id)
        ->where('students.subject_id',$s_id)
        ->where('works.subject_id',$s_id)
        ->join('users','students.user_id','=','users.id')
        ->join('works','students.user_id','=','works.student_id')
        ->join('groups','students.group_id','=','groups.id')
        ->select('works.id','groups.name as group_name','users.name','works.file','works.score')
        ->get();
        
        $topicBool=Topics::where('group_id',$g_id)->where('subject_id',$s_id)->exists();
        $topic_name=Topics::where('group_id',$g_id)->where('subject_id',$s_id)->first();
        return view('teacher.check',['groups'=>$this->groups(),'students'=>$students,'g_id'=>$g_id,'s_id'=>$s_id,'topicBool'=>$topicBool,'topic_name'=>$topic_name]);
    }

    public function check(CreateCheckPostRequest $request){
        Work::where('id',$request->id)->update([
            'score'=>$request->validated('score')
        ]);
        return redirect()->route('teacher.home');
    }
    
    
    public function topic(Request $request){

        Topics::create([
            'group_id'=>$request->group_id,
            'subject_id'=>$request->subject_id,
            'teacher_id'=>Auth::user()->id,
            'name'=>$request->name,
            'deadline'=>date('Y-m-d H:i:s', strtotime($request->deadline))
        ]);
        return redirect()->route('teacher.checkPage',[$request->group_id,$request->subject_id]);
    }
}
