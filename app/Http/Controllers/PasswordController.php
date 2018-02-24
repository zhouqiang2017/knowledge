<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function password()
    {
        return view('users.password');
    }
    public function update(ChangePasswordRequest $request)
    {
        if(Hash::check($request->ger('old_password',user()->password))){
            user()->password = $request->get('password');
            user()->save();
            flush('密码修改成功','success');
            return back();
        }
        flush('密码修改失败','danger');
        return back();
    }
}
