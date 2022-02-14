<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_steps_model extends Model
{
    use HasFactory;

    protected $table = 'order_steps_log';
    public $timestamps = false;
}
