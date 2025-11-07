<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
  'name', 'price' ,'allowed_days','allowed_properties','allowed_featured_properties',
  'allowed_photos','allowed_videos'
    ];

    public function order(){
        return $this->hasMany(Order::class);
    }
}
