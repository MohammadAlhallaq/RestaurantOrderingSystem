<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment_model extends Model
{
    use HasFactory;
    protected $table = 'comments';
    public $timestamps = false;

    public function source(){
        return $this->belongsTo(Customer::class, 'source_id');
    }
}
