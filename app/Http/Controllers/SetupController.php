<?php

namespace App\Http\Controllers;

use App\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

class SetupController extends Controller
{
    public function invoke(): \Illuminate\Http\Response
    {
        try {
            Log::debug('Starting: Run database migration');

            // run the migration
            Artisan::call('migrate', [
                '--force' => false,
            ]);

            Log::debug('Finished: Run database migration');

            Log::debug('Starting: Run application optimizations');

            Artisan::call('down');
            Artisan::call('cache:clear');
            Artisan::call('route:clear');
            Artisan::call('route:cache');
            Artisan::call('config:clear');
            Artisan::call('config:cache');
            Artisan::call('view:clear');
            // Artisan::call('view:cache');
            Artisan::call('optimize');
            Artisan::call('up');

            Log::debug('Finished: Run application optimizations');

        } catch (\Exception $e) {
            // log the error
            Log::error($e);

            return response('not ok', 500);
        }

        return response('ok', 200);
    }

    public function employees(Request $request) {
        $branch = $request->input('branch');

        if(!$branch) {
            return response()->json(['error' => 'Branch not specified'], 400);
        }

        $employees = Employees::where('branch', $branch)->get();

        return response()->json($employees);
    }

}
