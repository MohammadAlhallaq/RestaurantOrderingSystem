<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountCurrency extends Model
{
    use HasFactory;

    protected $table = 'account_currency';

    public function Currency(){
        return $this->belongsTo(Currency::class, 'currency_id')->select(['id', 'currency_name']);
    }
}
