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
        'name', 'email', 'password','avatar','confirmation_token','api_token'
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

    public function follows ()
    {
        return $this->belongsToMany(Question::class, 'user_question')->withTimestamps();
    }

    public function followThis($question)
    {
        return $this->follows()->toggle($question);
    }
    public function followed($question)
    {
        return !! $this->follows()->where('question_id', $question)->count();
    }

    public function followers()
    {
        return $this->belongsToMany(self::class,'followers','follower_id','followed_id')->withTimestamps();
    }

    public function followersUser()
    {
        return $this->belongsToMany(self::class,'followers','followed_id','follower_id')->withTimestamps();
    }

    public function followThisUser($user)
    {
        return $this->followers()->toggle($user);

    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function votes()
    {
        return $this->belongsToMany(Answer::class, 'votes')->withTimestamps();
    }
    public function voteFor($answer)
    {
        return $this->votes()->toggle($answer);
    }
    public function hasVotedFor($answer)
    {
        return !! $this->votes()->where('answer_id',$answer)->count();
    }
    public function messages()
    {
        return $this->hasMany(Message::class,'to_user_id');
    }
}
