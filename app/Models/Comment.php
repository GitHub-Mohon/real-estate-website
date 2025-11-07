<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id','admin_id','user_id','agent_id','name','email','website','comment','react_count',
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function agent(){
        return $this->belongsTo(Agent::class);
    }
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
