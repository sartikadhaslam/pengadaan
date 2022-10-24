<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_customer', function (Blueprint $table) {
            $table->id();
            $table->text('kode_customer');
            $table->text('nama_customer');
            $table->text('alamat');
            $table->text('email');
            $table->string('no_telp', 13);
            $table->string('fax', 13);
            $table->string('nama_pic', 35);
            $table->string('jabatan_pic', 35);
            $table->integer('payment_terms');
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
        Schema::dropIfExists('master_customer');
    }
}
