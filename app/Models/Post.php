<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title','slug','featured_photo','summary','description','sub_title','sub_summary','photo','tags','create_by','view_count',
    ];

    public function comment(){
        return $this->hasMany(Comment::class);
    }
    public function reply_comment(){
        return $this->hasMany(ReplyComment::class);
    }

}
