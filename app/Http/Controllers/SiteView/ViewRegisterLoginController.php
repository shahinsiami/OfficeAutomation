<?php

namespace App\Http\Controllers\SiteView;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits;
use Illuminate\Support\Facades\Validator;

class ViewRegisterLoginController extends Controller
{
    use Traits\uploadImage;
    use Traits\validatorError;
    //////////////////////////////////////////////////////////////////////  viewRegister
    public function viewRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,name',
            'password' => 'required|string|min:6|',
            'phonenumber' => 'required|min:9|unique:user_infos',
            'name' => 'required|min:3|',
            'family' => 'required|min:3|',
            'email' => 'required|min:5|unique:user_infos',

        ]);
        if ($validator->fails()) {
            return $this->vError($validator->errors());
        }
        $user = User::create([
           'name' => $request->username,
           'password' => $request->password,

        ]);
        $user->userinfo()->create([
            'phonenumber' => $request->phonenumber,
            'name' => $request->name,
            'family' => $request->family,
            'email' => $request->email,
        ]);
        return $this->vSuccess();
    }
    //////////////////////////////////////////////////////////////////////  loginStatus
    public function loginStatus(Request $request)
    {
       if (auth()->user()){
           return 'true';
       }else{
           return 'false';
       }
    }
    //////////////////////////////////////////////////////////////////////  loginStatus
    //////////////////////////////////////////////////////////////////////  userInfo
    public function userInfo(Request $request)
    {
       $userinfo = auth()->user()->userinfo()->first();
       return $userinfo;
    }
    //////////////////////////////////////////////////////////////////////  userInfo
}
