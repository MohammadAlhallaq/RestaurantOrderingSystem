<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart_item_model extends Model
{
    use HasFactory;
    protected $table = 'cart_items';
    public $timestamps = false;

}
