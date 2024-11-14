<?php
// services/auth-service/database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ApiKey;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // テストユーザーの作成
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // APIキーの作成
        ApiKey::create([
            'user_id' => $user->id,
            'key' => Str::random(32),
            'plan' => 'basic',
            'is_active' => true,
        ]);

        ApiKey::create([
            'user_id' => $user->id,
            'key' => Str::random(32),
            'plan' => 'premium',
            'is_active' => true,
        ]);
    }
}
