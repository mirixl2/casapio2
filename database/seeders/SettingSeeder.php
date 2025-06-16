<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        Setting::updateOrCreate(
            ['key' => 'site_name'],
            ['value' => 'Foodfun']
        );

        Setting::updateOrCreate(
            ['key' => 'site_logo'],
            ['value' => 'assets/images/logo/logo.png']
        );
    }
}
