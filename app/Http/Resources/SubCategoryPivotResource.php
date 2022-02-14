<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryPivotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $language_id = $request->get('language_id') != null ? $request->get('language_id') : 1;
        $sub_category_items_limit = $request->get('sub_category_items_limit') != null ? $request->get('sub_category_items_limit') : 10;
        return [
            'id' => $this->sub_category_name->id,
            'sub_category_name' => $language_id == 2 ? $this->sub_category_name->sub_category_name_ar : $this->sub_category_name->sub_category_name,
            'items' => ItemResource::collection($this->items->take($sub_category_items_limit)),
        ];
    }
}
