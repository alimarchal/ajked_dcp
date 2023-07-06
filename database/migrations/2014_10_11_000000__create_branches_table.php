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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bank_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->unsignedBigInteger('bank_sdiv')->nullable();
            $table->unsignedBigInteger('bank_code_branch')->nullable();
            $table->unsignedBigInteger('cc_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
