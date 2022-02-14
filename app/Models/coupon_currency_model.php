<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coupon_currency_model extends Model
{
    use HasFactory;
    protected $table = 'coupon_currency';
    public $timestamps = false;
}
