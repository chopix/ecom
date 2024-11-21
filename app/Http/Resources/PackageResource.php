<?php

namespace App\Http\Resources;

use App\Models\Tool;
use App\Models\Currency;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $toolIds = json_decode($this->productable->tools_included?? '', true);
        $tools = Tool::where('is_active', true)->findMany($toolIds);
        
        $price = $this->productable->price;
        $currencySymbol = '$';

        $currency = session('user_currency');

        if($currency && $currency->is_default) {
            $multiPrice = $this->productable->prices->firstWhere('country_code', session('user_currency')->currency);

            if($multiPrice && $multiPrice->price) {
                $price = $multiPrice->price;
                $currencySymbol = Currency::where('currency', session('user_currency')->currency)->first()->symbol;    
            }
        }

        return [
            'id' => $this->productable->id,
            'product_id' => $this->id,
            'title' => $this->productable->title,
            'price' => $price,
            'currency_symbol' => $currencySymbol,
            'description' => $this->productable->description,
            'tools_included' => $tools,
        ];
    }
}
