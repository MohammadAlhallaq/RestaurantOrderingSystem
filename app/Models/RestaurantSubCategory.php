<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RestaurantSubCategory extends Model
{
    use HasFactory;

    protected $table = 'restaurant_sub_category';

    function get_my_sub_cat($id)
    {
        $query = DB::table('restaurant_sub_category')->where('restaurant_sub_category.restaurant_id', $id)->select('restaurant_sub_category.*')->get();
        return $query;
    }
    function get_my_sub_name($id,$menu_id)
    {
        $query = DB::table('restaurant_sub_category')->join('sub_category','restaurant_sub_category.sub_category_id','sub_category.id')->where('restaurant_sub_category.restaurant_id', $id)->where('restaurant_sub_category.id',$menu_id)->get();
//        dd ($query);
        return $query;
    }
    function sub_category_name(){
        return $this->belongsTo(SubCategory::class,'sub_category_id')->select('id', 'sub_category_name', 'sub_category_name_ar', 'main_photo');
    }
    function items(){
        return $this->hasMany(item::class,'sub_cat_id');
    }
}
