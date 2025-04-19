<?php

namespace App\Http\Controllers\Panel\Information;

use App\Events\SendMailEmploymentEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Information\InformationEmployment;
use Illuminate\Support\Facades\Gate;
use App\Traits;

class EmploymentController extends Controller
{
    use Traits\validatorError;
        /////////////////////////////////////////////////////////////////////////////////////employmentTable
        public function employmentTable(Request $request)
        {
            if (Gate::allows('administrator')) {
                $employmentTable =InformationEmployment::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
                return response()->json($employmentTable);
            }
    
        }
        /////////////////////////////////////////////////////////////////////////////////////employmentTable
        /////////////////////////////////////////////////////////////////////////////////////selectEmployment
        public function selectEmployment($id)
        {
            if (Gate::allows('administrator')) {
                $selectEmployment = InformationEmployment::where('id', $id)->first();
                return response()->json($selectEmployment);
            }

        }
    /////////////////////////////////////////////////////////////////////////////////////selectEmployment
    /////////////////////////////////////////////////////////////////////////////////////deleteEmployment
    public function deleteEmployment($id)
    {
        if (Gate::allows('administrator')) {
            $deleteEmployment = InformationEmployment::find($id);
            $deleteEmployment->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteEmployment
}

