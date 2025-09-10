<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/ContactUsManagement/ContactAddress/Database/create_contact_addresses_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contact_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('icon', 30)->nullable();
            $table->string('name', 100)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->text('map_link')->nullable();

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
        Schema::dropIfExists('contact_addresses');
    }
};