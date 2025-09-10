<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/OurSpeechesManagement/OurSpeeches/Database/create_our_speeches_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('our_speeches', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('tag', 20)->nullable();
            $table->string('title', 50)->nullable();
            $table->string('thumbnail_image', 100)->nullable();
            $table->string('video_url', 200)->nullable();

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
        Schema::dropIfExists('our_speeches');
    }
};