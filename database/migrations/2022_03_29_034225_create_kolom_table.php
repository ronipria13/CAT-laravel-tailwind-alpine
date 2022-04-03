<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKolomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kolom', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('paketsoal_id')->nullable();
            $table->foreign('paketsoal_id')->references('id')->on('paketsoal');
            $table->char('col_a',5);
            $table->char('col_b',5);
            $table->char('col_c',5);
            $table->char('col_d',5);
            $table->char('col_e',5);
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
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
        Schema::dropIfExists('kolom');
    }
}
