<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $primaryKey = 'invoice_id';
    
    protected $table = 'invoices';
    
    public function detail()
    {
        return $this->belongsTo('App\Invoice','invoice_id','invoice_id');
    }

    public function invoice_items()
    {
        return $this->hasMany('App\InvoiceDetail','invoice_id','invoice_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer','cust_id','cust_id');
    }
}
