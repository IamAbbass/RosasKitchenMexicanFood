<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {
        return $this->hasOne('\App\Models\Role','id','role_id');
    }

    public function business() {
        return $this->hasOne('\App\Models\Business','id','business_id');
    }

    public function customer(){
        return $this->hasOne('\App\Models\Customer','id','customer_id');
    }

    public function orders(){
        return $this->hasMany('\App\Models\Order','customer_id','id');
    }

    public function last_activity(){
        return $this->hasOne('\App\Models\Activity','api_token','api_token')->latest(); //lat lon
    }

    public function activity(){
        return $this->hasMany('\App\Models\Activity','api_token','api_token'); //total apis
    }

    public function last_order(){
        return $this->hasOne('\App\Models\Order','customer_id','id')->latest(); //name
    }
}
