<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenugroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menugroups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('menugroup_label',100);
            $table->text('menugroup_desc')->nullable();
            $table->unsignedInteger('menugroup_order')->default(0);
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
        Schema::dropIfExists('menugroups');
    }
}
