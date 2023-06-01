<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentPostRequest;
use App\Http\Requests\CreateWorkPostRequest;
use App\Models\Group;
use App\Models\Topics;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function createStudentPage(){
        $groups=Group::all();
        return view('admin.createStudent',['groups'=>$groups]);
    }
    public function createStudent(CreateStudentPostRequest $request){
        $photo=$request->validated('photo');
        $photo->move(public_path('images/students'),$photo->getClientOriginalName());
        if($request->password==$request->password1){
            User::create([
                'user_id'=>Auth::user()->id,
                'group_id'=>$request->validated('group_id'),
                'name'=>$request->validated('name'),
                'email'=>$request->validated('email'),
                'password'=>Hash::make($request->validated('password')),
                'photo'=>$photo->getClientOriginalName(),
                'role'=>'student'
            ]);
            
        return redirect()->route('admin.home');
        }
    }

    public function subjects(){
        return DB::table('users')
        ->join('students','users.id','=','students.user_id')
        ->join('subjects','students.subject_id','=','subjects.id')
        ->select('subjects.id','subjects.name')
        ->where('user_id',Auth::user()->id)
        ->get();
    }
    public function StudentHome(){
        return view('student.home',['subjects'=>$this->subjects()]);
    }

    public function studentProfile(){
        return view('student.profile');
    }

    public function profileUpdate(Request $request){
        if($request->password == $request->password1){
            User::where('id',Auth::user()->id)->update([
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'created_at'=>now()->toDateTimeString()
            ]);
        };
        return redirect()->route('student.home');
    }
    
    
    public function workPage($id){
        
        $work=Work::where('student_id',Auth::user()->id)->where('subject_id',$id)->get();
        
        $topicBool=Topics::where('group_id',Auth::user()->group_id)->where('subject_id',$id)->exists();
        $topic_name=Topics::where('group_id',Auth::user()->group_id)->where('subject_id',$id)->first();
        return view('student.work',['subjects'=>$this->subjects(),'sub_id'=>$id,'work'=>$work,'topicBool'=>$topicBool,'topic_name'=>$topic_name]);
    }

    public function work(CreateWorkPostRequest $request){
        $file=$request->validated('file');
        $file->move(public_path('works'),$file->getClientOriginalName());
        Work::create([
            'student_id'=>Auth::user()->id,
            'subject_id'=>$request->subject_id,
            'file'=>$file->getClientOriginalName(),
            'score'=>null
        ]);
        return redirect()->route('student.home');
    }


}
