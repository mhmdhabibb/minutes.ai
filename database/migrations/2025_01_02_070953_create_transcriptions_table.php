<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('transcriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('file_name'); // Original file name
            $table->string('stored_file_name'); // Unique file name for storage
            $table->json('transcription'); // Store transcription data as JSON
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transcriptions');
    }
}
