<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'brand_name'=>$this->name,
            'brand_founder'=>$this->founder,
            'brand_owner'=>$this->owner,
            'brand_year_founderd'=>$this->year,
            'brand_website_url'=>$this->url,
            'brand_description'=>$this->description,
            'brand_parent_company'=>$this->parent_company,
            'brand_industry'=>$this->industry,
            'brand_additional_notes'=>$this->notes,
            'isAlternative'=>$this->is_alternative,
            'brand_barcode'=>$this->barcode,
            'status'=>$this->status,
            'locations'=>CountryResource::collection($this->whenLoaded('locations')),
            "brand_logo" => Storage::disk('public')->url($this->image),
            'user'=>UserResource::make($this->whenLoaded('user')),
            'brand_origin_country'=>CountryResource::make($this->whenLoaded('country')),
            'city'=>CityResource::make($this->whenLoaded('city')),
            'category'=>CategoryResource::make($this->whenLoaded('category')),
            'brandAlternatives'=>BrandAlternativeResource::collection($this->whenLoaded('brandAlternatives')),
            'meta_title' => $this->meta_title ,
            'meta_description' => $this->meta_description ,
            'keywords' => $this->keywords ? explode(',',$this->keywords) : '' ,
            'canonicalUrl' => $this->canonicalUrl ,
            'slug' => $this->slug ,
        ];
    }
}
