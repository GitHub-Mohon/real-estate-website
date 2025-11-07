<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name','slug',
    ];

    public function property(){
        return $this->hasMany(Property::class);
    }
}
