<?php
// services/auth-service/database/factories/ApiKeyFactory.php
namespace Database\Factories;

use App\Models\ApiKey;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ApiKeyFactory extends Factory
{
    protected $model = ApiKey::class;

    public function definition(): array
    {
        return [
            'key' => Str::random(32),
            'plan' => $this->faker->randomElement(['basic', 'premium']),
            'is_active' => true,
            'last_used_at' => null,
        ];
    }
}
