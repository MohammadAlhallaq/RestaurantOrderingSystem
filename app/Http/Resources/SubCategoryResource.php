<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
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
        return [
            'id' => $this->id,
            'sub_category_name' => $language_id == 2 ? $this->sub_category_name_ar : $this->sub_category_name,
            'restaurants' => RestaurantResource::collection($this->whenLoaded('restaurants')),
        ];
    }
}
