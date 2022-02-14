<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinPriceModel extends Model
{
    use HasFactory;

    protected $table='min_price_currency';

    protected $guarded = [];
}
