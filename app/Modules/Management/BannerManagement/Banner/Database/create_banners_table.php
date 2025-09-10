<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/BannerManagement/Banner/Database/create_banners_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('slogan', 30)->nullable();
            $table->string('election_type', 50)->nullable();
            $table->string('main_title', 30)->nullable();
            $table->string('short_title', 100)->nullable();
            $table->longtext('description')->nullable();
            $table->string('perma_link', 150)->nullable();
            $table->string('image', 100)->nullable();
            $table->string('background_image', 100)->nullable();

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
        Schema::dropIfExists('banners');
    }
};