<?php

namespace App\Http\Controllers\SiteView;

use App\Model\Panel\Article\WebArticle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ViewLikeAndCommentController extends Controller
{
    //////////////////////////////////////////////////////////////////////  viewLikeArticle
    public function viewLikeArticle(Request $request)
    {
        if (
        WebArticle::where('slug', $request->slug)->first()
            ->likeDislike()->where('ip',request()->ip())->first()
        ){
            WebArticle::where('slug', $request->slug)->first()
                ->likeDislike()->where('ip',request()->ip())->first()->delete();
        }
        $viewLikeArticle = WebArticle::where('slug', $request->slug)->first()
            ->likeDislike()->create([
                'ip'=>request()->ip(),
                'agree'=>1,
                'disagree'=>0,
            ]);
        return response()->json('done');
    }
    //////////////////////////////////////////////////////////////////////  viewLikeArticle
    //////////////////////////////////////////////////////////////////////  viewDisLikeArticle
    public function viewDisLikeArticle(Request $request)
    {
        if (
        WebArticle::where('slug', $request->slug)->first()
            ->likeDislike()->where('ip',request()->ip())->first()
        ){
            WebArticle::where('slug', $request->slug)->first()
                ->likeDislike()->where('ip',request()->ip())->first()->delete();
        }
        $viewDisLikeArticle = WebArticle::where('slug', $request->slug)->first()
            ->likeDislike()->create([
                'ip'=>request()->ip(),
                'agree'=>0,
                'disagree'=>1,
            ]);
        return response()->json('done');
    }
    //////////////////////////////////////////////////////////////////////  viewDisLikeArticle
    //////////////////////////////////////////////////////////////////////  viewCommentArticle
    public function viewCommentArticle(Request $request)
    {
        if ($request->title == null || !is_string($request->title)){
            $title = 'none';
        }else{
           $title = $request->title;
        }
        if ($request->body == null || !is_string($request->body)){
            $body = 'none';
        }else{
            $body = $request->body;
        }
        $viewDisLikeArticle = WebArticle::where('slug', $request->slug)->first()
            ->comment()->create([
                'status'=>0,
                'agree'=>0,
                'disagree'=>0,
                'title'=>$title,
                'body'=>$body,
                'ip'=>request()->ip(),
            ]);
        return response()->json('done');
    }
    //////////////////////////////////////////////////////////////////////  viewCommentArticle

}


