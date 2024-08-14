<?php

use App\Http\Controllers\PatientController;
use App\Models\Doctor;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Profile::class)->nullable();
            $table->foreignId('doctor_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('requests')->nullable();
            $table->date('date_now')->default(now()->format('Y-m-d'));
            $table->integer('update')->default(0);
            $table->date('appointment_date')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
