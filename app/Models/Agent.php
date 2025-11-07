<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Agent extends Authenticatable
{



    protected $fillable = [
        'name',
        'email',
        'photo',
        'password',
        'company',
        'designation',
        'biography',
        'short_biography',
        'phone',
        'address',
        'country',
        'state',
        'city',
        'zip',
        'website',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'whatsapp',
        'token',
        'status'
    ];

    public function order(){
        return $this->hasMany(Order::class);
    }
    public function property(){
        return $this->hasMany(Property::class);
    }

    public function message(){
        return $this->hasMany(Message::class);
    }

    public function conversation(){
        return $this->hasMany(Conversation::class,'agent_id');
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }
    public function reply_comment(){
        return $this->hasMany(ReplyComment::class);
    }
}
