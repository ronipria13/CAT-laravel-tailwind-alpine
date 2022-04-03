<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('latihan_id')->references('id')->on('latihan')->onDelete('cascade');
            $table->foreignUuid('soal_id')->references('id')->on('soalkecermatan')->onDelete('cascade');
            $table->string('answer',100)->nullable();
            $table->boolean('true')->nullable();
            $table->unsignedInteger('value')->nullable();
            $table->dateTime('answered_time')->nullable();
            $table->string('created_by', 100)->nullable();
            $table->string('updated_by', 100)->nullable();
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
        Schema::dropIfExists('jawaban');
    }
}
