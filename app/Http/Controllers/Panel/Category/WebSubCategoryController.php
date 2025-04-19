<?php

namespace App\Http\Controllers\Panel\Category;

use App\Model\Panel\WebCategory\WebCategory;
use App\Model\Panel\WebCategory\WebSubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
class WebSubCategoryController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  registerSubCategory
    public function registerSubCategory(Request $request)
    {
        if (Gate::allows('administrator')) {
            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'priority' => 'required',
                'web_category_id' => 'required',
                'page_template_id' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                WebSubCategory::create(array_merge($request->all(), array(
                    'image' => $this->saveImageAbsolute('manyColumnFile',$request->name, $request->image)
                )));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  registerSubCategory
    //////////////////////////////////////////////////////////////////////  editSubCategory
    public function editSubCategory(Request $request, $id)
    {
        if (Gate::allows('administrator')) {

            //validator//
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'priority' => 'required',
                'web_category_id' => 'max:150',
                'page_template_id' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            //validator//
                $subCategory = WebSubCategory::find($id);
                $subCategory->update(array_merge($request->all(), array(
                    'image' => $this->saveImageAbsolute('manyColumnFile',$request->name, $request->image)
                )));
                return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editSubCategory
    //////////////////////////////////////////////////////////////////////  categoryForSubCategories
    public function categoryForSubCategories()
    {
        if (Gate::allows('administrator')) {
            $allcategory = WebCategory::all();
            return response()->json($allcategory);
        }
    }
    //////////////////////////////////////////////////////////////////////  categoryForSubCategories
    /////////////////////////////////////////////////////////////////////////////////////subCategoryTable
    public function subCategoryTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable =WebSubCategory::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($userTable);

        }

    }
    /////////////////////////////////////////////////////////////////////////////////////subCategoryTable

    //////////////////////////////////////////////////////////////////////  selectsubcat
    public function selectSubCategory($id)
    {
        if (Gate::allows('administrator')) {
            $selectSubCategory = WebSubCategory::where('id', $id)->first();
            return response()->json($selectSubCategory);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectSubCategory
    //////////////////////////////////////////////////////////////////////  deleteSubCategory
    public function deleteSubCategory($id)
    {
        if (Gate::allows('administrator')) {
            $deleteSubCategory = WebSubCategory::find($id);
            File::delete(public_path(WebSubCategory::find($id)->image));
            $deleteSubCategory->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteSubCategory
    //////////////////////////////////////////////////////////////////////  excelSubCategory
    public function excelSubCategory()
    {
        if (Gate::allows('administrator')) {
            return Excel::download(new SubCategoryExport, 'subCategory.xls');
        }
    }
    //////////////////////////////////////////////////////////////////////  excelSubCategory
}
