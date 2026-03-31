<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use App\Models\Subscription;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        Subscriber::factory()
            ->count(20)
            ->has(Subscription::factory()->count(2))
            ->create();
    }
}
