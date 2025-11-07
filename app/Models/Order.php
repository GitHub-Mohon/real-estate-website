<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'agent_id','package_id','invoice_no','transaction_id', 'payment_method','paid_amount','purchase_date','expire_date','status','currently_active',
    ];

    public function agent(){
        return $this->belongsTo(Agent::class,'agent_id');
    }
    public function package(){
        return $this->belongsTo(Package::class,'package_id');
    }
}
