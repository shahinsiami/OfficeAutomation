<?php

namespace App\Http\Controllers\SiteView;

use App\Model\Panel\Article\WebArticle;
use App\Model\Panel\WebCategory\WebCategory;
use App\Model\Panel\WebCategory\WebSegment;
use App\Model\Panel\WebCategory\WebSubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Article\WebArticleSub;

class ViewArticleController extends Controller
{
    //////////////////////////////////////////////////////////////////////  singleArticle
    public function singleArticle(Request $request)
    {
        $article = WebArticle::where('slug', $request->slug)->first();
        $like = $article->likeDislike()->where('agree', 1)->count();
        $dislike = $article->likeDislike()->where('disagree', 1)->count();
        $comment = $article->comment()->where('status', 1)->get();
        return response()->json([$article, $like, $dislike, $comment]);
    }
    //////////////////////////////////////////////////////////////////////  singleArticle
    //////////////////////////////////////////////////////////////////////  lastArticleByCategory
    public function lastArticleByCategory(Request $request)
    {
        $category = WebCategory::where('slug', $request->slug)->first()->id;
        $article = WebArticle::where('web_category_id', $category)->first();
        return response()->json($article);
    }
    //////////////////////////////////////////////////////////////////////  lastArticleByCategory
    //////////////////////////////////////////////////////////////////////  lastArticleBySubCategory
    public function lastArticleBySubCategory(Request $request)
    {
        $subCategory = WebSubCategory::where('slug', $request->slug)->first()->id;
        $article = WebArticle::where('web_sub_category_id', $subCategory)->first();
        return response()->json($article);
    }
    //////////////////////////////////////////////////////////////////////  lastArticleBySubCategory
    //////////////////////////////////////////////////////////////////////  lastArticleBySegment
    public function lastArticleBySegment(Request $request)
    {
        $segment = WebSegment::where('slug', $request->slug)->first()->id;
        $article = WebArticle::where('web_segment_id', $segment)->first();
        return response()->json($article);
    }
    //////////////////////////////////////////////////////////////////////  lastArticleBySegment
    //////////////////////////////////////////////////////////////////////  articlesByCategory
    public function articlesByCategory(Request $request)
    {
        $category = WebCategory::where('slug', $request->slug)->first()->id;
        $article = WebArticle::where('web_category_id', $category)->paginate(5);
        return response()->json($article);
    }
    //////////////////////////////////////////////////////////////////////  articlesByCategory
    //////////////////////////////////////////////////////////////////////  lastArticle
    public function lastArticle(Request $request)
    {
        $article = WebArticle::where('slug', $request->slug)->first();
        return response()->json($article);
    }
    //////////////////////////////////////////////////////////////////////  lastArticle
    //////////////////////////////////////////////////////////////////////  articlesByCategoryWithoutPagination
    public function articlesByCategoryWithoutPagination(Request $request)
    {
        $category = WebCategory::where('slug', $request->slug)->first()->id;
        $articlesByCategoryWithoutPagination = WebArticle::where('web_category_id', $category)->orderby('priority')->get();
        return response()->json($articlesByCategoryWithoutPagination);
    }
    //////////////////////////////////////////////////////////////////////  articlesByCategoryWithoutPagination
    //////////////////////////////////////////////////////////////////////  articlesBySubCategory
    public function articlesBySubCategory(Request $request)
    {
        $subCategory = WebSubCategory::where('slug', $request->slug)->first()->id;
        $article = WebArticle::where('web_sub_category_id', $subCategory)->paginate(5);
        return response()->json($article);
    }
    //////////////////////////////////////////////////////////////////////  articlesBySubCategory
    //////////////////////////////////////////////////////////////////////  articlesBySubCategoryWithoutPagination
    public function articlesBySubCategoryWithoutPagination(Request $request)
    {
        $subcategory = WebSubCategory::where('slug', $request->slug)->first()->id;
        $articlesBySubCategoryWithoutPagination = WebArticle::where('web_sub_category_id', $subcategory)->orderby('priority')->get();
        return response()->json($articlesBySubCategoryWithoutPagination);
    }
    //////////////////////////////////////////////////////////////////////  articlesBySubCategoryWithoutPagination
    //////////////////////////////////////////////////////////////////////  articlesBySegment
    public function articlesBySegment(Request $request)
    {
        $segment = WebSegment::where('slug', $request->slug)->first()->id;
        $article = WebArticle::where('web_segment_id', $segment)->paginate(5);
        return response()->json($article);
    }
    //////////////////////////////////////////////////////////////////////  articlesBySegment
    //////////////////////////////////////////////////////////////////////  articlesBySegmentWithoutPagination
    public function articlesBySegmentWithoutPagination(Request $request)
    {
        $segment = WebSegment::where('slug', $request->slug)->first()->id;
        $articlesBySegmentWithoutPagination = WebArticle::where('web_segment_id', $segment)->orderby('priority')->get();
        return response()->json($articlesBySegmentWithoutPagination);
    }
    //////////////////////////////////////////////////////////////////////  articlesBySegmentWithoutPagination
    //////////////////////////////////////////////////////////////////////  singleSubArticle
    public function singleSubArticle(Request $request)
    {
        $singleSubArticle = WebArticleSub::where('slug', $request->slug)->first();
        return response()->json($singleSubArticle);
    }
    //////////////////////////////////////////////////////////////////////  singleSubArticle
    //////////////////////////////////////////////////////////////////////  subArticles
    public function subArticles(Request $request)
    {
        $subArticles = WebArticle::where('slug', $request->slug)->first()->articleSub()->get();
        return response()->json($subArticles);
    }
    //////////////////////////////////////////////////////////////////////  subArticles

}
