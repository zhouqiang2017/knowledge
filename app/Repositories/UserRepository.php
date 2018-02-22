<?php

namespace App\Repositories;
use App\User;

/**
 * Class UserRepository
 *
 * @package \App\Repositories
 */
class UserRepository
{
   public function getUserById($id)
   {
       return User::findOrFail($id);
   }
}
