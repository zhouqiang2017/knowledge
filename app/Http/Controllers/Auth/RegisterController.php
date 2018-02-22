<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Overtrue\LaravelSendCloud\SendCloud;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'avatar' => '/image/avatars/default.png',
            'confirmation_token' => str_random(40),
            'password' => bcrypt($data['password']),
            'api_token' => str_random(60)
        ]);
        $this->sendVerifyEmailToUser($user);
        return $user;
    }

    /**
     * @param $user
     */
    private function sendVerifyEmailToUser($user)
    {
        $result = SendCloud::post('/mail/send', [
            'from' => 'Jhonny@gmail.com',
            'to' => $user->email,
            'subject' => '注册激活Email',
            'html' => '<h3>HELLO  '.$user->name.'</h3><br>'.
            '<p><a href="'.route('email.verify',['token'=>$user->confirmation_token]).'">点击链接激活账号</a></p>'
        ]);
    }
}
