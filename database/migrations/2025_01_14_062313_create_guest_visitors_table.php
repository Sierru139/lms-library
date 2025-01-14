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
        Schema::create('guest_visitors', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_kunjungan')->nullable();
            $table->string('guest_name')->nullable();
            $table->string('alamat')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('rekomendasi_tujuan')->nullable();
            $table->string('rekomendasi_pesan')->nullable();
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
        Schema::dropIfExists('guest_visitors');
    }
};
