<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_visitors', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_kunjungan')->nullable();
            $table->string('student_name')->nullable();
            $table->enum('kelas',['X','XI','XII']);
            // $table->string('kelas')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('tujuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_visitors');
    }
};
