<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Ipecompany\Smsirlaravel\Smsirlaravel;

use App\Traits;
class AuthController extends Controller
{
    use Traits\validatorError;

/////////////////////////////////////////////////////////////////////////////////////////////////register
    public function register(Request $request)
    {
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
            'image' => 'img/client/icon/avatar.png'
        ]);


//        Smsirlaravel::sendVerification($randomnumber, $user->phonenumber);
        return $this->vSuccess();
    }
/////////////////////////////////////////////////////////////////////////////////////////////////register

/////////////////////////////////////////////////////////////////////////////////////////////////activeUser
    public function activeuser(Request $request)
    {
        if (Auth::check()) {
            if (auth()->user()->status == 1) {
                return response()->json('true');
            } else {
                return response()->json('false');
            }
        } else {
            return response()->json('false');
        }
    }
/////////////////////////////////////////////////////////////////////////////////////////////////activeUser
/////////////////////////////////////////////////////////////////////////////////////////////////activation
    public function activation(Request $request)
    {
        if (Auth::check()) {
            if (auth()->user()->statuscode()->first()->statuscode == $request->code) {
                $user = User::find(Auth::user()->id);
                $user->update(array('status' => 1));
                return response()->json([
                    'type' => 'success',
                    'title' => 'نام کاربری شما با موفقیت فعال شد',
                    'text' => 'از این پس می توانید از تمامی امکانات سایت استفاده نمایید',
                    'status' => '1'
                ]);
            } else {
                return response()->json([
                    'type' => 'error',
                    'title' => 'نام کاربری شما فعال نشد',
                    'text' => 'لطفا کد صحیح وارد کنید'
                ]);
            }
        } else {
            return response()->json([
                'type' => 'error',
                'title' => 'نام کاربری شما با فعال نشد',
                'text' => 'لطفا کد صحیح وارد کنید'
            ]);

        }
    }
/////////////////////////////////////////////////////////////////////////////////////////////////activation
/////////////////////////////////////////////////////////////////////////////////////////////////sms
    public function sendsms(Request $request)
    {
        if (Auth::check()) {
            $renewstatuscod = mt_rand(10000, 99999);
            $user = User::find(Auth::user()->id);
            $user->statuscode()->update(array('statuscode' => $renewstatuscod));
            Smsirlaravel::sendVerification($renewstatuscod, $user->phonenumber);
            return response()->json([
                'type' => 'success',
                'title' => 'کد با موفقیت ارسال شد',
                'text' => 'لطفا کد ارسالی را وارد کنید'
            ]);

        } else {
            return response()->json([
                'type' => 'error',
                'title' => 'نام کاربری شما با فعال نشد',
                'text' => 'پیامک ارسال نشد'
            ]);

        }
    }
/////////////////////////////////////////////////////////////////////////////////////////////////sms
/////////////////////////////////////////////////////////////////////////////////////////////////renewpasswordverification
    public function renewpasswordverification(Request $request)
    {
        $user = User::where('phonenumber', $request->phonenumber)->first();
        if ($user) {
            $randomnumber = mt_rand(10000, 99999);
            $user->statuscode()->update([
                'statuscode' => $randomnumber,
            ]);
        Smsirlaravel::sendVerification($randomnumber, $user->phonenumber);
            return response()->json([
                'type' => 'success',
                'title' => 'کد تغییر با موفقیت ارسال شد',
                'text' => 'لطفا برای تغییر کلمه عبور این کد را وارد کنید',
                'status' => 555
            ]);
        } else {
            return response()->json([
                'type' => 'error',
                'title' => 'نام کاربری با این شماره تلفن موجود نیست',
                'text' => 'بازیابی کلمه عبور مقدور نیست'
            ]);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////renewpasswordverification
    /////////////////////////////////////////////////////////////////////////////////////////////////renewpassword
    public function renewpassword(Request $request){
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'password' => 'required|string|min:6|',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'type' => 'error',
                'title' => 'عملیات به درستی انجام نشد',
                'text' => $validator->errors()
            ]);
        }
        $user = User::where('phonenumber',$request->phonenumber)->first();
        if($user){
            $code = $user->statuscode()->first()->statuscode;
            if ($request->code == $code){
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
                return response()->json([
                    'type' => 'success',
                    'title' => 'کلمه عبور با موفقیت تغییر کرد',
                    'text' => 'ازاین پس از کلمه عبور جدید خود استفاده فرمایید',
                    'status'=>555
                ]);
            }
            else{
                return response()->json([
                    'type' => 'error',
                    'title' => 'کد اعتبار سنجی معتبر نیست',
                    'text' => 'لطفا مجددا اقدام به دریافت کنید'
                ]);
            }
        }else{
            return response()->json([
                'type' => 'error',
                'title' => 'نام کاربری با این شماره تلفن موجود نیست',
                'text' => 'بازیابی کلمه عبور مقدور نیست'
            ]);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////renewpassword
}


