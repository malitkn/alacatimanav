<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'title' => 'Real Estate Title',
            'meta_description' => 'a Real estate script with Laravel',
            'url' => env('app_url', 'http://localhost'),
            'name' => 'Real estate',
            'phone' => '5555555555',
            'email' => 'example@mail.com',
            'address' => 'Example address',
            'maps' => '!1m18!1m12!1m3!1d200066.2299539787!2d26.914911087181967!3d38.41755965220084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14bbd862a762cacd%3A0x628cbba1a59ce8fe!2zxLB6bWly!5e0!3m2!1str!2str!4v1729870444686!5m2!1str!2str"',
            'analytics' => 'G-400QMT7JEF',
            'facebook' => 'facebook.account',
            'instagram' => 'instagram.account',
            'twitter' => 'twitter.account',
        ]);
    }
}
