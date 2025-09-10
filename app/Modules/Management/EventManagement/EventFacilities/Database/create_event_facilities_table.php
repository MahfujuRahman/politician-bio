<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/EventManagement/EventFacilities/Database/create_event_facilities_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_facilities', function (Blueprint $table) {
            $table->id();
            $table->string('event_id', 100)->nullable();
            $table->string('video_url', 250)->nullable();
            $table->json('facility')->nullable();

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
        Schema::dropIfExists('event_facilities');
    }
};