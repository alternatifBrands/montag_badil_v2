<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CountriesSeeder::class,
            // StateSeeder::class,
            // CitySeeder::class,
            // UserSeeder::class,
            // BrandSeeder::class,
            // BrandAlternativeSeeder::class,
        ]);
    }
}
