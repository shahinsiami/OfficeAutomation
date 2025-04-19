<?php

namespace App\Http\Controllers\General\Users;

use App\Model\General\Notification;
use App\Permission;
use App\User;
use App\UserInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Ipecompany\Smsirlaravel\Smsirlaravel;

class Form extends Controller
{
    use Traits\validatorError;
    use Traits\uploadImage;

    /////////////////////////////////////////////////////////////////////////////////////////////////userRegister
    public function userRegister(Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:6|',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }

            $user = User::create([
                'name' => $request->name,
                'password' => bcrypt($request->password),
            ]);

            $user->userinfo()->create([
                'image' => 'img/client/icon/avatar.png',
            ]);

//        $user->userPermission()->detach();
            $permission = [];
            if ($request->permission !== null) {
                foreach (json_decode($request->permission) as $item) {
                    array_push($permission, $item->id);
                }
                $user->userPermission()->sync($permission);
            }
//        Smsirlaravel::sendVerification($randomnumber, $user->phonenumber);
            return $this->vSuccess();
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////userRegister
    /////////////////////////////////////////////////////////////////////////////////////////////////allPermissionsForUserRegister
    public function allPermissionsForUserRegister()
    {
        if (Gate::allows('administrator')) {
            $permission = Permission::get();
            return response()->json($permission);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////allPermissionsForUserRegister
    //////////////////////////////////////////////////////////////////////  userTable
    public function userTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userTable = User::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->with('userPermission')->paginate(20);
            return response()->json($userTable);

        }
    }
    //////////////////////////////////////////////////////////////////////  userTable
    //////////////////////////////////////////////////////////////////////  selectUserEdit
    public function selectUserEdit($id)
    {
        if (Gate::allows('administrator')) {

            $selectUserEdit = User::with('userPermission')->where('id', $id)->first();
            return response()->json($selectUserEdit);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectUserEdit
    //////////////////////////////////////////////////////////////////////  editUser
    public function editUser(Request $request, $id)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|',
                'password' => 'required|string|min:6|',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }
            $user = User::find($id);
            $user->update([
                'name' => $request->name,
                'password' => bcrypt($request->password),
            ]);

            $user->userinfo()->create([
                'image' => 'img/client/icon/avatar.png'
            ]);

            $user->userPermission()->detach();
            $permission = [];
            if ($request->permission !== null) {
                foreach (json_decode($request->permission) as $item) {
                    array_push($permission, $item->id);
                }
                $user->userPermission()->sync($permission);
            }
//        Smsirlaravel::sendVerification($randomnumber, $user->phonenumber);
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  editUser
    //////////////////////////////////////////////////////////////////////  deleteUser
    public function deleteUser($id)
    {
        if (Gate::allows('administrator')) {

            User::where('id', $id)->first()->delete();
            return $this->vSuccess();
        }
    }
    //////////////////////////////////////////////////////////////////////  deleteUser
    //////////////////////////////////////////////////////////////////////  userInfoTable
    public function userInfoTable(Request $request)
    {
        if (Gate::allows('administrator')) {
            $userInfoTable = User::where($request->searchColumn, 'like', '%' . $request->search . '%')->whereBetween('created_at', [$request->startDate, $request->endDate])->orderby($request->name, $request->order)->with('userinfo')->paginate(20);
            return response()->json($userInfoTable);

        }
    }
    //////////////////////////////////////////////////////////////////////  userInfoTable
    //////////////////////////////////////////////////////////////////////  selectUserInfoEdit
    public function selectUserInfoEdit($id)
    {
        if (Gate::allows('administrator')) {
            $selectUserInfoEdit = User::with('userinfo')->where('id', $id)->first();
            return response()->json($selectUserInfoEdit);
        }
    }
    //////////////////////////////////////////////////////////////////////  selectUserInfoEdit
    //////////////////////////////////////////////////////////////////////  EditUserInfo
    public function EditUserInfo($id,Request $request)
    {
        if (Gate::allows('administrator')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'family' => 'required',
                'birthday' => 'required',
                'address' => 'required',
                'degree' => 'required',
                'email' => 'required',
                'sex' => 'required',
                'phonenumber' => 'required|digits_between:9,14',
                'user_id' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->vError($validator->errors());
            }


            $userInfo = UserInfo::find($id);
            $userInfo->update(array_merge($request->all(),
                array( 'photo' => $this->saveImage('personalPhoto',$request->name,$request->photo,500,500)),
                array( 'signature' => $this->saveImage('personalSignature',$request->name,$request->signature,500,500))));
            return $this->vSuccess();


        }
    }
    //////////////////////////////////////////////////////////////////////  EditUserInfo
    //////////////////////////////////////////////////////////////////////  getUserInfo
    public function getUserInfo()
    {
        $getUser = auth()->user()->userinfo()->first();
        return response()->json($getUser);
    }
    //////////////////////////////////////////////////////////////////////  getUserInfo
    //////////////////////////////////////////////////////////////////////  getNotification
    public function getNotification()
    {
        $notification = auth()->user()->getNotification()->limit(10)->orderBy('seen')->get();
        return response()->json($notification);
    }
    //////////////////////////////////////////////////////////////////////  getNotification
    //////////////////////////////////////////////////////////////////////  seenNotification
    public function seenNotification($id)
    {
       Notification::where('id',$id)->update(['seen'=>1]);
    }
    //////////////////////////////////////////////////////////////////////  seenNotification
}


