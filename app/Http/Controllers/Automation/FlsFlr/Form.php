<?php

namespace App\Http\Controllers\Automation\FlsFlr;

use App\Model\Automation\Fax\FlsFlr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Traits;

class Form extends Controller
{
    use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  flsFlrRegister
    public function flsFlrRegister(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $validator = Validator::make($request->all(), [
                'to' => 'required',
                'from' => 'required',
                'title' => 'required',
                'attachment' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $flsFlr = FlsFlr::create([
                'to' => $request->to,
                'from' => $request->from,
                'sender' => $request->registerer,
                'user_id' => auth()->user()->id,
                'status' => 0,
                'type' => 0,
                'title' => $request->title,
            ]);
            if ($request->attachment !== null) {
                $path = 'Data/Fax/' . Carbon::today()->toDateString() . '/' . $request->receivers;
                if (!file_exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                };
                foreach (json_decode($request->attachment) as $item) {
                    rename(public_path('tempFile/' . $item->folder . '/' . $item->file), public_path($path . '/' . $item->file));
                    $file = $path . '/' . $item->file;
                    $extension = preg_replace('/^.*\.([^.]+)$/D', '$1', $file);
                    $flsFlr->attachment()->create(
                        [
                            'file' => $file,
                            'extension' => $extension
                        ]
                    );
                }
            }

                  //
                  $allsender = [];
                  if ($request->senders !== null) {
                      foreach (json_decode($request->senders) as $sender) {
                          array_push($allsender, $sender->userinfo->user_id);
                      }
                      $flsFlr->sender()->sync($allsender);
                  }
                  //
                  
                  //
            $allreceiver = [];
            if ($request->receivers !== null) {
                foreach (json_decode($request->receivers) as $receiver) {
                    array_push($allreceiver, $receiver->userinfo->user_id);
                }
                $flsFlr->receiver()->sync($allreceiver);
            }
                  //
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  flsFlrRegister
    //////////////////////////////////////////////////////////////////////  flrTable
    public function flrTable(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $mlrTable = auth()->user()->flsflr()->
                where('type',0)
                ->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($mlrTable);
        }
    }
    //////////////////////////////////////////////////////////////////////  flrTable
    //////////////////////////////////////////////////////////////////////  flsTable
    public function flsTable(Request $request)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $mlrTable = auth()->user()->flsflr()->
            where('type',0)
                ->where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->paginate(20);
            return response()->json($mlrTable);
        }
    }
    //////////////////////////////////////////////////////////////////////  flsTable
    //////////////////////////////////////////////////////////////////////  selectFlr
    public function selectFlr($id)
    {
        if (Gate::allows('secretariat') || Gate::allows('administrator') || Gate::allows('employee')) {
            $selectFls = FlsFlr::where('id', $id)->with('attachment')->first();
            return response()->json($selectFls);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectFlr
}
