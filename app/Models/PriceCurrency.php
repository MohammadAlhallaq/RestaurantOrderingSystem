<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceCurrency extends Model
{
    use HasFactory;

    protected $table = 'item_price_currency';

    public function AccountCurrency(){
        return $this->belongsTo(AccountCurrency::class, 'acc_currency_id')->select(['id', 'currency_id']);
    }
}
