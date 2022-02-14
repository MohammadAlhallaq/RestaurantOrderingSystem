<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
        return [
            'id' => $this->id,
            'name' => $language_id == 2 ? $this->item_name_ar : $this->item_name_en,
            'description' => $language_id == 2 ? $this->description_ar : $this->description_en,
            'image' => $this->imagePath(),
            'sub_category_name' => $language_id == 2 ? $this->sub_category->sub_category_name->sub_category_name_ar : $this->sub_category->sub_category_name->sub_category_name,
            'status'=> [
                'status_id' => $this->status->id,
                'status_desc' => $language_id == 2 ? $this->status->status_name_ar : $this->status->status_name_en,

            ],
            'price' => $this->whenLoaded('price')->first() ? $this->whenLoaded('price')->first()->price :'-'
        ];
    }
}
