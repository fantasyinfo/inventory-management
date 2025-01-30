<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->unique();
            $table->string('department');
            $table->string('full_name');
            $table->string('company_contractor');
            $table->string('category');
            $table->string('plant_location');

            $table->date('date_of_joining');
            $table->enum('status', ['active', 'left'])->default('active');
            //
            $table->index('full_name');
            $table->index('emp_id');
            $table->index('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
