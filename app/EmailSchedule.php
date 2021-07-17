<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailSchedule extends Model
{
    //
    protected $table = 'email_schedules';

    protected $fillable = [
        'template_id','invoice_id', 'days', 'condition'
    ];

    public function template()
    {
        return $this->hasMany('App\EmailTemplate','id','template_id');
    }
}
