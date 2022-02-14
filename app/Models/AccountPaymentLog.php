<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPaymentLog extends Model
{
    use HasFactory;

    protected $table = 'accounts_payment_log';

    protected $fillable = ['account_id', 'orderNo', 'status', 'done', 'done_date', 'code_id', 'amount'];

    function account(){
        return $this->belongsTo(Account::class);
    }
}
