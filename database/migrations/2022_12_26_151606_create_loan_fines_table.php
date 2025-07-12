<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_fines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id');
            $table->integer('product_id');
            $table->integer('schedule_id');
            $table->integer('client_id');
            $table->timestamp('fine_date');
            $table->decimal('amount', 10, 2)->default(0);
            $table->text('_narrative')->nullable();
            $table->string('_status')->default('unpaid');
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
        Schema::dropIfExists('loan_fines');
    }
}
