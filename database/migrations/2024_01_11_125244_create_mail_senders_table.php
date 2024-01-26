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
        Schema::create('mail_senders', function (Blueprint $table) {
            //$table->id();
            $table->string('student_id');
            $table->string('nev');
            $table->string('email');
            $table->string('pdf_name', 100);
            //$table->string('path');
            $table->timestamps();
            $table->primary(['student_id']);
            //$table->foreign('student_id')->references('student_id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_senders');
    }
};
