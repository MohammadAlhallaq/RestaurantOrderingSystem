<?php

namespace App\Http\Resources;

use App\Models\Comment_model;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReviewCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $restaurant_id = $request->get('restaurant_id');
        return [
            'reviews' => $this->collection,
            'reviews_count' => Comment_model::where('destination_id', $restaurant_id)->count()
        ];
    }
}
