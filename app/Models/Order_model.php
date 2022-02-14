<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_model extends Model
{
    use HasFactory;

    protected $table = 'orders';
    public $timestamps = false;
}
