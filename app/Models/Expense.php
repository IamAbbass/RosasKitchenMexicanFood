<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function head() {
        return $this->hasOne('\App\Models\Head','id','head_id');
    }

    public function account() {
        return $this->hasOne('\App\Models\Account','id','account_id');
    }
}
