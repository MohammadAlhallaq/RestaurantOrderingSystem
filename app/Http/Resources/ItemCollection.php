<?php

namespace App\Http\Resources;

use App\Models\item;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemCollection extends ResourceCollection
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
            'items' => $this->collection,
            'items_count' => request('item_name') ?
                $this->collection->count():
                item::where('restaurant_id', $restaurant_id)->count(),
        ];
    }
}
