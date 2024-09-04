<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'capital' => $this->capital,
            'citizenship' => $this->citizenship,
            'country_code' => $this->country_code,
            'currency' => $this->currency,
            'currency_code' => $this->currency_code,
            'currency_sub_unit' => $this->currency_sub_unit,
            'currency_symbol' => $this->currency_symbol,
            'currency_decimals' => $this->currency_decimals,
            'full_name' => $this->full_name,
            'iso_3166_2' => $this->iso_3166_2,
            'iso_3166_3' => $this->iso_3166_3,
            'name' => $this->name,
            'region_code' => $this->region_code,
            'sub_region_code' => $this->sub_region_code,
            'eea' => $this->eea,
            'calling_code' => $this->calling_code,
            'flag' => asset('assets/flags/'.$this->flag),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
