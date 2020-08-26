<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['account_id', 'amount', 'date', 'description'];

    protected $casts = ['date'];
}
