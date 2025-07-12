<?php

namespace App\Http\Controllers;

use App\Loans;
use App\Groups;
use App\Clients;
use App\Genders;
use App\Branches;
use App\Counties;
use App\Employees;
use App\Positions;
use Carbon\Carbon;
use App\ClientTypes;
use App\Salutations;
use App\SubCounties;
use App\LoanInterest;
use App\LoanPayments;
use App\LoanStatuses;
use App\MaritalStatuses;
use App\ClientCategories;
use App\LoanDisbursements;
use Illuminate\Http\Request;
use App\DisbursementStatuses;
use App\ProcessingFeePayments;
use App\ClientLgfContributions;
use App\MainEconomicActivities;
use App\NextOfKinRelationships;
use Illuminate\Routing\Controller;
use App\SecondaryEconomicActivities;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Exports\ClientPerformanceExport;
use App\Exports\DisbursementPerformanceExport;
use App\Exports\ProcessingFeePerformanceExport;
use App\Exports\LoanCollectionPerformanceExport;
use App\Exports\LoanGuaranteeFundPerformanceExport;
use App\Exports\InterestCollectionPerformanceExport;

class PerformanceController extends Controller
{
    public function client(Request $request)
    {
        $data = [];
        $query = Clients::query();

        // Check if the request has branch and add it to the query
        if ($request->has('branch')) {
            $query->where('branch_id', $request->branch);
        }

        // Check if the request has officer_id and add it to the query
        if ($request->has('officer')) {
            $query->where('officer_id', $request->officer);
        }

        // Get the start date and end date from the request or set default values
        $data['startDate'] = $request->has('startDate') ? Carbon::parse($request->startDate)->toDateString() : Carbon::now()->subDays(70000)->toDateString();
        $data['endDate'] = $request->has('endDate') ? Carbon::parse($request->endDate)->toDateString() : Carbon::now()->toDateString();

        // Filter by the date range
        $query->whereBetween('created_at', [
            Carbon::parse($data['startDate'])->hour(0)->minute(0)->second(0)->toDateString(),
            Carbon::parse($data['endDate'])->addDay()->hour(23)->minute(59)->second(59)->toDateString()
        ]);

        if (auth()->user()->user_account != '8') {
            $clientIds = Clients::where('officer_id', auth()->user()->employeemodel->id)->pluck('id');
            $query->whereIn('id', $clientIds);
        }

        $data['salutations']=Salutations::all();
		$data['blacklisted']=ClientCategories::where([['code','=','003']])->get();
		$data['suspended']=ClientCategories::where([['code','=','004']])->get();
		$data['removed']=ClientCategories::where([['code','=','005']])->get();
		$data['genders']=Genders::all();
		$data['maritalstatuses']=MaritalStatuses::all();
		$data['clienttypes']=ClientTypes::all();
		$data['groupclient']=ClientTypes::where([['code','=','001']])->get();
		$data['clientcategories']=ClientCategories::all();
		$data['counties']=Counties::all();
		$data['subcounties']=SubCounties::all();
		$data['nextofkinrelationships']=NextOfKinRelationships::all();
		$data['active']=ClientCategories::where([['code','=','002']])->get();
		$data['counties']=Counties::all();
		$data['subcounties']=SubCounties::all();
		$data['groups']=Groups::all();
		$data['maineconomicactivities']=MainEconomicActivities::all();
		$data['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$data['employees']=Employees::where([['position','=',$position[0]['id']]])->get();
		$query->orderBy('id','desc');
		$data['list'] = $query->paginate(10);
        $data['branches'] = Branches::all();

        // Check if the request is AJAX
        if ($request->ajax()) {
            return response()->json($data);
        }

        return view('admin.performance.client', compact('data'));
    }

    public function downloadClient(Request $request)
    {
        $branch = $request->input('branch');
        $officer = $request->input('officer');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $export = new ClientPerformanceExport($startDate, $endDate, $branch, $officer);
        $fileName = 'clients_performance.xlsx';

        return (new FastExcel($export->export()))->download($fileName);
    }

    public function disbursement(Request $request) {
        $data = [];
        $query = LoanDisbursements::query();

        // Check if the request has branch and add it to the query
        if ($request->has('branch')) {
            $query->where('branch_id', $request->branch);
        }

        // Check if the request has officer_id and add it to the query
        if ($request->has('officer')) {
            $query->where('officer_id', $request->officer);
        }

        // Get the start date and end date from the request or set default values
        $data['startDate'] = $request->has('startDate') ? Carbon::parse($request->startDate)->toDateString() : Carbon::now()->subDays(70000)->toDateString();
        $data['endDate'] = $request->has('endDate') ? Carbon::parse($request->endDate)->toDateString() : Carbon::now()->toDateString();

        // Filter by the date range
        $query->whereBetween('created_at', [
            Carbon::parse($data['startDate'])->hour(0)->minute(0)->second(0)->toDateString(),
            Carbon::parse($data['endDate'])->addDay()->hour(23)->minute(59)->second(59)->toDateString()
        ]);

        if (auth()->user()->user_account != '8') {
            $query->where('officer_id', auth()->user()->employeemodel->id);
        }

        $approvedloans = LoanStatuses::where([['code', '=', '002']])->get();
		$data['approvedstatus'] = $approvedloans[0]->id;
		$data['loans'] = Loans::where([['status', '=', $approvedloans[0]->id]])->orderBy('loan_number', 'desc')->get();
		$data['disbursementstatuses'] = DisbursementStatuses::all();
		$query->orderBy('id','desc');
		$data['list'] = $query->paginate(10);
        $data['branches'] = Branches::all();

        // Check if the request is AJAX
        if ($request->ajax()) {
            return response()->json($data);
        }

        return view('admin.performance.disbursement', compact('data'));
    }

    public function downloadDisbursement(Request $request)
    {
        $branch = $request->input('branch');

        $officer = $request->input('officer');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $export = new DisbursementPerformanceExport($startDate, $endDate, $branch, $officer);
        $fileName = 'disbursements_performance.xlsx';

        return (new FastExcel($export->export()))->download($fileName);
    }

    public function interestCollection(Request $request) {
        $data = [];
        $query = LoanInterest::query();

        // Check if the request has branch and add it to the query
        if ($request->has('branch')) {
            $query->where('branch_id', $request->branch);
        }

        // Check if the request has officer_id and add it to the query
        if ($request->has('officer')) {
            $query->where('officer_id', $request->officer);
        }

        // Get the start date and end date from the request or set default values
        $data['startDate'] = $request->has('startDate') ? Carbon::parse($request->startDate)->toDateString() : Carbon::now()->subDays(70000)->toDateString();
        $data['endDate'] = $request->has('endDate') ? Carbon::parse($request->endDate)->toDateString() : Carbon::now()->toDateString();

        // Filter by the date range
        $query->whereBetween('date', [
            Carbon::parse($data['startDate'])->hour(0)->minute(0)->second(0)->toDateString(),
            Carbon::parse($data['endDate'])->addDay()->hour(23)->minute(59)->second(59)->toDateString()
        ]);

        if (auth()->user()->user_account != '8') {
            $query->where('officer_id', auth()->user()->employeemodel->id);
        }

		$query->orderBy('id','desc');
		$data['list'] = $query->paginate(10);
        $data['branches'] = Branches::all();
        
        // Check if the request is AJAX
        if ($request->ajax()) {
            return response()->json($data);
        }

        return view('admin.performance.loan_interest_collection', compact('data'));
    }

    public function downloadInterestCollection(Request $request)
    {
        $branch = $request->input('branch');

        $officer = $request->input('officer');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $export = new InterestCollectionPerformanceExport($startDate, $endDate, $branch, $officer);
        $fileName = 'loan_interest_collections_performance.xlsx';

        return (new FastExcel($export->export()))->download($fileName);
    }

    public function loanCollection(Request $request) {
        $data = [];
        $query = LoanPayments::query();

        // Check if the request has branch and add it to the query
        if ($request->has('branch')) {
            $query->where('branch_id', $request->branch);
        }

        // Check if the request has officer_id and add it to the query
        if ($request->has('officer')) {
            $query->where('officer_id', $request->officer);
        }

        // Get the start date and end date from the request or set default values
        $data['startDate'] = $request->has('startDate') ? Carbon::parse($request->startDate)->toDateString() : Carbon::now()->subDays(70000)->toDateString();
        $data['endDate'] = $request->has('endDate') ? Carbon::parse($request->endDate)->toDateString() : Carbon::now()->toDateString();

        // Filter by the date range
        $query->whereBetween('created_at', [
            Carbon::parse($data['startDate'])->hour(0)->minute(0)->second(0)->toDateString(),
            Carbon::parse($data['endDate'])->addDay()->hour(23)->minute(59)->second(59)->toDateString()
        ]);

        if (auth()->user()->user_account != '8') {
            $query->where('officer_id', auth()->user()->employeemodel->id);
        }

		$query->orderBy('id','desc');
		$data['list'] = $query->paginate(10);
        $data['branches'] = Branches::all();

        // Check if the request is AJAX
        if ($request->ajax()) {
            return response()->json($data);
        }

        return view('admin.performance.loan_collection', compact('data'));
    }

    public function downloadLoanCollection(Request $request)
    {
        $branch = $request->input('branch');

        $officer = $request->input('officer');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $export = new LoanCollectionPerformanceExport($startDate, $endDate, $branch, $officer);
        $fileName = 'loan_payments_performance.xlsx';

        return (new FastExcel($export->export()))->download($fileName);
    }

    public function processingFee(Request $request) {
        $data = [];
        $query = ProcessingFeePayments::query()->whereNotNull('loan_number');

        // Check if the request has branch and add it to the query
        if ($request->has('branch')) {
            $query->where('branch_id', $request->branch);
        }

        // Check if the request has officer_id and add it to the query
        if ($request->has('officer')) {
            $query->where('officer_id', $request->officer);
        }

        // Get the start date and end date from the request or set default values
        $data['startDate'] = $request->has('startDate') ? Carbon::parse($request->startDate)->toDateString() : Carbon::now()->subDays(70000)->toDateString();
        $data['endDate'] = $request->has('endDate') ? Carbon::parse($request->endDate)->toDateString() : Carbon::now()->toDateString();

        // Filter by the date range
        $query->whereBetween('created_at', [
            Carbon::parse($data['startDate'])->hour(0)->minute(0)->second(0)->toDateString(),
            Carbon::parse($data['endDate'])->addDay()->hour(23)->minute(59)->second(59)->toDateString()
        ]);

        if (auth()->user()->user_account != '8') {
            $query->where('officer_id', auth()->user()->employeemodel->id);
        }

		$query->orderBy('id','desc');
		$data['list'] = $query->paginate(10);
        $data['branches'] = Branches::all();

        // Check if the request is AJAX
        if ($request->ajax()) {
            return response()->json($data);
        }
        
        return view('admin.performance.processing_fee', compact('data'));
    }

    public function downloadProcessingFee(Request $request)
    {
        $branch = $request->input('branch');

        $officer = $request->input('officer');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $export = new ProcessingFeePerformanceExport($startDate, $endDate, $branch, $officer);
        $fileName = 'processing_fee_performance.xlsx';

        return (new FastExcel($export->export()))->download($fileName);
    }

    public function loanGuaranteeFund(Request $request) {
        $data = [];
        $query = ClientLgfContributions::query();

        // Check if the request has branch and add it to the query
        if ($request->has('branch')) {
            $query->where('branch_id', $request->branch);
        }

        // Check if the request has officer_id and add it to the query
        if ($request->has('officer')) {
            $query->where('officer_id', $request->officer);
        }

        // Get the start date and end date from the request or set default values
        $data['startDate'] = $request->has('startDate') ? Carbon::parse($request->startDate)->toDateString() : Carbon::now()->subDays(70000)->toDateString();
        $data['endDate'] = $request->has('endDate') ? Carbon::parse($request->endDate)->toDateString() : Carbon::now()->toDateString();

        // Filter by the date range
        $query->whereBetween('date', [
            Carbon::parse($data['startDate'])->hour(0)->minute(0)->second(0)->toDateString(),
            Carbon::parse($data['endDate'])->addDay()->hour(23)->minute(59)->second(59)->toDateString()
        ]);

        if (auth()->user()->user_account != '8') {
            $clientIds = Clients::where('officer_id', auth()->user()->employeemodel->id)->pluck('id');
            $query->whereIn('client', $clientIds);
        }

        $query->orderBy('id','desc');
		$data['list'] = $query->paginate(10);
        $data['branches'] = Branches::all();

        // Check if the request is AJAX
        if ($request->ajax()) {
            return response()->json($data);
        }

        return view('admin.performance.loan_guarantee_fund', compact('data'));
    }

    public function downloadLoanGuaranteeFund(Request $request)
    {
        $branch = $request->input('branch');

        $officer = $request->input('officer');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $export = new LoanGuaranteeFundPerformanceExport($startDate, $endDate, $branch, $officer);
        $fileName = 'loan_guarantee_fund_performance.xlsx';

        return (new FastExcel($export->export()))->download($fileName);
    }
}