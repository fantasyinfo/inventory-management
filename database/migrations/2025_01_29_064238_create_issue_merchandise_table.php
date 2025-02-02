<?php

use App\Models\Employee;
use App\Models\Merchandise;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('issue_merchandise', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class); // employee_id
            $table->foreignIdFor(Merchandise::class); // merchandise_id
            $table->foreignIdFor(User::class, 'issued_by'); // issued_by
            $table->integer('qty');
            $table->date('issue_date');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_merchandise');
    }
};
