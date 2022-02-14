<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function store_path(){
        return public_path() . '/restaurants/articles/' . $this->id;
    }

    public function sub_category(){
        return $this->belongsTo(SubCategory::class);
    }

    public function imagePath(){
        return asset('/restaurants/articles/'.$this->id.'/'. $this->image_path);

    }
}
