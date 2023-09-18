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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string("firstName");
            $table->string("middleName")->nullable();
            $table->string("lastName");
            $table->string("email")->nullable();
            $table->date("birthday")->nullable();
            $table->string("birthTerritory")->nullable();
            $table->string("birthCountry")->nullable();
            $table->string("gender")->nullable();
            $table->string("ethnicity")->nullable();
            $table->json("race")->nullable();
            $table->double("height")->nullable();
            $table->double("weight")->nullable();
            $table->string("eyeColor")->nullable();
            $table->string("hairColor")->nullable();
            $table->string("datetimePhone")->nullable();
            $table->string("mobilePhone")->nullable();
            $table->string("alienNumber")->nullable();
            $table->string("socialSecurityNumber")->nullable();
            $table->string("USCISOnlineAccountNumber")->nullable();
            $table->integer("employerId")->nullable();
            $table->integer("fatherId")->nullable();
            $table->integer("motherId")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
