<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'agent_id','location_id','type_id','amenities','name','slug','description','price','featured_photo','purpose','bedroom','bathroom','size','floor','balcony','garage','address','built_year',
        'map','is_featured','status',
    ];

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }
    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function photo(){
        return $this->hasMany(PropertyGallery::class);
    }
    public function video(){
        return $this->hasMany(PropertyVideo::class);
    }
    public function wishlist(){
        return $this->hasOne(Wishlist::class);
    }
}
