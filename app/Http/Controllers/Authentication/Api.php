<?php

namespace App\Http\Controllers\Authentication;

use function array_push;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ipecompany\Smsirlaravel\Smsirlaravel;
use App\Traits;

class Api extends Controller
{
       use Traits\validatorError;

    /////////////////////////////////////////////////////////////////////////////////////////////////login
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client([
            'timeout' => 50.0,
        ]);
        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => config('services.passport.grant_type'),
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);
            return $response->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() == 400) {
                return response()->json('invalid', $e->getCode());
            } else if ($e->getCode() == 401) {
                return response()->json('invalid', $e->getCode());
            }
            return response()->json('invalid', $e->getCode());
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////login
    /////////////////////////////////////////////////////////////////////////////////////////////////userType
    public function userType($permission)
    {
        if (Gate::allows($permission)) {
            return response()->json('true');
        }
        return response()->json('false');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////userType
    /////////////////////////////////////////////////////////////////////////////////////////////////userMenu
    public function userMenu()
    {
        $permission = auth()->user()->userPermission()->get();
        $menu = array();
        foreach ($permission as $item)
        {
            array_push($menu,$item->name);
        }
        return response()->json($menu);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////userMenu
    /////////////////////////////////////////////////////////////////////////////////////////////////resetpassword
    public function resetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|',
        ]);
        if($request->password != $request->rPassword){
            $errorPassword = (object) [
                'error' => ['مقادیر گذرواژه و تکرار گذرواژه یکسان نیست' ]
            ];
            return $this->vError($errorPassword);
        }
        if ($validator->fails()) {
            return $this->vError($validator->errors());
        }
      if (Hash::check($request->lastPassword ,  auth()->user()->password)){
        auth()->user()->update([
            'password' => bcrypt($request->password),
        ]);
      }else{
        $error = (object) [
            'error' => ['مقدار گذر واژه پیشین صحیح نمیباشد' ]
        ];
          return $this->vError($error);
      }
        return $this->vSuccess();
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////resetpassword
    /////////////////////////////////////////////////////////////////////////////////////////////////logout
    public function logout(Request $request)
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json('logout', 200);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////logout
}
