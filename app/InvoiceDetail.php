<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $primaryKey = 'in_details';
    
    protected $table = 'invoice_details';

    public function accounts()
    {
        return $this->belongsTo('App\Account','account','ac_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product','product_id','product_id');
    }
}
