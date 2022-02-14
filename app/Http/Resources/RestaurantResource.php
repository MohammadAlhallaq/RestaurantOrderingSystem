<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            'account_name' => $this->account_name,
            'slug_name' => str_slug($this->account_name),
            'logo' => $this->logoPath(),
            'description' => $this->description,
            'text_rate' => rate_converter($this->total_rate(), $language_id),
            'rate' => round($this->total_rate() * 2) / 2,
            'phone_number' => $this->phone_number,
            'created_at' => Carbon::parse($this->created_at)->format('M d Y'),
            'sub_categories' => SubCategoryResource::collection($this->whenLoaded('sub_category')),

        ];
    }
}
