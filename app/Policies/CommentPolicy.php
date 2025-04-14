<?php

namespace App\Policies;


use App\Models\comment_common_task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;


class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    use HandlesAuthorization;
    public function modify_Comment($comment){
        $user = Auth::user();
        return $user->id == $comment->user_id;
    }
    public function delete_Comment($comment){
        $user = Auth::user();
        return $user->id == $comment->user_id;
    }
    public function __construct()
    {
        //
    }
}
