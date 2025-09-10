<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/GetInvolvedManagement/GetInvolved/Database/create_get_involveds_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('get_involveds', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->json('help_types')->nullable();
            $table->json('preferred_times')->nullable();
            $table->json('preferred_days')->nullable();
            $table->text('comments')->nullable();

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
        Schema::dropIfExists('get_involveds');
    }
};