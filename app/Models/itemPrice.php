<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itemPrice extends Model
{
    protected $table = 'item_price_currency';

    public function item(){
        return $this->belongsTo(item::class,'item_id');
    }

    public function accountCurrency(){
        return $this->belongsTo(AccountCurrency::class, 'acc_currency_id')->select(['id', 'currency_id']);
    }


}
