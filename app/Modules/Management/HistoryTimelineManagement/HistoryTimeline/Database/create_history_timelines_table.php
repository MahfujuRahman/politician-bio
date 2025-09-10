<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/HistoryTimelineManagement/HistoryTimeline/Database/create_history_timelines_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('history_timelines', function (Blueprint $table) {
            $table->id();
            $table->date('month_year')->nullable();
            $table->string('title', 30)->nullable();
            $table->text('description')->nullable();
            $table->string('image', 100)->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_timelines');
    }
};