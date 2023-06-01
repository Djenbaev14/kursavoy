<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupPostRequest;
use App\Models\Group;

class GroupController extends Controller
{
    public function createGroupPage(){
        return view('admin.createGroup');
    }
    public function createGroup(CreateGroupPostRequest $request){
            Group::create($request->validated());
            return redirect()->route('admin.home');
    }
    
}
