<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubjectPostRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function createSubjectPage(){
        return view('admin.createSubject');
    }
    public function createSubject(CreateSubjectPostRequest $request){
            Subject::create($request->validated());
            return redirect()->route('admin.home');
    }
}
