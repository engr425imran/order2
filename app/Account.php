<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    protected $table = "account";

    function budgets(){
        return $this->hasMany(Budget::class, 'account_id', 'ac_id');
    }
}
