<?php
// services/lottery-service/database/migrations/2024_01_01_000001_create_lottery_statistics_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lottery_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('api_key');
            $table->integer('total_draws');
            $table->json('result_distribution');
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lottery_statistics');
    }
};
