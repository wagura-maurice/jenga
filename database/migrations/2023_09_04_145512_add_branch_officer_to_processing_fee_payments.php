<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBranchOfficerToProcessingFeePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('processing_fee_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('officer_id')->nullable();

            // if you have the branches and officers tables, you can add foreign keys:
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            // $table->foreign('officer_id')->references('id')->on('officers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('processing_fee_payments', function (Blueprint $table) {
            // $table->dropForeign(['branch_id']);
            // $table->dropForeign(['officer_id']);
            $table->dropColumn('branch_id');
            $table->dropColumn('officer_id');
        });
    }
}
