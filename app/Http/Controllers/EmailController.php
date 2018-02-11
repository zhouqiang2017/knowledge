<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    /**
     * @param $token
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verify($token)
    {
        $user = User::where('confirmation_token', $token)->first();
        if (is_null($user)) {
            //如果没有改数据就是伪造的数据
            flash('邮箱未激活！','danger');
            return redirect('/');
        }
        // 重置comfirmation_token 确保
        $user->confirmation_token = str_random(40);
        $user->is_active = 1;
        $user->save();
        Auth::login($user);
        flash('欢迎回来！','success');
        return redirect('/home');

    }
}
