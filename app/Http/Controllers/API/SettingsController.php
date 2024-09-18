<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\API\SettingResource;

class SettingsController extends Controller
{
    protected function isJson($string): bool
    {
        if (!is_string($string)) {
            return false;
        }

        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
    public function index(): JsonResponse
    {
        $settings = Setting::select('key','value')->get();
        $data = [];
        foreach($settings as $setting){
            
            $fileInputKeys = ['logo', 'favicon', 'hero_image']; 
            $defaultImage = asset('default/profile.jpeg');
            if (in_array($setting->key, $fileInputKeys)) {
                $data[$setting->key] =  $setting->value ? asset('storage/' . $setting->value) : $defaultImage;
            } elseif ($this->isJson($setting->value)) {
                $data[$setting->key] =  json_decode($setting->value, true);
            } else {
                $data[$setting->key] =  $setting->value;
            }
        }
        return response()->json($data);
    }
}
