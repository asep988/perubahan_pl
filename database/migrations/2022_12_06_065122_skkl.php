<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Skkl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skkl', function (Blueprint $table) {
            $table->id();
            
            $table->text('pelaku_usaha');
            $table->text('nama_usaha');
            $table->text('jenis_usaha');
            $table->text('penanggung');
            $table->text('nib');
            $table->text('knli');
            $table->text('jabatan');
            $table->text('alamat');
            $table->text('lokasi');

            $table->text('pelaku_usaha_baru');
            $table->text('nama_usaha_baru');
            $table->text('jenis_usaha_baru');
            $table->text('penanggung_baru');
            $table->text('nib_baru');
            $table->text('knli_baru');
            $table->text('jabatan_baru');
            $table->text('alamat_baru');
            $table->text('lokasi_baru');

            $table->text('kabupaten_kota');
            $table->text('provinsi');
            $table->text('link_drive');

            $table->text('nomor_pl');
            $table->date('tgl_pl');
            $table->text('perihal');

            $table->text('il_dkk');
            $table->text('ruang_lingkup');
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
        //
    }
}
