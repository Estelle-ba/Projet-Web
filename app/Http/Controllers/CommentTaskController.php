<?php

namespace App\Http\Controllers;



use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use App\Models\comment_common_task;
use Illuminate\Support\Facades\Gate;
use PHPUnit\TextUI\XmlConfiguration\UpdateSchemaLocation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\authorization;

class CommentTaskController extends Controller
{
    public function addComment(Request $request){
        $user = Auth::user();
        $title = $request->title;
        $description = $request->description;
        $comment = $request->comment;

        $NewComment = new comment_common_task();
        $NewComment ->user_id = $user -> id;
        $NewComment ->title = $title;
        $NewComment->description = $description;
        $NewComment->comment = $comment;
        $NewComment->save();
        return redirect()->route('common-life.index');
    }

    public function modifyComment(Request $request){
        $id = $request->id;
        $comment = $request->comment;
        $ChangeComment= comment_common_task::where('id',$id)->firstOrFail();
        //$this->authorize('update', $ChangeComment);
        $ChangeComment->update(['comment'=>$comment]);
        return redirect()->route('common-life.index');
    }

    public function deleteComment(Request $request){
        $id = $request->id;
        $comment = comment_common_task::where('id',$id);
        //$this->authorize('delete_Comment',$comment);
        $comment->delete();
        return redirect()->route('common-life.index');
    }
}
