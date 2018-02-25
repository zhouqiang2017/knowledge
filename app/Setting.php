<?php

namespace App;

/**
 * Class Setting
 *
 * @package \App
 */
/**
 * Class Setting
 *
 * @package App
 */
class Setting
{
    /**
     * @var \App\User
     */
    protected $user;
    /**
     * @var array
     */
    protected $allowed = ['city','bio'];

    /**
     * Setting constructor.
     *
     * @param \App\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param array $attributes
     *
     * @return bool
     */
    public function merge(array $attributes)
    {
        $settings = array_merge($this->user->settings,array_only($attributes,$this->allowed));
        return $this->user->update(['settings'=>$settings]);
    }
}
