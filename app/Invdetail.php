<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invdetail extends Model
{
    protected $primaryKey = null;
    public $incrementing = false;
    
    public $timestamps = false;
    
    protected $fillable = [
        'invoice_id','product_id','quantity','rate'
    ];
}
