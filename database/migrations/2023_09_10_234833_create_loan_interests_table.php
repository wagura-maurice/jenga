<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_interests', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('code');
            $table->integer('mode');
            $table->date('date');
            $table->string('collecting_officer')->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('officer_id');
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
        Schema::dropIfExists('loan_interests');
    }
}
