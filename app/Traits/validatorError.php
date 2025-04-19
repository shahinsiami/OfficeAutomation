<?php
/**
 * Created by PhpStorm.
 * User: hemami
 * Date: 12/17/2019
 * Time: 11:38 AM
 */

namespace App\Traits;


trait validatorError
{
    public function vError($value)
    {
        return response()->json([
            'type' => 'error',
            'title' => 'عملیات به درستی انجام نشد',
            'text' => $value
        ]);
    }
    public function vSuccess()
    {
        return response()->json([
            'type' => 'success',
            'title' => 'عملیات با موفقیت انجام شد',
            'text' => ' ',
            'status' => 555
        ]);
    }

}
