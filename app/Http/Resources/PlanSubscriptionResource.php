<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanSubscriptionResource extends JsonResource
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
            'started_at' => $this->started_at,
            'expires_at' => $this->expires_at,
            'active' => $this->active,
            'remaining_days' => Carbon::parse($this->expires_at)->diffInDays(now()),
            'product' => (new ProductResource($this))->toArray(request()),
            'payments' => $this->payments->toArray(request()),
        ];
    }
}
