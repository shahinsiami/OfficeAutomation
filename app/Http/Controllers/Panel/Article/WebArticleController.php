<?php

namespace App\Http\Controllers\Panel\Article;


use App\Model\Panel\Article\WebArticle;
use App\Model\Panel\WebCategory\WebCategory;
use App\Model\Panel\WebCategory\WebSegment;
use App\Model\Panel\WebCategory\WebSubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\Jalalian;
use App\Traits;


class WebArticleController extends Controller
{

    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  categoryForArticle
    public function categoryForArticle()
    {
        if (Gate::allows('administrator')) {
            $categoryForArticle = WebCategory::all();
            return response()->json($categoryForArticle);
        }
    }
    //////////////////////////////////////////////////////////////////////  categoryForArticle
    //////////////////////////////////////////////////////////////////////  subCategoryForArticle
    public function subCategoryForArticle()
    {
        if (Gate::allows('administrator')) {
            $subCategoryForArticle = WebSubCategory::all();
            return response()->json($subCategoryForArticle);
        }
    }
    //////////////////////////////////////////////////////////////////////  subCategoryForArticle
    //////////////////////////////////////////////////////////////////////  subCategoryForArticleBySelection
    public function subCategoryForArticleBySelection($id)
    {
        if (Gate::allows('administrator')) {
            $subCategoryForArticleBySelection = WebCategory::get()->where('id', $id)->first()->subcategory()->get();
            return response()->json($subCategoryForArticleBySelection);
        }
    }
    //////////////////////////////////////////////////////////////////////  subCategoryForArticleBySelection
    //////////////////////////////////////////////////////////////////////  SegmentForArticle
    public function SegmentForArticle()
    {
        if (Gate::allows('administrator')) {
            $SegmentForArticle = WebSegment::all();
            return response()->json($SegmentForArticle);
        }
    }
    //////////////////////////////////////////////////////////////////////  SegmentForArticle
    //////////////////////////////////////////////////////////////////////  SegmentForArticleBySelection
    public function SegmentForArticleBySelection($id)
    {
        if (Gate::allows('administrator')) {
            $SegmentForArticleBySelection = WebSubCategory::get()->where('id', $id)->first()->segment()->get();
            return response()->json($SegmentForArticleBySelection);
        }
    }
    //////////////////////////////////////////////////////////////////////  SegmentForArticleBySelection
    //////////////////////////////////////////////////////////////////////  registerArticle
    public function registerArticle(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'shortdescription' => 'required',
                'description' => 'required',
                'seo' => 'required',
                'tag' => 'required',
                'page_language_id' => 'required',
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
                    WebArticle ::create(array_merge($request->all(), array('image1' =>  $this->saveImageAbsolute('article', $request->name, $request->image1))
                        , array('image2' =>  $this->saveImageAbsolute('article', $request->name, $request->image2)),
                        array('image3' =>  $this->saveImageAbsolute('article', $request->name, $request->image3)),
                        array('image4' =>  $this->saveImageAbsolute('article', $request->name, $request->image4)),
                        array('image5' =>  $this->saveImageAbsolute('article', $request->name, $request->image5)),
                        array('image6' =>  $this->saveImageAbsolute('article', $request->name, $request->image6))));
                    return $this->vSuccess();
        }

    }
    //////////////////////////////////////////////////////////////////////  registerArticle
    /////////////////////////////////////////////////////////////////////////////////////articleTable
    public function articleTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =WebArticle::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////articleTable
    //////////////////////////////////////////////////////////////////////  selectArticle
    public function selectArticle($id)
    {
        if (Gate::allows('administrator')) {

            $article = WebArticle::where('id', $id)->first();
            return response()->json($article);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectArticle
    //////////////////////////////////////////////////////////////////////  editArticle
    public function editArticle(Request $request, $id)
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
                    $article = WebArticle::find($id);
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
    //////////////////////////////////////////////////////////////////////  editArticle
    //////////////////////////////////////////////////////////////////////  deletArticle
    public function deletArticle($id)
    {
        if (Gate::allows('administrator')) {

         
                    $article = WebArticle::find($id);
                    File::delete(public_path(WebArticle::find($id)->image1));
                    File::delete(public_path(WebArticle::find($id)->image2));
                    File::delete(public_path(WebArticle::find($id)->image3));
                    File::delete(public_path(WebArticle::find($id)->image4));
                    File::delete(public_path(WebArticle::find($id)->image5));
                    File::delete(public_path(WebArticle::find($id)->image6));
                    $article->delete();
                    return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deletArticle
    //////////////////////////////////////////////////////////////////////  excelArticle
    public function excelArticle()
    {
        if (Gate::allows('administrator')) {

                    return Excel::download(new ArticleExport(), 'Article.xls');
        }
    }
    //////////////////////////////////////////////////////////////////////  excelArticle
}
