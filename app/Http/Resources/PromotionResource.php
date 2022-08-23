<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'prerequisite_items' => PromotionPrerequisiteItemsResource::collection($this->prerequisite_items),
            'reward_items' => PromotionRewardItemsResource::collection($this->reward_items),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
