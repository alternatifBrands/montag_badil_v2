<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $fileInputKeys = ['logo', 'favicon', 'hero_image']; // Keys expected to be file uploads
        $defaultImage = asset('default/profile.jpeg'); // Default image

        if (in_array($this->key, $fileInputKeys)) {
            // Handle file upload values
            return [$this->key => $this->value ? asset('storage/' . $this->value) : $defaultImage];
        } elseif ($this->isJson($this->value)) {
            // Handle JSON-encoded values
            return [$this->key => json_decode($this->value, true)];
        } else {
            // Handle plain string values
            return [$this->key => $this->value];
        }
    }

    /**
     * Check if a string is JSON-encoded.
     *
     * @param mixed $string
     * @return bool
     */
    protected function isJson($string): bool
    {
        if (!is_string($string)) {
            return false;
        }

        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
