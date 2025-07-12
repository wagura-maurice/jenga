<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBranchIdAndOfficerIdToLoanDisbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_disbursements', function (Blueprint $table) {
            $table->unsignedBigInteger('branch_id')->nullable()->after('id'); // or wherever you want the column
            $table->unsignedBigInteger('officer_id')->nullable()->after('branch_id');
            
            // If you have branches and officers tables and want to set foreign keys, you can do so:
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
            // $table->foreign('officer_id')->references('id')->on('officers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_disbursements', function (Blueprint $table) {
            // If you set foreign keys, drop them first:
            // $table->dropForeign(['branch_id']);
            // $table->dropForeign(['officer_id']);

            // Now drop the columns:
            $table->dropColumn('branch_id');
            $table->dropColumn('officer_id');
        });
    }
}
