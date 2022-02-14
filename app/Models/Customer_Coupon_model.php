<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Coupon_model extends Model
{
    use HasFactory;
    protected $table = 'customer_coupon';
    public $timestamps = false;
}
