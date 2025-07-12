<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransactionCodeToFinePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fine_payments', function (Blueprint $table) {
            $table->integer('loanfine')->nullable();
            $table->string('transaction_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fine_payments', function (Blueprint $table) {
            $table->dropColumn('loanfine');
            $table->dropColumn('transaction_code');
        });
    }
}
