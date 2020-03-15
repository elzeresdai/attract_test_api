<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
   public function sendMessage()
   {
       return $this->belongsToMany('App\User','income_messages','messages_id','user_id')
           ->withPivot('to_user_id');
   }
}
