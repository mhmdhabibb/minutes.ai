<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOriginalFileNameToTranscriptionsTable extends Migration
{
    public function up()
    {
        Schema::table('transcriptions', function (Blueprint $table) {
            $table->string('original_file_name')->nullable()->after('file_name');
        });
    }

    public function down()
    {
        Schema::table('transcriptions', function (Blueprint $table) {
            $table->dropColumn('original_file_name');
        });
    }
}
