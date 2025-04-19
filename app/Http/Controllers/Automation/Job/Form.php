<?php

namespace App\Http\Controllers\Automation\Job;

use App\Model\Automation\Job\JobClassification;
use App\Model\Automation\Job\JobHierarchical;
use App\Model\Automation\Job\JobPosition;
use App\Model\Automation\Job\JobRuling;
use App\Model\Automation\Job\JobShift;
use App\UserInfo;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Traits;


class Form extends Controller
{
    use Traits\validatorError;

    //////////////////////////////////////////////////////////////////////  jobClassificationRegister
    public function jobClassificationRegister(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            JobClassification::create(
                $request->all()
            );
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  jobClassificationRegister
    //////////////////////////////////////////////////////////////////////  jobClassificationTable
    public function jobClassificationTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $jobClassificationTable = JobClassification::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($jobClassificationTable);

        }
    }
    //////////////////////////////////////////////////////////////////////  jobClassificationTable
    //////////////////////////////////////////////////////////////////////  selectjobClassificationEdit
    public function selectjobClassificationEdit($id)
    {
        if (Gate::allows('administrator')) {

            $selectjobClassificationEdit = JobClassification::where('id', $id)->first();
            return response()->json($selectjobClassificationEdit);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectjobClassificationEdit
    //////////////////////////////////////////////////////////////////////  editjobClassification
    public function editjobClassification(Request $request, $id)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $JobClassification = JobClassification::find($id);
            $JobClassification->update(
                $request->all()
            );
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editjobClassification
    //////////////////////////////////////////////////////////////////////  deletejobClassification
    public function deletejobClassification($id)
    {
        if (Gate::allows('administrator')) {

            JobClassification::where('id', $id)->first()->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deletejobClassification
    //
    //////////////////////////////////////////////////////////////////////  jobPositionRegister
    public function jobPositionRegister(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|',
                'job_classification_id' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            JobPosition::create(
                $request->all()
            );
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  jobPositionRegister
    //////////////////////////////////////////////////////////////////////  jobPositionTable
    public function jobPositionTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $jobPositionTable = JobPosition::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($jobPositionTable);
        }
    }
    //////////////////////////////////////////////////////////////////////  jobPositionTable
    //////////////////////////////////////////////////////////////////////  selectJobPositionEdit
    public function selectJobPositionEdit($id)
    {
        if (Gate::allows('administrator')) {

            $selectJobPositionEdit = JobPosition::where('id', $id)->with('jobClassification')->first();
            return response()->json($selectJobPositionEdit);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectJobPositionEdit
    //////////////////////////////////////////////////////////////////////  editjobPosition
    public function editjobPosition(Request $request, $id)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|',
                'job_classification_id' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $jobPosition = JobPosition::find($id);
            $jobPosition->update(
                $request->all()
            );
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editjobPosition
    //////////////////////////////////////////////////////////////////////  deletejobPosition
    public function deletejobPosition($id)
    {
        if (Gate::allows('administrator')) {

            JobPosition::where('id', $id)->first()->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deletejobPosition
    //////////////////////////////////////////////////////////////////////  jobClassificationForJob
    public function jobClassificationForJob(Request $request)
    {
        if (Gate::allows('administrator')) {

            $jobClassificationForJob = JobClassification::where('name', 'like', '%' . $request->searchName . '%')->limit(100)->get();
            return response()->json($jobClassificationForJob);
        }
    }
    //////////////////////////////////////////////////////////////////////  jobClassificationForJob
    //////////////////////////////////////////////////////////////////////  jobHierrachicalForJob
    public function jobHierrachicalForJob(Request $request)
    {
        if (Gate::allows('administrator')) {

            $jobHierrachicalForJob = JobHierarchical::get();
            return response()->json($jobHierrachicalForJob);
        }
    }
    //////////////////////////////////////////////////////////////////////  jobHierrachicalForJob
    //
    //////////////////////////////////////////////////////////////////////  jobShiftRegister
    public function jobShiftRegister(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'start' => 'required',
                'end' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            JobShift::create(
                $request->all()
            );
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  jobShiftRegister
    //////////////////////////////////////////////////////////////////////  jobShiftTable
    public function jobShiftTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $jobTable = JobShift::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($jobTable);
        }
    }
    //////////////////////////////////////////////////////////////////////  jobShiftTable
    //////////////////////////////////////////////////////////////////////  selectjobShiftEdit
    public function selectjobShiftEdit($id)
    {
        if (Gate::allows('administrator')) {

            $selectjobEdit = JobShift::where('id', $id)->first();
            return response()->json($selectjobEdit);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectjobShiftEdit
    //////////////////////////////////////////////////////////////////////  editjobShift
    public function editjobShift(Request $request, $id)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'start' => 'required',
                'end' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $job = JobShift::find($id);
            $job->update(
                $request->all()
            );
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editjobShift
    //////////////////////////////////////////////////////////////////////  deletejobShift
    public function deletejobShift($id)
    {
        if (Gate::allows('administrator')) {
            if (JobPosition::where('job_shift_id', $id)->first() == null) {
                JobShift::where('id', $id)->first()->delete();
                return $this->vSuccess();
            } else {
                $error = (object) [
                    'error' => ['شیفت کاری به کارمندی اختصاص داده شده است' ]
                ];
                  return $this->vError($error);
            }
        }
    }
    //////////////////////////////////////////////////////////////////////  deletejobShift
    //
    //////////////////////////////////////////////////////////////////////  jobHierarchicalRegister
    public function jobHierarchicalRegister(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'rank' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            JobHierarchical::create(
                $request->all()
            );
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  jobHierarchicalRegister
    //////////////////////////////////////////////////////////////////////  jobHierarchicalTable
    public function jobHierarchicalTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $jobHierarchicalTable = JobHierarchical::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($jobHierarchicalTable);
        }
    }
    //////////////////////////////////////////////////////////////////////  jobHierarchicalTable
    //////////////////////////////////////////////////////////////////////  selectjobHierarchicalEdit
    public function selectjobHierarchicalEdit($id)
    {
        if (Gate::allows('administrator')) {

            $selectjobEdit = JobHierarchical::where('id', $id)->first();
            return response()->json($selectjobEdit);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectjobHierarchicalEdit
    //////////////////////////////////////////////////////////////////////  editjobHierarchical
    public function editjobHierarchical(Request $request, $id)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'rank' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $job = JobHierarchical::find($id);
            $job->update(
                $request->all()
            );
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editjobHierarchical
    //////////////////////////////////////////////////////////////////////  deletejobHierarchical
    public function deletejobHierarchical($id)
    {
        if (Gate::allows('administrator')) {
            JobHierarchical::where('id', $id)->first()->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deletejobHierarchical
    //
    //////////////////////////////////////////////////////////////////////  employeeForJobRuling
    public function employeeForJobRuling(Request $request)
    {
        if (Gate::allows('administrator')) {

            $employeeForJobRuling = UserInfo::where('name', 'like', '%' . $request->searchName . '%')->with('user')->limit(100)->get();
            return response()->json($employeeForJobRuling);
        }
    }
    //////////////////////////////////////////////////////////////////////  $employeeForJobRuling
    //////////////////////////////////////////////////////////////////////  shiftForJobRuling
    public function shiftForJobRuling(Request $request)
    {
        if (Gate::allows('administrator')) {

            $shiftForJobRuling = JobShift::where('title', 'like', '%' . $request->searchName . '%')->limit(100)->get();
            return response()->json($shiftForJobRuling);
        }
    }
    //////////////////////////////////////////////////////////////////////  shiftForJobRuling
    //////////////////////////////////////////////////////////////////////  jobPositionForJobRuling
    public function jobPositionForJobRuling(Request $request)
    {
        if (Gate::allows('administrator')) {

            $jobPositionForJobRuling = JobPosition::where('name', 'like', '%' . $request->searchName . '%')->limit(100)->get();
            return response()->json($jobPositionForJobRuling);
        }
    }
    //////////////////////////////////////////////////////////////////////  jobPositionForJobRuling
    //////////////////////////////////////////////////////////////////////  jobRulingRegister
    public function jobRulingRegister(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
//                'start_date' => 'required',
//                'end_date' => 'required',
                'user_id' => 'required',
//                'job_position_id' => 'required',
//                'job_shift_id' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $user = UserInfo::find($request->user_id)->user()->first();
            $job_position = [];
            if ($request->job_position_id !== null) {
                foreach (json_decode($request->job_position_id) as $item) {
                    array_push($job_position, $item->id);
                }
                $user->userJobPosition()->sync($job_position);
            }
            $job_shift = [];
            if ($request->job_shift_id !== null) {
                foreach (json_decode($request->job_shift_id) as $item) {
                    array_push($job_shift, $item->id);
                }
                $user->userJobShift()->sync($job_shift);
            }
            JobRuling::create(
                (array_merge($request->all(),
                    array('user_id' => $user->id)))
            );
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  jobRulingRegister
    //////////////////////////////////////////////////////////////////////  jobRulingTable
    public function jobRulingTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $jobRulingTable = JobRuling::with(array('user' => function ($query) {
                    $query->with(['userJobPosition', 'userJobShift', 'userinfo'])->get();
                })
            )->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($jobRulingTable);

        }
    }
    //////////////////////////////////////////////////////////////////////  jobRulingTable
    //////////////////////////////////////////////////////////////////////  selectjobRulingEdit
    public function selectjobRulingEdit($id)
    {
        if (Gate::allows('administrator')) {

            $selectjobRulingEdit = JobRuling::where('id', $id)->
            with(array('user' => function ($query) {
                $query->with(['userJobPosition', 'userJobShift', 'userinfo'])->get();
            }))->first();;
            return response()->json($selectjobRulingEdit);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectjobRulingEdit
    //////////////////////////////////////////////////////////////////////  editjobRuling
    public function editjobRuling(Request $request, $id)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'start_date' => 'required',
                'end_date' => 'required',
                'user_id' => 'required',
                'job_position_id' => 'required',
                'job_shift_id' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }

            $user = UserInfo::find($request->user_id)->user()->first();
            $job_position = [];
            $user->userJobPosition()->detach();
            if ($request->job_position_id !== null) {
                foreach (json_decode($request->job_position_id) as $item) {
                    array_push($job_position, $item->id);
                }
                $user->userJobPosition()->sync($job_position);
            }
            $job_shift = [];
            $user->userJobShift()->detach();
            if ($request->job_shift_id !== null) {
                foreach (json_decode($request->job_shift_id) as $item) {
                    array_push($job_shift, $item->id);
                }
                $user->userJobShift()->sync($job_shift);
            }
            JobRuling::find($id)->update(
                (array_merge($request->all(),
                    array('user_id' => $user->id)))
            );
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editjobRuling
    //////////////////////////////////////////////////////////////////////  deletejobRuling
    public function deletejobRuling($id)
    {
        if (Gate::allows('administrator')) {

            JobRuling::where('id', $id)->first()->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deletejobRuling

}



