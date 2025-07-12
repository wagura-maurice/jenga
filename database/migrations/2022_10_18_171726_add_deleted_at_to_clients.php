<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedAtToClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('home_image_1')->nullable();
            $table->string('home_image_2')->nullable();
            $table->string('home_image_3')->nullable();
            $table->string('business_image_1')->nullable();
            $table->string('business_image_2')->nullable();
            $table->string('business_image_3')->nullable();
            $table->string('home_gps_latitude')->nullable();
            $table->string('home_gps_longitude')->nullable();
            $table->string('business_gps_latitude')->nullable();
            $table->string('business_gps_longitude')->nullable();
            $table->string('front_national_id')->nullable();
            $table->string('back_national_id')->nullable();
            $table->string('_narrative')->nullable();
            $table->string('assigned_officer')->nullable();
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
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('home_image_1');
            $table->dropColumn('home_image_2');
            $table->dropColumn('home_image_3');
            $table->dropColumn('business_image_1');
            $table->dropColumn('business_image_2');
            $table->dropColumn('business_image_3');
            $table->dropColumn('home_gps_latitude');
            $table->dropColumn('home_gps_longitude');
            $table->dropColumn('business_gps_latitude');
            $table->dropColumn('business_gps_longitude');
            $table->dropColumn('front_national_id');
            $table->dropColumn('back_national_id');
            $table->dropColumn('_narrative');
            $table->dropColumn('assigned_officer');
            $table->dropColumn('deleted_at');
        });
    }
}
