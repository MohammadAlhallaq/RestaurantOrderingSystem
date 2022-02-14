<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemDetailsResource extends JsonResource
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
            'component_name' => $language_id == 2 ? $this->component_name_ar : $this->component_name_en,
            'price' => $this->prices->first() ? $this->prices->first()->price : 0,
        ];
    }
}
