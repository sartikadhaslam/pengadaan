<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerimaan_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('id_penerimaan');
            $table->integer('id_barang');
            $table->text('nama_barang');
            $table->string('unit', 5);
            $table->integer('qty');
            $table->decimal('unit_price', 16,2);
            $table->decimal('total', 16,2);
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
        Schema::dropIfExists('penerimaan_detail');
    }
}
