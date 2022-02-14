<?php

namespace App\Http\Resources;

use App\Models\Account;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RestaurantSearchCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $language_id = $request->get('language_id') != null ? $request->get('language_id') : 1;

        return [
            'restaurants' => RestaurantResource::collection($this->collection['restaurants']),
            'filters' => [
                'all_sub_categories' => SubCategoryResource::collection(SubCategory::orderBy($language_id == 2 ? 'sub_category_name_ar' : 'sub_category_name')->get()),
                'all_categories' => CategoryResource::collection(Category::orderBy($language_id == 2 ? 'category_name_ar' : 'category_name')->get()),
                'order_by' => [
                    'Recommended' => 1,
                    'Ratings' => 2,
                    'Newest' => 3,
                    'A_to_Z' => 4,
                    'min_price' => 5
                ],
            ],
            'restaurants_total_count' => $this->collection['count'],
        ];
    }
}
