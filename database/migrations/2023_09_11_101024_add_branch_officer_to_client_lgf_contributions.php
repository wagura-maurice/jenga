<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBranchOfficerToClientLgfContributions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_lgf_contributions', function (Blueprint $table) {
            // Add the branch_id and officer_id columns
            $table->unsignedBigInteger('branch_id')->default(1); // Change the default value if needed
            $table->unsignedBigInteger('officer_id')->default(1); // Change the default value if needed

            // Add foreign key constraints if necessary
            // $table->foreign('branch_id')->references('id')->on('branches');
            // $table->foreign('officer_id')->references('id')->on('officers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_lgf_contributions', function (Blueprint $table) {
            // Remove the branch_id and officer_id columns
            $table->dropColumn('branch_id');
            $table->dropColumn('officer_id');
        });
    }
}
