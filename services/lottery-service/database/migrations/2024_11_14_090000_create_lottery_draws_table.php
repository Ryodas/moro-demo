<?php
// services/lottery-service/database/migrations/2024_01_01_000000_create_lottery_draws_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lottery_draws', function (Blueprint $table) {
            $table->id();
            $table->string('api_key');
            $table->json('items');
            $table->json('weights')->nullable();
            $table->string('result');
            $table->string('plan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lottery_draws');
    }
};
