<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Overtrue\LaravelSendCloud\SendCloud;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','confirmation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 重写重置密码发送邮件
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $result = SendCloud::post('/mail/send', [
            'from' => 'Knowledge@gmail.com',
            'to' => $this->email,
            'subject' => '密码重置',
            'html' => '<h3>HELLO  '.$this->name.'</h3><br>'.
                      '<p><a href="'.url(config('app.url').route('password.reset', $token, false)).'">点击去设置新密码</a></p>'
        ]);
    }

    public function owns(Model $model)
    {
       return $this->id == $model->user_id;
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
