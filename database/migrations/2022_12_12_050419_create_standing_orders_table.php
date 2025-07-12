<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandingOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standing_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('_pid')->unique();
            $table->integer('category_id');
            $table->integer('client_id')->nullable();
            $table->integer('escalated_by')->nullable();
            $table->integer('source_account');
            $table->integer('destination_account');
            $table->string('frequency')->default('weekly');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->string('amount');
            $table->text('reason')->nullable();
            $table->text('_narrative')->nullable();
            $table->timestamp('next_transfer')->nullable();
            $table->string('_status')->default('pending');
            $table->softDeletes();
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
        Schema::dropIfExists('standing_orders');
    }
}
