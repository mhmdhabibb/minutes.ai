<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleAISTable extends Migration
{
    public function up()
    {
        Schema::create('module_a_i_s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('version');
            $table->string('type');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('module_a_i_s');
    }
}