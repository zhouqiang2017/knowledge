<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Cache;
use Overtrue\LaravelSocialite\Socialite;

/**
 * Class SocialController
 *
 * @package App\Http\Controllers
 */
class SocialController extends Controller
{
    /**
     * @var \App\Repositories\UserRepository
     */
    protected $user;

    /**
     * SocialController constructor.
     *
     * @param \App\Repositories\UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param $driver
     *
     * @return mixed
     */
    public function index($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    /**
     * @param $driver
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callback($driver)
    {
        $githubUser = Socialite::driver($driver)->user();

        if(! $user = $this->user->getUserByEmail($githubUser->getEmail())) {

            $user = $this->user->createUser([
                'name' => $githubUser->getNickname(),
                'email' => $githubUser->getEmail(),
                'avatar' => $githubUser->getAvatar(),
                'password' => bcrypt(str_random(16)),
            ]);
        }
        Auth::login($user);
        return redirect(Cache::get('fromUri'));

    }
}
