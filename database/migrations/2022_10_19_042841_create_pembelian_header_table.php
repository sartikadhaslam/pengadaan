<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_header', function (Blueprint $table) {
            $table->id();
            $table->text('no_pembelian');
            $table->date('tanggal_pembelian');
            $table->integer('id_principle');
            $table->text('alamat_principle');
            $table->string('telepon_principle', 16);
            $table->string('fax_principle', 16);
            $table->text('term_condition')->nullable();
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
        Schema::dropIfExists('pembelian_header');
    }
}
