<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaanHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerimaan_header', function (Blueprint $table) {
            $table->id();
            $table->text('no_pembelian');
            $table->date('tanggal_penerimaan');
            $table->integer('id_principle');
            $table->text('surat_tagihan');
            $table->text('packing_list');
            $table->string('nama_pengirim',35)->nullable();
            $table->string('hp_pengirim', 16)->nullable();
            $table->text('status');
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
        Schema::dropIfExists('penerimaan_header');
    }
}