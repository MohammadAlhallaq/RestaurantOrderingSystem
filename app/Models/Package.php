<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'allowed_meals', 'duration', 'cost', 'free_delivery', 'category_id'];

    const validateCode = 'https://main.allin1uae.com/api/marketing-company';

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
