<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $table = 'customer_address';

    protected $fillable = ['customer_id', 'address', 'latitude', 'longitude', 'address_main_id'];

    protected $visible = ['id', 'address', 'latitude', 'longitude'];

}
