<?php

namespace App\Http\Controllers\General\Panel;

use App\UserInfo;
use Illuminate\Http\Request;
use App\Model\General\Calender;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;
use App\Traits;

class CalenderController extends Controller
{
    use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  userCalender
    public function userCalender(Request $request)
    {

        if ($request->selectYear == null || $request->selectMonth == null){
            $selectMonth = Jalalian::forge('now')->format('%B');
            $selectYear = Jalalian::forge('now')->format('%Y');
            $calender = auth()->user()->calender()->where('year',$selectYear)->where('month',$selectMonth)->get();
            return response()->json($calender);
        }else{
            $calender = auth()->user()->calender()->where('year',$request->selectYear)->where('month',$request->selectMonth)->get();
            return response()->json($calender);
        }

    }
    //////////////////////////////////////////////////////////////////////  userCalender
    //////////////////////////////////////////////////////////////////////  deleteTodoCalender
    public function deleteTodoCalender($id)
    {
        $calender = auth()->user()->calender()->get()->where('id',$id)->first()->delete();
        return $this->vSuccess();
    }
    //////////////////////////////////////////////////////////////////////  deleteTodoCalender
    //////////////////////////////////////////////////////////////////////  allUserForCalender
    public function allUserForCalender()
    {
        $allUserForCalender = UserInfo::get();
        return response()->json($allUserForCalender);
    }
    //////////////////////////////////////////////////////////////////////  allUserForCalender
    //////////////////////////////////////////////////////////////////////  registTodo
    public function registTodo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->vError($validator->errors());
        }
        if(!json_decode($request->users) ){
            Calender::create([
                'title' => $request->title,
                'description' => $request->description,
                'day' => $request->day,
                'month' => $request->month,
                'year' => $request->year,
                'status' => 1,
                'registerer' => auth()->user()->userinfo()->first()->name.' '.auth()->user()->userinfo()->first()->family,
                'user_id' => auth()->user()->id
            ]);
            return $this->vSuccess();
        }
        else{
            foreach (json_decode($request->users) as $item){
                Calender::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'day' => $request->day,
                    'month' => $request->month,
                    'year' => $request->year,
                    'status' => 4,
                    'registerer' => auth()->user()->userinfo()->first()->name.' '.auth()->user()->userinfo()->first()->family,
                    'user_id' => UserInfo::where('id',$item->id)->first()->user()->first()->id
                ]);
            }
            return $this->vSuccess();
        }
    }

    //////////////////////////////////////////////////////////////////////  registTodo
    //////////////////////////////////////////////////////////////////////  todoDone
    public function todoDone(Request $request)
    {
        $calender = auth()->user()->calender()->get()->where('id',$request->id)->first()->update(['status'=>3]);
        return $this->vSuccess();
    }
    //////////////////////////////////////////////////////////////////////  todoDone
    //////////////////////////////////////////////////////////////////////  todoLater
    public function todoLater(Request $request)
    {
        $calender = auth()->user()->calender()->get()->where('id',$request->id)->first()->update(['status'=>2]);
        return $this->vSuccess();
    }
    //////////////////////////////////////////////////////////////////////  todoLater
}

