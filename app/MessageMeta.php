<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageMeta extends Model
{
    //
    protected $fillable = ['message_id', 'meta_key', 'meta_value'];
    protected $table = 'messagemeta';

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
