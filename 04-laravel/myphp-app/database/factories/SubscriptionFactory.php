<?php

namespace Database\Factories;

use App\Models\Subscriber;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subscription>
 */
class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition(): array
    {
        return [
            'subscriber_id' => Subscriber::factory(),
            'service' => fake()->randomElement(['Youtube', 'Spotify', 'Instagram', 'TikTok', 'X', 'GitHub']),
            'topic' => fake()->randomElement(['music', 'cloud', 'fun', 'social']),
            'payload' => [
                'plan' => fake()->randomElement(['basic', 'standard', 'premium']),
                'region' => fake()->country(),
            ],
            'expired_at' => fake()->dateTimeBetween('now', '+3 year'),
        ];
    }
}
