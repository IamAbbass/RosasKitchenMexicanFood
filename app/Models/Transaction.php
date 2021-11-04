<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function business() {
        return $this->hasOne('\App\Models\business','id','business_id');
    }

    public function user() {
        return $this->hasOne('\App\Models\user','id','record_by');
    }

}
