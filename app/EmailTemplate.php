<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    //table name

    protected $table = 'email_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','subject', 'sender', 'body', 'attach_invoice', 'embed_invoice', 'word_template'
    ];


}
