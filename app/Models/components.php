<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class components extends Model
{
    use HasFactory;

    protected $table = 'component';

    function prices(){
        return $this->hasMany(component_price::class, 'component_id');
    }

}
