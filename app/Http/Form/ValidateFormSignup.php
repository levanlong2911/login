<?php

namespace App\Http\Form;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ValidateFormSignup
{
    /**
     * validate
     *
     * @param \Illuminate\Http\Request $request
     */
  
    public function validate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:6|max:32',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:20|confirmed',
            'password_confirmation' => 'required',
        ],[
            'name.required' => 'Vui lòng nhập họ và tên',
            'name.min' => 'Vui lòng nhập họ và tên ít nhất 6 ký tự',
            'name.max' => 'Vui lòng nhập họ và tên nhiều nhất 32 ký tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập email đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập password',
            'password.min' => 'Vui lòng nhập password ít nhất 8 ký tự',
            'password.max' => 'Vui lòng nhập password nhiều nhất 20 ký tự',
            'password.confirmed' => 'Mật khẩu không khớp',
            'password_confirmation.required' => 'Vui lòng nhập lại password'
        ]);
        return $validator->validate();
    }
}