<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplyConversation extends Model
{
    protected $fillable = [
        'user_id','agent_id','message_id','reply_conversation_body','reply_conversation_file',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function agent(){
        return $this->belongsTo(Agent::class,'agent_id');
    }
    public function message(){
        return $this->belongsTo(Message::class,'message_id');
    }
}
