<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $reviews_limit = $request->get('reviews_limit') != null ? $request->get('reviews_limit') : 5;
        $best_seller_limit = $request->get('best_seller_limit') != null ? $request->get('best_seller_limit') : 5;
        $language_id = $request->get('language_id') != null ? $request->get('language_id') : 1;
        $currency_id = $request->get('currency_id') != null ? $request->get('currency_id') : 1;

        return [
            'id' => $this->id,
            'account_name' => $this->account_name,
            'slug_name' => str_slug($this->account_name),
            'logo' => $this->logoPath(),
            'description' => $this->description,
            'minimum_price' => $this->minPrice->first() ? $this->minPrice->first()->min_price : 0,
            'category' => $language_id == 2 ? $this->whenLoaded('category')->category_name_ar : $this->whenLoaded('category')->category_name,
            'rate' => round($this->total_rate() * 2) / 2,
            'total_rates_count' => $this->rates()->count(),
            'text_rate' => $this->text_rate($language_id),
            'total_reviews_count' => $this->reviews->count(),
            'reviews' => ReviewResource::collection(
                $this->reviews()
                    ->take($reviews_limit)
                    ->get()),
            'sub_categories' => SubCategoryResource::collection($this->whenLoaded('sub_category')),
            'address' => AddressResource::make($this->address),
            'best_sellers' => ItemResource::collection($this->best_seller($best_seller_limit, $currency_id))
        ];
    }
}
