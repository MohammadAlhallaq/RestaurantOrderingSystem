<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantMenuDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $language_id = $request->get('language_id') != null ? $request->get('language_id') : 1;
        $reviews_limit = $request->get('reviews_limit') != null ? $request->get('reviews_limit') : 5;
        return [
            'name' => $this->account_name,
            'slug_name' => str_slug($this->account_name),
            'logo' => $this->logoPath(),
            'working_status' => [
                'status_id' => $this->work_status->id,
                'status_desc' => $language_id == 2 ? $this->work_status->status_name_ar : $this->work_status->status_name_en,
            ],
            'minimum_price' => $this->minPrice->first() ? $this->minPrice->first()->min_price : 0,
            'location' => $this->address->area->city->city_name,
            'working_hours' => $this->get_working_hours(),
            'text_rate' => rate_converter($this->total_rate(), $language_id),
            'rate' => round($this->total_rate() * 2) / 2,
            'total_reviews_count' => $this->reviews()->count(),
            'reviews' => ReviewResource::collection(
                $this->reviews()->with('source')
                    ->take($reviews_limit)
                    ->get()),
            'all_text_rate' => $this->text_rate($language_id),
            'sub_categories' => SubCategoryResource::collection($this->sub_category),
            'sub_category_items' => SubCategoryPivotResource::collection($this->sub_category_pivot),
        ];
    }
}
