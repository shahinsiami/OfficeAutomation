<?php

namespace App\Http\Controllers\SiteView;

use App\Model\Panel\Article\WebArticle;
use App\Model\Panel\WebCategory\WebCategory;
use App\Model\Panel\WebCategory\WebSegment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Article\WebArticleSub;
use App\Model\Panel\WebCategory\WebSubCategory;
use Illuminate\Support\Carbon;

class ViewBlogController extends Controller
{
    //////////////////////////////////////////////////////////////////////  blogCategoryArticles
    public function blogCategoryArticles(Request $request)
    {
        $blogCategoryArticles = WebSubCategory::where('page_language_id', $request->language)->with('articles')->take(6)->get();
        return  $blogCategoryArticles;
    }
    //////////////////////////////////////////////////////////////////////  blogCategoryArticles
    //////////////////////////////////////////////////////////////////////  blogSubCategoryArticles
    public function blogSubCategoryArticles(Request $request)
    {
        $blogSubCategoryArticles = WebSubCategory::where('page_language_id', $request->language)->with('articles')->take(6)->get();
        return  $blogSubCategoryArticles;
    }
    //////////////////////////////////////////////////////////////////////  blogSubCategoryArticles
    //////////////////////////////////////////////////////////////////////  blogSegmentArticles
    public function blogSegmentArticles(Request $request)
    {
        $blogSegmentArticles = WebSegment::where('page_language_id', $request->language)->with('articles')->take(6)->get();
        return  $blogSegmentArticles;
    }
    //////////////////////////////////////////////////////////////////////  blogSegmentArticles
    //////////////////////////////////////////////////////////////////////  recentArticles
    public function recentArticles(Request $request)
    {
        $recentArticles = WebArticle::where('page_language_id', $request->language)->take(6)->get();
        return  $recentArticles;
    }
    //////////////////////////////////////////////////////////////////////  recentArticles
    //////////////////////////////////////////////////////////////////////  ArticleArchiveByYear
    public function ArticleArchiveByYear()
    {
        $archive = WebArticle::orderBy('created_at', 'desc')
            ->whereNotNull('created_at')
            ->get(['created_at', 'title', 'slug'])
            ->groupBy(function ($item) {
                return $item->created_at->format('Y');
            })
            ->map(function ($item) {
                return $item
                    ->sortByDesc('created_at')
                    ->groupBy(function ($item) {
                        return $item->created_at->format('m');
                    });
            });
        return $archive;
    }
    //////////////////////////////////////////////////////////////////////  ArticleArchiveByYear
    //////////////////////////////////////////////////////////////////////  articleBySelectedMonth
    public function articleBySelectedMonth(Request $request)
    {
        $date1 =  Carbon::createFromFormat('Y-m-d', $request->year . '-' . $request->month . '-1')->toDateTimeString();
        $date2 =  Carbon::createFromFormat('Y-m-d', $request->year . '-' . $request->month . '-31')->toDateTimeString();
        $article = WebArticle::whereBetween('created_at', [$date1, $date2])->paginate(5);
        return response()->json($article);
    }
    //////////////////////////////////////////////////////////////////////  articleBySelectedMonth
    //////////////////////////////////////////////////////////////////////  selectedCategory
    public function selectedCategory(Request $request)
    {

        $selectedCategory = WebCategory::with(['subcategory', 'segment'])->where('slug', $request->slug)->first();
        return response()->json($selectedCategory);
    }
    //////////////////////////////////////////////////////////////////////  selectedCategory
    //////////////////////////////////////////////////////////////////////  selectedSubCategory
    public function selectedSubCategory(Request $request)
    {

        $selectedSubCategory = WebSubCategory::with('category')->where('slug', $request->slug)->first();
        return response()->json($selectedSubCategory);
    }
    //////////////////////////////////////////////////////////////////////  selectedSubCategory
    //////////////////////////////////////////////////////////////////////  selectedSegment
    public function selectedSegment(Request $request)
    {

        $selectedSegment = WebSegment::with(['category','subcategory'])->where('slug', $request->slug)->first();
        return response()->json($selectedSegment);
    }
    //////////////////////////////////////////////////////////////////////  selectedSegment
    //////////////////////////////////////////////////////////////////////  selectedArticleWithAllParent
    public function selectedArticleWithAllParent(Request $request)
    {
        $selectedArticleWithAllParent = WebArticle::with(['category', 'subcategory', 'segment'])->where('slug', $request->slug)->first();
        return response()->json($selectedArticleWithAllParent);
    }
    //////////////////////////////////////////////////////////////////////  selectedArticleWithAllParent
    //////////////////////////////////////////////////////////////////////  selectedSubArticleWithArticle
    public function selectedSubArticleWithArticle(Request $request)
    {
        $selectedSubArticleWithArticle = WebArticleSub::with('article')->where('slug', $request->slug)->first();
        return response()->json($selectedSubArticleWithArticle);
    }
    //////////////////////////////////////////////////////////////////////  selectedSubArticleWithArticle
}


// 
// 
// 