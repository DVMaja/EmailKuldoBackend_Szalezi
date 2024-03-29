<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('majors', function (Blueprint $table) {
            $table->id("major_id");
            $table->string("elnevezes");
            $table->timestamps();
        });

        DB::table('majors')->insert([
            ['elnevezes' => 'Informatikai rendszer- és alkalmazás-üzemeltető technikus'],
            ['elnevezes' => 'Szoftverfejlesztő és tesztelő'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('majors');
    }
};
