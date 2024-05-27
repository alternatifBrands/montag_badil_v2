<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        #################################################
        // create admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'email_verified_at' => Carbon::now(),
            'remember_token' => Str::random(10),
            'country_id' => NULL,
            'type' => 'individual',
        ]);
        $admin_role = Role::create([
            'name'=>'admin_role_web',
            'guard_name'=>'web'
        ]);
        $admin->assignRole($admin_role);
        #################################################
        // create permission
        $userApiPermissions = [
            'view_category_api',
            'add_product_api',
            'edit_product_api',
            'add_brand_api',
            'edit_brand_api',
            'map_brand_api',
            'map_product_api',
        ];
        foreach ($userApiPermissions as $permission) {
            Permission::Create( [
                'name' => $permission,
                'guard_name' => 'api',
            ]);
        }
        // create role
        $user_role_api = Role::updateOrCreate(['name' => 'user_role_api'], [
            'name' => 'user_role_api',
            'guard_name' => 'api',
        ]);
        // give permissions to role
        $user_role_api->givePermissionTo($userApiPermissions);
        #################################################
        // create permission
        $userWebPermissions = [
            'view_category_web',
            'view_product_web',
            'add_product_web',
            'edit_product_web',
            'view_brand_web',
            'add_brand_web',
            'edit_brand_web',
            'map_brand_web',
            'map_product_web',
        ];
        foreach ($userWebPermissions as $permission) {
            Permission::Create( [
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
        // create role
        $user_role_web = Role::updateOrCreate(['name' => 'user_role_web'], [
            'name' => 'user_role_web',
            'guard_name' => 'web',
        ]);
        // give permissions to role
        $user_role_web->givePermissionTo($userWebPermissions);
        #################################################
        // $countryIds = Country::pluck('id')->toArray();
        // for ($i = 0; $i < 7; $i++) {
        //     User::create([
        //         'name' => fake()->name(),
        //         'email' => fake()->unique()->safeEmail(),
        //         'email_verified_at' => Carbon::now(),
        //         'password' => Hash::make('password'),
        //         'remember_token' => Str::random(10),
        //         'country_id' => fake()->randomElement($countryIds),
        //         'type' => fake()->randomElement(['individual', 'organization']),
        //     ])->assignRole('user_role_web');
        // }
        #################################################
    }
}
