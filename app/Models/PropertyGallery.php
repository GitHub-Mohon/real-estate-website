<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyGallery extends Model
{
    protected $fillable = [
        'property_id','photo'
    ];

    public function property(){
        return $this->belongsTo(Property::class);
    }
}
