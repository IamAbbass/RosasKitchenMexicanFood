<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category() {
        return $this->hasOne('\App\Models\Category','id','category_id');
    }

    public function unit() {
        return $this->hasOne('\App\Models\Unit','id','unit_id');
    }

    public function supplier() {
        return $this->hasOne('\App\Models\Supplier','id','supplier_id');
    }

    public function account() {
        return $this->hasOne('\App\Models\Account','id','account_id');
    }

    public function badge() {
        return $this->hasOne('\App\Models\Badge','id','badge_id');
    }

    public function user(){
        return $this->hasOne('\App\Models\User','id','record_by');
    }
}
