<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/SectionHeadingManagement/SectionHeading/Database/create_section_headings_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('section_headings', function (Blueprint $table) {
            $table->id();
            $table->string('section_type', 50)->unique()->nullable();
            $table->string('short_title', 100)->nullable();
            $table->string('title', 200)->nullable();
            $table->text('long_title')->nullable();
            $table->text('short_description')->nullable();
            $table->longtext('description')->nullable();
            $table->string('video_url', 150)->nullable();
            $table->string('primary_image', 200)->nullable();
            $table->string('background_image', 200)->nullable();
            $table->string('side_image', 200)->nullable();
            $table->string('image', 200)->nullable();
            $table->longtext('special_note')->nullable();

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
        Schema::dropIfExists('section_headings');
    }
};