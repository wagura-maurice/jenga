<?php

namespace App\Helpers;

// use App\Loans;
// use App\ClearingFeePayments;
// use App\ProcessingFeePayments;
// use App\InsuranceDeductionPayments;
 
class JENGA {
	
	public static function get_tables_list($tables = [])
	{
		$tables_in_db = \DB::select('SHOW TABLES');
		$db           = "Tables_in_".env('DB_DATABASE');

	    foreach($tables_in_db as $table){
	        $tables[] = $table->{$db};
	    }

	    dd($tables);
	}
}