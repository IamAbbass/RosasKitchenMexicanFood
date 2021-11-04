<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->hasOne('\App\Models\User','customer_id','id');
    }

    public function orders(){
        return $this->hasMany('\App\Models\Order','customer_id','id');
    }

    public function business() {
        return $this->hasOne('\App\Models\Business','id','business_id');
    }

}
