<?php

namespace App\Http\Controllers\Panel\Category;

use App\Model\Panel\WebCategory\WebCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class WebCategoryController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;
    /////////////////////////////////////////////////////////////////////////////////////registCategory
    public function registCategory(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'priority' => 'required',
                'page_template_id' => 'required',
                'page_language_id' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                WebCategory::create(array_merge($request->all(), array(
                    'image' => $this->saveImageAbsolute('manyColumnFile',$request->name, $request->image)
                )));
                return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////registCategory
    /////////////////////////////////////////////////////////////////////////////////////categoryTable
    public function categoryTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =WebCategory::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);

        }

    }
    /////////////////////////////////////////////////////////////////////////////////////categoryTable
    /////////////////////////////////////////////////////////////////////////////////////selectCategory
    public function selectCategory($id)
    {
        if (Gate::allows('administrator')) {
            $selectCategory = WebCategory::where('id', $id)->first();
            return response()->json($selectCategory);
        }

    }
    /////////////////////////////////////////////////////////////////////////////////////selectCategory
    /////////////////////////////////////////////////////////////////////////////////////editCategory
    public function editCategory(Request $request, $id)
    {
        if (Gate::allows('administrator')) {
            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'priority' => 'required',
                'page_template_id' => 'required',
                'page_language_id' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//

            $category = WebCategory::find($id);
            $basepath = 'img/database/category/' . $request->name;
            $category->update(array_merge($request->all(), array(
                'image' => $this->saveImageAbsolute('manyColumnFile',$request->name, $request->image)
            )));
            return $this->vSuccess();

        }
    }
    /////////////////////////////////////////////////////////////////////////////////////editCategory
    /////////////////////////////////////////////////////////////////////////////////////deleteCategory
    public function deleteCategory($id)
    {
        if (Gate::allows('administrator')) {
            $category = WebCategory::find($id);
            File::delete(public_path(WebCategory::find($id)->image));
            $category->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteCategory
    /////////////////////////////////////////////////////////////////////////////////////excelCat
    public function excel()
    {
        if (Gate::allows('administrator')) {
            return Excel::download(new CategoryExport(), 'event.xls');
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////excelCat

}
