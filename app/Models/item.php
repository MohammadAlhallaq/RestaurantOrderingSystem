<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class item extends Model
{
    use HasFactory;


    protected $table = 'item';

    public function imagePath(){
    return asset('/items/'.$this->id.'/'. $this->photo_url);
}

    public function sub_category(){
        return $this->belongsTo(RestaurantSubCategory::class, 'sub_cat_id');
    }
    public function price(){
        return $this->hasMany(itemPrice::class,'item_id')->select(['id', 'item_id', 'price']);
    }

    public function status(){
        return $this->belongsTo(item_status::class, 'item_status_id');
    }

    public function sub_category_details(){
        $result = DB::table('item')
            ->join('restaurant_sub_category', 'item.sub_cat_id', '=', 'restaurant_sub_category.id')
            ->where('item.id', $this->id)
            ->select('restaurant_sub_category.sub_category_id')
            ->first();

        if ($result){
            return SubCategory::where('id', $result->sub_category_id)->first();
        }
    }

    public function components(){
        return $this->belongsToMany(components::class, 'item_component', 'item_id', 'component_id');
    }
}
