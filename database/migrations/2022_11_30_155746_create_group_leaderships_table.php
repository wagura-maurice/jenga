<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupLeadershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_leaderships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->integer('category_id');
            $table->integer('client_id');
            $table->timestamp('occupied_at');
            $table->timestamp('vacated_at')->nullable();
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
        Schema::dropIfExists('group_leaderships');
    }
}
