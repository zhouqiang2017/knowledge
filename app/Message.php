<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 *
 * @package App
 */
class Message extends Model
{
    /**
     * @var string
     */
    protected $table = 'messages';
    /**
     * @var array
     */
    protected $fillable = ['from_user_id','to_user_id','body','dialog_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fromUser()
    {
        return $this->belongsTo(User::class,'from_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function toUser()
    {
        return $this->belongsTo(User::class,'to_user_id');
    }

    /**
     * 标为已读
     */
    public function markAsRead()
    {
        if(is_null($this->read_at)) {
            $this->forceFill(['has_read' => 'T','read_at' => $this->freshTimestamp()])->save();
        }
    }

    public function read()
    {
        return $this->has_read === 'T';
    }
    public function unread()
    {
        return $this->has_read === 'F';
    }
    public function shouldAddUnreadClass()
    {
        if(user()->id === $this->from_user_id){
            return false;
        }
        return $this->unread();
    }
    /**
     * @param array $models
     * @return MessageCollection
     */
    public function newCollection(array $models = [])
    {
        return new MessageCollection($models);
    }
}
