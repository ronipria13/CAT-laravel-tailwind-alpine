<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalkecermatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soalkecermatan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('paketsoal_id')->references('id')->on('paketsoal')->onDelete('cascade');
            $table->foreignUuid('kolom_id')->references('id')->on('kolom')->onDelete('cascade');
            $table->string('soal',20);
            $table->string('key',20);
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
        Schema::dropIfExists('soalkecermatan');
    }
}
