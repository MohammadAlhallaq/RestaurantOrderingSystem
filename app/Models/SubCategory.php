<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_category';

    public function imagePath(){
        return asset('/sub_cat_main/'.$this->id.'/'. $this->main_photo);
    }

    function get_sub_cat_name($id)
    {
        $query = DB::table('sub_category')->where('sub_category.id', $id)->select('sub_category.*')->get();
        return $query;
    }
    function items(){
        return $this->hasMany(item::class,'sub_cat_id');
    }

    function restaurants(){
        return $this->belongsToMany(Account::class,'restaurant_sub_category', 'sub_category_id', 'restaurant_id');
    }

    function parent(){
        return $this->belongsTo(ParentSubCategory::class, 'parent_cat_id');
    }
}
