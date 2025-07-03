<?php

namespace Database\Seeders;

use App\Models\CommissionRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommissionRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('commission_rates')->insert([
            ['firm' => 'yemeksepeti', 'rate' => 1.3],
            ['firm' => 'getir', 'rate' => 1.23],
        ]);
    }
}
