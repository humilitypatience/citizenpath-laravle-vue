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
        Schema::create('kinsfolks', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('middleName')->nullable();
            $table->string('lastName');
            $table->string('relationship');
            $table->date('birthday')->nullable();
            $table->string('alienNumber')->nullable();
            $table->string('socialSecurityNumber')->nullable();
            $table->boolean('sponsoredFlag')->default(true);
            $table->string('USCISNumber')->nullable();
            $table->unsignedBigInteger('applicantId');
            $table->unsignedBigInteger('g639Id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kinsfolks');
    }
};
