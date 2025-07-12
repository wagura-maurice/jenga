<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedAtToGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->string('_gps_latitude')->nullable();
            $table->string('_gps_longitude')->nullable();
            $table->string('_narrative')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('_gps_latitude');
            $table->dropColumn('_gps_longitude');
            $table->dropColumn('_narrative');
            $table->dropColumn('deleted_at');
        });
    }
}
