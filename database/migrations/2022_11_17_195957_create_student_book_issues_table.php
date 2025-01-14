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
        Schema::create('student_book_issues', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->string('student_name');
            $table->date('apply_date')->nullable(); // tamggal mulai
            $table->date('issue_date')->nullable(); // tanggal berakhir
            $table->date('returned_date')->nullable();
            $table->date('no_kartu_perp')->nullable();
            $table->date('kelas')->nullable();
            $table->date('jurusan')->nullable();
            // $table->date('return_date')->nullable(); // tanggal kembali
            // $table->string('late_return_fine')->nullable();
            $table->string('unique_id')->unique();
            $table->enum('status',['pending','accepted','cancel', 'returned'])->default('pending');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('student_book_issues');
    }
};
