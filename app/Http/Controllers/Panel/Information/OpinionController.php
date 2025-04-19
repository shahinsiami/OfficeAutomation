<?php

namespace App\Http\Controllers\Panel\Information;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Panel\Information\InformationOpinion;
use App\Traits;
use Illuminate\Support\Facades\Gate;

class OpinionController extends Controller
{
    use Traits\validatorError;
        /////////////////////////////////////////////////////////////////////////////////////opinionTable
        public function opinionTable(Request $request)
        {
            if (Gate::allows('administrator')) {
                $opinionTable =InformationOpinion::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
                return response()->json($opinionTable);
            }
    
        }
        /////////////////////////////////////////////////////////////////////////////////////opinionTable
        /////////////////////////////////////////////////////////////////////////////////////selectOpinion
        public function selectOpinion($id)
        {
            if (Gate::allows('administrator')) {
                $selectOpinion = InformationOpinion::where('id', $id)->first();
                return response()->json($selectOpinion);
            }

        }
    /////////////////////////////////////////////////////////////////////////////////////selectOpinion
    /////////////////////////////////////////////////////////////////////////////////////deleteOpinion
    public function deleteOpinion($id)
    {
        if (Gate::allows('administrator')) {
            $deleteOpinion = InformationOpinion::find($id);
            $deleteOpinion->delete();
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////deleteOpinion
}
