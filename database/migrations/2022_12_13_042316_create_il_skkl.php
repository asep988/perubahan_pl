<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIlSkkl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('il_skkl', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_skkl');
            $table->foreign('id_skkl')->references('id')->on('skkl')->onDelete('cascade');
            $table->text('jenis_sk');
            $table->text('menerbitkan');
            $table->text('nomor_surat');
            $table->date('tgl_surat');
            $table->text('perihal_surat');
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
        Schema::dropIfExists('il_skkl');
    }
}
