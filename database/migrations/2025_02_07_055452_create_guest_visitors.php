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
            $table->string("nama");
            $table->string("tanggal");
            $table->string("alamat");
            $table->string("pekerjaan");
            $table->text("maksud_kunjungan");
            $table->text("kesan");
            $table->text("pesan");
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
