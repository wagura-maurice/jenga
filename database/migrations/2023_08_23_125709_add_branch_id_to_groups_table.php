<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBranchIdToGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->unsignedBigInteger('branch_id')->nullable()->after('id');  // Assuming you want the new column right after the 'id' column.

            // If you have a 'branches' table and you want to set a foreign key constraint:
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            // If you added a foreign key constraint, drop it first:
            // $table->dropForeign(['branch_id']);
            
            $table->dropColumn('branch_id');
        });
    }
}
