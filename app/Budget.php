<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    //
    protected $table = 'budget';
    protected $fillable = ['account_id','name','occurs','date','type','value'];
    
    function account(){
        return $this->belongsTo(Account::class, 'account_id', 'ac_id');
    }
}
