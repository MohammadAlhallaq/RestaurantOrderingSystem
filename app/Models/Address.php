<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'address';
    protected $fillable = ['area_id', 'building_num', 'address', 'description', 'latitude', 'longitude', 'account_id'];

    public function area(){
        return $this->belongsTo(Area::class);
    }
}
