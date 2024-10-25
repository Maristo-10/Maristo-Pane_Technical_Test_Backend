<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->enum('status', ['new', 'follow_up', 'survey_request', 'survey_approved', 'survey_rejected', 'survey_completed', 'final_proposal', 'deal']);
            $table->unsignedBigInteger('salesperson_id')->nullable();
            $table->timestamps();

            $table->foreign('salesperson_id')->references('id')->on('salespersons');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
