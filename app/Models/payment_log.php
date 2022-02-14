<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment_log extends Model
{
    use HasFactory;
    protected  $table='payment_log';
    public $timestamps = false;
}
