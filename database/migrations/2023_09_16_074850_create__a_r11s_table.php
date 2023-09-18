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
        Schema::create('ar11s', function (Blueprint $table) {
            $table->id();
            $table->integer("previousPhysicalAddress");
            $table->integer("presentPhysicalAddress");
            $table->integer("mailingAddress")->nullable();
            $table->integer("applicantId");
            $table->string("citizenship");
            $table->string("visitingRole");
            $table->string("immigrationStatus")->nullable();
            $table->integer("userId")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar11s');
    }
};
