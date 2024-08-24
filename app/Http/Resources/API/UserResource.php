<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $defaultImage = asset('default/profile.jpeg');
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'image' => $this->getFirstMediaUrl('profile')?:$defaultImage,
            'type'=>$this->type,
            'country'=>CountryResource::make($this->whenLoaded('country'))
        ];
    }
}
