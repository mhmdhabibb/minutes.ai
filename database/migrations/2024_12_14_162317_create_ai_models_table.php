<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAiModelsTable extends Migration
{
    public function up()
    {
        Schema::create('ai_models', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('name');
            $table->string('type');
            $table->string('version');
            $table->text('description');
            $table->string('file_path')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ai_models');
    }
}