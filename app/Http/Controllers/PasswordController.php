<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class PasswordController
 *
 * @package App\Http\Controllers
 */
class PasswordController extends Controller
{
    /**
     * PasswordController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function password()
    {
        return view('users.password');
    }

    /**
     * @param \App\Http\Requests\ChangePasswordRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ChangePasswordRequest $request)
    {
        if(Hash::check($request->get('old_password'),user()->password)){
            user()->password = bcrypt($request->get('password'));
            user()->save();
            flash('密码修改成功','success');
            return back();
        }
        flash('密码修改失败','danger');
        return back();
    }
}
