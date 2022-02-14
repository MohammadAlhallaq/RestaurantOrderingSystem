<?php

namespace App\Http\Resources;

use App\Models\Article;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'title' =>  $language_id == 2 ? $this->title_ar : $this->title ,
            'description' => $language_id == 2 ? $this->description_ar : $this->description,
            'image' => $this->imagePath(),
            'sub_category' => new SubCategoryResource($this->sub_category),
        ];
    }
}
