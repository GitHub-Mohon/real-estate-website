<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'photo',
        'password',
        'phone',
        'address',
        'country',
        'state',
        'city',
        'zip',
        'token',
        'status'
    ];

    public function wishlist(){
        return $this->hasOne(Wishlist::class);
    }
    public function message(){
        return $this->hasMany(Message::class);
    }

    public function conversation(){
        return $this->hasMany(Conversation::class,'user_id');
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }
    public function reply_comment(){
        return $this->hasMany(ReplyComment::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
