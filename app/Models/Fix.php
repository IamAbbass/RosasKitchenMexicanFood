<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fix extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function account() {
        return $this->hasOne('\App\Models\Account','id','account_id');
    }
}
