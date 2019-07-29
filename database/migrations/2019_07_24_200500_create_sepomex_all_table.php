<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSepomexAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sepomex_all', function (Blueprint $table) {
            $table->string('d_codigo', 8);
            $table->string('d_asenta', 191)->nullable();
            $table->string('d_tipo_asenta', 100)->nullable();
            $table->string('D_mnpio', 191)->nullable();
            $table->string('d_estado', 100)->nullable();
            $table->string('d_ciudad', 191)->nullable();
            $table->string('d_CP', 8)->nullable();
            $table->string('c_estado', 10)->nullable();
            $table->string('c_oficina', 10)->nullable();
            $table->string('c_CP', 10)->nullable();
            $table->string('c_tipo_asenta', 10)->nullable();
            $table->string('c_mnpio', 10)->nullable();
            $table->string('id_asenta_cpcons', 8)->nullable();
            $table->string('d_zona', 100)->nullable();
            $table->string('c_cve_ciudad', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sepomex_all');
    }
}
