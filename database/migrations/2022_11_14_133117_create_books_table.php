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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('no_induk');
            $table->date('tanggal_buat')->nullable();
            // $table->string('judul_buku')->nullable();
            $table->string('no_judul')->nullable();
            $table->string('penerbit')->nullable();
            $table->string('cet_ed')->nullable();
            $table->string('jilid')->nullable();
            $table->string('tahun_terbit')->nullable();
            $table->string('kota_terbit')->nullable();
            $table->string('buy_from')->nullable();
            $table->string('present_from')->nullable();
            $table->string('no_of_copy')->nullable();
            $table->text('harga')->nullable();
            $table->text('jumlah')->nullable();
            $table->text('no_class')->nullable();
            $table->text('keterangan')->nullable();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('author_id')->constrained()->cascadeOnDelete();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('books');
    }
};
