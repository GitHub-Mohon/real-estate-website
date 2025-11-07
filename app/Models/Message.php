<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id','agent_id','subject','message_body','file',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function agent(){
        return $this->belongsTo(Agent::class,'agent_id');
    }

    public function conversation(){
        return $this->hasMany(Conversation::class,'message_id');
    }
}
