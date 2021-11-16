<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = ['title', 'content'];

    public function messagemeta() {
        return $this->hasMany('App\MessageMeta');
    }
}
