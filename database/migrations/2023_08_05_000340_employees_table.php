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
        Schema::create('employees', function(Blueprint $table){
            $table->id();
            $table->foreignId('employment_id')->constrained('employments');
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_names')->nullable();
            $table->integer('gender_code');
            $table->integer('TIN');
            $table->string('SSNIT_no');
            $table->date('date_of_birth');
            $table->integer('marital_status_code');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('correspondence_address');
            $table->string('passport_pic_path')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
