<?php

namespace App\Http\Controllers;

use App\Loans;
use App\Users;
use App\Clients;
use App\Modules;
use App\LoanFine;
use Carbon\Carbon;
use App\LoanProducts;
use App\PaymentModes;
use App\UsersAccountsRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanFineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fines = LoanFine::with('loan','product','client')
			->orderBy('id', 'DESC');

		if($request->loan_number) {
			$loan = Loans::where('loan_number', $request->loan_number)->first();

			if (isset($loan->id)) {
				$fines->where('loan_id', $loan->id);
			}
		}

        if($request->product) {
			$fines->where('product_id', $request->product);
		}

        if($request->client_number) {
			$client = Clients::where('client_number', $request->client_number)->first();

			if (isset($client->id)) {
				$fines->where('client_id', $client->id);
			}
		}

		if($request->start_date && $request->end_date) {
			$fines->whereBetween('fine_date', [Carbon::parse($request->start_date)->toDateString(), Carbon::parse($request->end_date)->toDateString()]);
		}

		if($request->status) {
			$fines->where('status', $request->status);
		}
		
		$data['list'] = $fines->paginate(100);
        $data['products'] = LoanProducts::all();
		$data['status'] = $request->status ?? NULL;

        $user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Loans']])->get();
		$data['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();

		if ($data['usersaccountsroles'][0]['_add'] == 0 && $data['usersaccountsroles'][0]['_list'] == 0 && $data['usersaccountsroles'][0]['_edit'] == 0 && $data['usersaccountsroles'][0]['_edit'] == 0 && $data['usersaccountsroles'][0]['_show'] == 0 && $data['usersaccountsroles'][0]['_delete'] == 0 && $data['usersaccountsroles'][0]['_report'] == 0) {
			return View('admin.error.denied', compact('data'));
		} else {
			return View('admin.loans.fines.index', compact('data'));
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LoanFine  $loanFine
     * @return \Illuminate\Http\Response
     */
    public function show(LoanFine $loanFine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LoanFine  $loanFine
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['fine'] = LoanFine::where(['id' => $id])->with('loan', 'product', 'client')->first();
        $data['loans'] = Loans::all();
        $data['paymentmodes'] = PaymentModes::all();

        // dd($data['fine']->toArray());

        return View('admin.loans.fines.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoanFine  $loanFine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $fine = LoanFine::find($id);
            $fine->_status = $request->_status ?? $fine->_status;
            $fine->_narrative = $request->_narrative ?? $fine->_narrative;
            $fine->save();

            return response()->json([
                'icon' => 'success',
                'message' => 'loan fined updated successfully'
            ], 200);

        } catch (\Throwable $th) {
            // throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LoanFine  $loanFine
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoanFine $loanFine)
    {
        //
    }
}
