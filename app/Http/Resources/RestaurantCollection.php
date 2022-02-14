<?php

namespace App\Http\Resources;

use App\Models\Account;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RestaurantCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'restaurants' => $this->collection,
            'restaurants_total_count' =>
                request('res_name') ? $this->collection->count() :
                    Account::where('account_type_id', 2)
                        ->where('approved', 1)
                        ->where('status_id', 1)
                        ->count(),
        ];
    }
}
