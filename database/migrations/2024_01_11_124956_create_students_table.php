 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('student_id')->unique();
            $table->integer('adoszam')->nullable()->default(null);//->unique();
            $table->integer('tajszam')->nullable()->default(null);
            $table->string('email'); //->unique() amíg tesztelés van
            $table->string('nev');
            $table->string('szul_nev')->nullable()->default(null);
            $table->string('anyja_neve')->nullable()->default(null);
            $table->integer('okt_azon')->nullable()->default(null);
            //$table->foreignId('major_id')->references('major_id')->on('majors')->nullable()->default(null);
            $table->primary(['student_id']);//, 'adoszam'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
