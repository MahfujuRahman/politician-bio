<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/VolunteerManagement/VolunteerPreRequisite/Database/create_volunteer_pre_requisite_applications_table.php' 
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('volunteer_pre_requisite_applications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('prerequisite_id')->nullable();
            $table->bigInteger('volunteer_application_id')->nullable();
            $table->string('prerequisite_option_id', 100)->nullable();

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
        Schema::dropIfExists('volunteer_pre_requisite_applications');
    }
};