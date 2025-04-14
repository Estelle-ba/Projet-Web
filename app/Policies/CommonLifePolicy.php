<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CommonLife;
use App\Models\UserSchool;
use Illuminate\Support\Facades\Auth;

class CommonLifePolicy
{
    /**
     * Create a new policy instance.
     */
    public function create(User $user){
        $roleUser = UserSchool::where('user_id',$user->id)->get()->firstOrFail();
        return $roleUser->role == "admin";
    }
    public function delete(User $user){
        $roleUser = UserSchool::where('user_id',$user->id)->get()->firstOrFail();
        return $roleUser->role == "admin";
    }
    public function modify_task(User $user){
        $roleUser = UserSchool::where('user_id',$user->id)->get()->firstOrFail();
        return $roleUser->role == "admin";
    }

    public function __construct()
    {
        //
    }
}
