<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salespersons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['residential', 'commercial']);
            $table->boolean('is_penalized')->default(false);
            $table->timestamp('last_assigned')->default(Carbon::now());
            $table->timestamp('penalty_start')->nullable();
            $table->timestamp('penalty_end')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salespersons');
    }
};
