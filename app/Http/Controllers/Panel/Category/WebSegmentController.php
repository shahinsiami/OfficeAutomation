<?php

namespace App\Http\Controllers\Panel\Category;

use App\Model\Panel\WebCategory\WebCategory;
use App\Model\Panel\WebCategory\WebSegment;
use App\Model\Panel\WebCategory\WebSubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits;
use Illuminate\Support\Facades\Gate;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
class WebSegmentController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  categoryForSegment
    public function categoryForSegment()
    {
        if (Gate::allows('administrator')) {
            $categoryForSegment = WebCategory::all();
            return response()->json($categoryForSegment);
        }
    }
    //////////////////////////////////////////////////////////////////////  categoryForSegment

    //////////////////////////////////////////////////////////////////////  subCategoryForSegment
    public function subCategoryForSegment()
    {
        if (Gate::allows('administrator')) {
            $subCategoryForSegment = WebSubCategory::all();
            return response()->json($subCategoryForSegment);
        }
    }
    //////////////////////////////////////////////////////////////////////  subCategoryForSegment
    //////////////////////////////////////////////////////////////////////  registSegment
    public function registSegment(Request $request)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'priority' => 'required',
                'web_sub_category_id' => 'required',
                'page_template_id' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                WebSegment::create(array_merge($request->all(), array(
                    'image' => $this->saveImageAbsolute('manyColumnFile',$request->name, $request->image)
                )));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registSegment
    //////////////////////////////////////////////////////////////////////  segmentTable
    public function segmentTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =WebSegment::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);
        }
    }
    //////////////////////////////////////////////////////////////////////  segmentTable
    //////////////////////////////////////////////////////////////////////  selectSegment
    public function selectSegment($id)
    {
        if (Gate::allows('administrator')) {
            $selectSegment = WebSegment::where('id', $id)->first();
            return response()->json($selectSegment);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectsegment
    //////////////////////////////////////////////////////////////////////  editSegment
    public function editSegment(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'priority' => 'required',
                'web_sub_category_id' => 'required',
                'page_template_id' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $subcategory = WebSegment::find($id);
                $subcategory->update(array_merge($request->all(), array(
                    'image' =>$this->saveImageAbsolute('manyColumnFile',$request->name, $request->image)
                )));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editSegment
    //////////////////////////////////////////////////////////////////////  deletSegment
    public function deletSegment($id)
    {
        if (Gate::allows('administrator')) {
            $segment = WebSegment::find($id);
            File::delete(public_path(WebSegment::find($id)->image));
            $segment->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deletSegment
    //////////////////////////////////////////////////////////////////////  excelSegment
    public function excelSegment()
    {
        if (Gate::allows('administrator')) {
            return Excel::download(new SegmentExport, 'event.xls');
        }
    }
    //////////////////////////////////////////////////////////////////////  excelSegment
    //////////////////////////////////////////////////////////////////////  choiceSubCategory
    public function choiceSubCategory(WebCategory $category, $id)
    {
        if (Gate::allows('administrator')) {
            return $category->whereId($id)->first()->subcategory()->get();
        }
    }
    //////////////////////////////////////////////////////////////////////  choiceSubCategory
}
