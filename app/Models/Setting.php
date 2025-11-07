<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable =[
        'logo','favicon','banner','assistance_number','consultation_number','footer_address',
        'footer_email','phone_number','facebook','tweeter','instagram','linkedin','copyright',
    ];
}
