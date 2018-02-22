<?php

namespace App\Repositories;
use App\Message;

/**
 * Class MessageRepository
 *
 * @package \App\Repositories
 */
class MessageRepository
{
    public function create(array $attributes)
    {
        return Message::firstOrCreate($attributes);
    }

}
