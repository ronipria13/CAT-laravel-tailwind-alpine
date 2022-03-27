<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('module_id')->nullable();
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreignUuid('controller_id')->nullable();
            $table->foreign('controller_id')->references('id')->on('controllers');
            $table->foreignUuid('function_id')->nullable();
            $table->foreign('function_id')->references('id')->on('functions');
            $table->string('action_path', 100);
            $table->boolean('ajax_only')->default(false);
            $table->string('type', 100);
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
        Schema::dropIfExists('actions');
    }
}
