<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\API\SettingResource;

class SettingsController extends Controller
{
    public function index(): JsonResponse
    {
        $settings = Setting::select('key','value')->get();
        return response()->json(SettingResource::collection($settings));
    }
}
