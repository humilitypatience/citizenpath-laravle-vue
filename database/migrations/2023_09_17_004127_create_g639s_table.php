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
        Schema::create('g639s', function (Blueprint $table) {
            $table->id();
            $table->string("requestInfo");
            $table->string("requestPurpose")->nullable();
            $table->string("exactRecordName");
            $table->boolean("insteadOfChild")->default(false);
            $table->boolean("insteadOfSomeoneDeceased")->default(false);
            $table->boolean("insteadForAttorney")->default(false);
            $table->integer("subjectId");
            $table->integer("mailingAddressId");
            $table->boolean("urgentNeed")->default(false);
            $table->integer("circumstance")->nullable();
            $table->string("firstNameAtArrivalInUS");
            $table->string("middleNameAtArrivalInUS")->nullable();
            $table->string("lastNameAtArrivalInUS");
            $table->string("I94AdmissionNumber")->nullable();
            $table->string("passportNumber")->nullable();
            $table->string('applicationReceiptNumber')->nullable();
            $table->string("USCISReceiptNumber")->nullable();
            $table->integer("fatherId")->nullable();
            $table->integer("motherId")->nullable();
            $table->string("roleOfRequestor")->nullable();
            $table->string("requestorId");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g639s');
    }
};
