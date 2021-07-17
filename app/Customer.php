<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'cust_id';

    public function company_info()
    {
        return $this->belongsTo('App\Company','user_id','user_id');
    }
}
