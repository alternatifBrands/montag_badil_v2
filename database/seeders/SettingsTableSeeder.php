<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'logo', 'value' => 'path/to/logo.png'],
            ['key' => 'favicon', 'value' => 'path/to/favicon.ico'],
            ['key' => 'social_media_links', 'value' => json_encode([
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com'
            ])],
            ['key' => 'app_links', 'value' => json_encode([
                'android' => 'https://play.google.com',
                'ios' => 'https://apple.com'
            ])],
            ['key' => 'phone', 'value' => '+123456789'],
            ['key' => 'email', 'value' => 'example@example.com'],
            ['key' => 'address', 'value' => '123 Main St, City, Country'],
            ['key' => 'terms_and_conditions', 'value' => 'Terms and conditions content here...'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
