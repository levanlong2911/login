<?php

namespace App\Http\Form;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ValidateFormResetPass
{
    /**
     * validate
     *
     * @param \Illuminate\Http\Request $request
     */
  
    public function validate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|max:20|confirmed',
            'password_confirmation' => 'required'
        ],[
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập email đúng định dạng',
            'email.exists' => 'Email không tồn tại',
            'password.required' => 'Vui lòng nhập password',
            'password.min' => 'Vui lòng nhập password ít nhất 8 ký tự',
            'password.max' => 'Vui lòng nhập password nhiều nhất 20 ký tự',
            'password.confirmed' => 'Mật khẩu không khớp',
            'password_confirmation.required' => 'Vui lòng nhập lại password',
        ]);
       
        return $validator->validate();
    }
}