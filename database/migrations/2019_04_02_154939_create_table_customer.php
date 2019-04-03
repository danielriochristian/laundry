<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('customers', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nama');
          $table->string('hp',12);
          $table->string('alamat');
          $table->unsignedInteger('berat');
          $table->unsignedInteger('id_jenispakaian')->nullable();
          $table->unsignedInteger('id_pengharum')->nullable();
          $table->unsignedInteger('total');
          $table->date('tgl_terima');
          $table->date('tgl_selesai');
      });
      Schema::create('pengharum', function(Blueprint $kolom) {
        $kolom->increments('id');
        $kolom->string('nama_pengharum');
        $kolom->unsignedInteger('harga');
      });
      Schema::create('jenis_pakaian', function(Blueprint $kolom) {
        $kolom->increments('id');
        $kolom->string('jenis_pakaian');
        $kolom->unsignedInteger('harga');
      });
      Schema::table('customers', function(Blueprint $kolom){
          $kolom->foreign('id_jenispakaian')->references('id')->on('jenis_pakaian')->onDelete('cascade')->onUpdate('cascade');
          $kolom->foreign('id_pengharum')->references('id')->on('pengharum')->onDelete('cascade')->onUpdate('cascade');
        });

      //insert tabel pengharum
      DB::table('pengharum')->insert(
        ['id' => 1, 'nama_pengharum' => 'wangi', 'harga' => 1000]
      );
      DB::table('pengharum')->insert(
        ['id' => 2, 'nama_pengharum' => 'wangi parah', 'harga' => 2000]
      );
      DB::table('pengharum')->insert(
        ['id' => 3, 'nama_pengharum' => 'wangi gak ilang ilang', 'harga' => 3000]
      );

      //insert tabel jenis_pakaian
      DB::table('jenis_pakaian')->insert(
        ['id' => 1, 'jenis_pakaian' => 'pakaian biasa', 'harga' => 9000]
      );
      DB::table('jenis_pakaian')->insert(
        ['id' => 2, 'jenis_pakaian' => 'gordyn', 'harga' => 18000]
      );
      DB::table('jenis_pakaian')->insert(
        ['id' => 3, 'jenis_pakaian' => 'sepatu', 'harga' => 10000]
      );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('customers');
      Schema::dropIfExists('pengharum');
      Schema::dropIfExists('jenis_pakaian');

    }
}
