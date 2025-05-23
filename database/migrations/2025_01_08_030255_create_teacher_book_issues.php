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
        Schema::create('teacher_book_issues', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->date('apply_date')->nullable();
            $table->string('teacher_name')->nullable();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            // $table->date('issue_date')->nullable();
            // $table->date('return_date')->nullable();
            // $table->string('late_return_fine')->nullable();
            $table->date('returned_date')->nullable();
            $table->enum('status',['pending','accepted','cancel', 'returned'])->default('pending');
            // $table->string('fine_received')->nullable();
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
        Schema::dropIfExists('teacher_book_issues');
    }
};
