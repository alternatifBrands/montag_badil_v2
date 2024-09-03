<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(): JsonResponse
    {
        $settings = Setting::all()->pluck('value', 'key');
        $settings['social_media_links'] = json_decode($settings['social_media_links']);
        $settings['app_links'] = json_decode($settings['app_links']);
        return response()->json($settings);
    }
}
