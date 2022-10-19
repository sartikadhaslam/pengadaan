<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_header', function (Blueprint $table) {
            $table->id();
            $table->string('no_pemesanan', 14);
            $table->date('tanggal_pemesanan');
            $table->integer('id_customer');
            $table->text('alamat_customer');
            $table->string('telepon_customer', 16);
            $table->string('fax_customer', 16);
            $table->text('ship_to')->nullable();
            $table->date('delivery_deadline')->nullable();
            $table->integer('payment_terms');
            $table->text('remark')->nullable();
            $table->text('file');
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
        Schema::dropIfExists('pemesanan_header');
    }
}
