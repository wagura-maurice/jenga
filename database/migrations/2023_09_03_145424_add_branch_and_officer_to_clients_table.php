<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBranchAndOfficerToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('branch_id')->nullable()->after('id');
            $table->unsignedBigInteger('officer_id')->nullable()->after('branch_id');

            // If you have branches and officers tables and you want to set foreign keys:
            // <!-- $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null'); -->
            // <!-- $table->foreign('officer_id')->references('id')->on('officers')->onDelete('set null'); -->
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
            // <!-- $table->dropForeign(['branch_id']); -->
            // <!-- $table->dropForeign(['officer_id']); -->
            $table->dropColumn(['branch_id', 'officer_id']);
        });
    }
}

