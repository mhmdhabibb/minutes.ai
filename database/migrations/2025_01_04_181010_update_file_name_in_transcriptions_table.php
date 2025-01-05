<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transcriptions', function (Blueprint $table) {
            // Increase the length of the file_name column or add other adjustments
            $table->string('file_name', 255)->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('transcriptions', function (Blueprint $table) {
            // Rollback to the previous state
            $table->string('file_name')->change();
        });
    }
};
