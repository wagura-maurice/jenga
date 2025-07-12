<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOfficerAndBranchToGroupcashbooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_cash_books', function (Blueprint $table) {
            $table->unsignedBigInteger('officer_id')->nullable()->after('id');
            $table->unsignedBigInteger('branch_id')->nullable()->after('officer_id');
            
            // Assuming officer and branch tables have primary keys as id.
            // $table->foreign('officer_id')->references('id')->on('officers')->onDelete('cascade');
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_cash_books', function (Blueprint $table) {
            // $table->dropForeign(['officer_id']);
            // $table->dropForeign(['branch_id']);
            $table->dropColumn(['officer_id', 'branch_id']);
        });
    }
}
