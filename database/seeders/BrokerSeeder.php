<?php

namespace Database\Seeders;

use App\Models\Broker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Broker::create([
            'name' => 'John Doe',
            'phone' => '5555555555',
            'email' => 'contact@example.com'
        ]);
    }
}
