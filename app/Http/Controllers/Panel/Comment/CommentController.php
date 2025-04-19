<?php

namespace App\Http\Controllers\Panel\Comment;

use App\Model\Panel\Article\WebArticleComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Traits;

class CommentController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;
    /////////////////////////////////////////////////////////////////////////////////////commentTable
    public function commentTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $comment =WebArticleComment::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($comment);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////commentTable
    //////////////////////////////////////////////////////////////////////  accecptComment
    public function accecptComment($id)
    {
        if (Gate::allows('administrator')) {

            $article = WebArticleComment::where('id', $id)->first()->update(['status'=>1]);
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  accecptComment
    //////////////////////////////////////////////////////////////////////  rejectComment
    public function rejectComment($id)
    {
        if (Gate::allows('administrator')) {

            $article = WebArticleComment::where('id', $id)->first()->update(['status'=>0]);
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  rejectComment
}

