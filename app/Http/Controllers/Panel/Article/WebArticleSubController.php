<?php

namespace App\Http\Controllers\Panel\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Article\WebArticleSub;
use App\Model\Panel\Article\WebArticle;
use App\Traits;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class WebArticleSubController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  articleForArticleSub
    public function articleForArticleSub()
    {
        if (Gate::allows('administrator')) {
            $articleForArticleSub = WebArticle::all();
            return response()->json($articleForArticleSub);
        }
    }
    //////////////////////////////////////////////////////////////////////  articleForArticleSub
    //////////////////////////////////////////////////////////////////////  registerArticleSub
    public function registerArticleSub(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'shortdescription' => 'required',
                'description' => 'required',
                'seo' => 'required',
                'tag' => 'required',
                'web_article_id' => 'required',
                'image1' => 'nullable|mimes:jpeg,png,jpg,svg',
                'image2' => 'nullable|mimes:jpeg,png,jpg,svg',
                'image3' => 'nullable|mimes:jpeg,png,jpg,svg',
                'image4' => 'nullable|mimes:jpeg,png,jpg,svg',
                'image5' => 'nullable|mimes:jpeg,png,jpg,svg',
                'image6' => 'nullable|mimes:jpeg,png,jpg,svg',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                    WebArticleSub ::create(array_merge($request->all(), array('image1' =>  $this->saveImageAbsolute('articleSub', $request->name, $request->image1))
                        , array('image2' =>  $this->saveImageAbsolute('articleSub', $request->name, $request->image2)),
                        array('image3' =>  $this->saveImageAbsolute('articleSub', $request->name, $request->image3)),
                        array('image4' =>  $this->saveImageAbsolute('articleSub', $request->name, $request->image4)),
                        array('image5' =>  $this->saveImageAbsolute('articleSub', $request->name, $request->image5)),
                        array('image6' =>  $this->saveImageAbsolute('articleSub', $request->name, $request->image6))));
                    return $this->vSuccess();
        }

    }
    //////////////////////////////////////////////////////////////////////  registerArticleSub
    /////////////////////////////////////////////////////////////////////////////////////articleSubTable
    public function articleSubTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =WebArticleSub::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////articleSubTable
    //////////////////////////////////////////////////////////////////////  selectArticleSub
    public function selectArticleSub($id)
    {
        if (Gate::allows('administrator')) {

            $article = WebArticleSub::where('id', $id)->first();
            return response()->json($article);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectArticleSub
    //////////////////////////////////////////////////////////////////////  editArticleSub
    public function editArticleSub(Request $request, $id)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'shortdescription' => 'required',
                'description' => 'required',
                'seo' => 'required',
                'tag' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'type' => 'error',
                    'title' => 'عملیات به درستی انجام نشد',
                    'text' => $validator->errors()
                ]);
            }
            //validator//
                    $article = WebArticleSub::find($id);
                    $article->update(array_merge($request->all(),
                        array('image1' =>  $this->saveImageAbsolute('article', $request->name, $request->image1)),
                        array('image2' =>  $this->saveImageAbsolute('article', $request->name, $request->image2)),
                        array('image3' =>  $this->saveImageAbsolute('article', $request->name, $request->image3)),
                        array('image4' =>  $this->saveImageAbsolute('article', $request->name, $request->image4)),
                        array('image5' =>  $this->saveImageAbsolute('article', $request->name, $request->image5)),
                        array('image6' =>  $this->saveImageAbsolute('article', $request->name, $request->image6))));
                    return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editArticleSub   
    //////////////////////////////////////////////////////////////////////  deletArticleSub
    public function deletArticleSub($id)
    {
        if (Gate::allows('administrator')) {
                    $article = WebArticleSub::find($id);
                    File::delete(public_path(WebArticleSub::find($id)->image1));
                    File::delete(public_path(WebArticleSub::find($id)->image2));
                    File::delete(public_path(WebArticleSub::find($id)->image3));
                    File::delete(public_path(WebArticleSub::find($id)->image4));
                    File::delete(public_path(WebArticleSub::find($id)->image5));
                    File::delete(public_path(WebArticleSub::find($id)->image6));
                    $article->delete();
                    return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deletArticleSub
    
}
