<?php

namespace Database\Seeders;

use App\Models\CommissionRate;
use App\Models\User;
use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      
		DB::table('users')->insert([
            'name' => 'M.Ali',
            'email' => 'bsn.muhammetali@gmail.com',
            'password' => Hash::make('12345'),
        ]);
		

        $this->call([
            SettingSeeder::class,
            MediaSeeder::class,
            CommissionRateSeeder::class,
        ]);
    }
}
