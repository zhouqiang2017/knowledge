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
    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        return Message::firstOrCreate($attributes);
    }

    /**
     * @return mixed
     */
    public function getAllMessages()
    {
        return Message::where('to_user_id', user()->id)
            ->orWhere('from_user_id', user()->id)
            ->with(['fromUser' => function ($query) {
                return $query->select(['id', 'name', 'avatar']);
            }, 'toUser' => function ($query) {
                return $query->select(['id', 'name', 'avatar']);
            }])->latest()->get();
    }

    /**
     * @param $dialogId
     *
     * @return mixed
     */
    public function getDialogMessages($dialogId)
    {
        return Message::where('dialog_id', $dialogId)->with(['fromUser' => function ($query) {
            return $query->select(['id', 'name', 'avatar']);
        }, 'toUser' => function ($query) {
            return $query->select(['id', 'name', 'avatar']);
        }])->latest()->get();
    }

    /**
     * @param $dialogId
     *
     * @return mixed
     */
    public function getSingleDialogMessages($dialogId)
    {
        return Message::where('dialog_id', $dialogId)->first();
    }

}
