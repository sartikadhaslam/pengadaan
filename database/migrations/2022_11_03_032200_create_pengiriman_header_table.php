<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimanHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman_header', function (Blueprint $table) {
            $table->id();
            $table->text('no_pemesanan');
            $table->date('tanggal');
            $table->integer('id_customer');
            $table->text('no_surat_jalan');
            $table->text('no_invoice');
            $table->text('delivery_to');
            $table->integer('payment_terms');
            $table->text('gross_weight');
            $table->text('dimensi');
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
        Schema::dropIfExists('pengiriman_header');
    }
}
