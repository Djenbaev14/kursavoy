<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TeacherWorkSearch extends Component
{
    public $students;

    public function mount($g_id,$s_id){
        $this->students=DB::table('students')
        ->where('students.group_id',$g_id)
        ->where('students.subject_id',$s_id)
        ->where('works.subject_id',$s_id)
        ->join('users','students.user_id','=','users.id')
        ->join('works','students.user_id','=','works.student_id')
        ->join('groups','students.group_id','=','groups.id')
        ->select('works.id','groups.name as group_name','users.name','works.file','works.score')
        ->get();
    }
    public function render()
    {
        return view('livewire.teacher-work-search');
    }
}
