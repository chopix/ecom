<?php

namespace App\Http\Resources;

use App\Models\Tool;
use App\Models\Package;
use App\Http\Resources\ToolResource;
use App\Http\Resources\PackageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->product->productable_type === Package::class) {
            $product = (new PackageResource($this->product))->toArray(request());
        } else if($this->product->productable_type === Tool::class) {
            $product = (new ToolResource($this->product))->toArray(request());
        }

        return $product;
    }
}
