<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class component_price extends Model
{
    use HasFactory;
    protected $table = 'component_price_currency';
    public $timestamps = false;

}
