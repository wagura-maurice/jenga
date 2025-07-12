<?php

namespace App\Http\Controllers;

use App\Groups;
use App\Expense;
use App\Accounts;
use Carbon\Carbon;
use App\PaymentModes;
use App\GeneralLedgers;
use App\GroupCashBooks;
use App\TransactionStatuses;
use Illuminate\Http\Request;
use App\ExpenseConfiguration;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['list'] = Expense::all();

        return view('admin.expense.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['types'] = ExpenseConfiguration::join('accounts', 'accounts.id', '=', 'expense_configurations.expense_type')
            ->select('expense_configurations.payment_mode as payment_mode', 'accounts.id as account_id', 'accounts.code as account_code', 'accounts.name as account_name')
            ->where('accounts.financial_category', 2)
            ->get();

        $data['paymentmodes'] = PaymentModes::all();
        $data['transactionstatuses'] = TransactionStatuses::all();

        return view('admin.expense.create', compact('data'));
    }

    /**
     * The function "getPaymentModes" retrieves payment modes associated with a specific expense type
     * and returns them as a JSON response.
     * 
     * @param id The parameter "id" is used to filter the expense configurations based on the expense
     * type. It is used in the where clause of the query to retrieve only the expense configurations
     * that have the specified expense type.
     * 
     * @return a JSON response containing the payment modes associated with the given expense type ID.
     */
    public function getPaymentModes($id)
    {
        $paymentModes = ExpenseConfiguration::where('expense_configurations.expense_type', $id)
                        ->join('payment_modes', 'payment_modes.id', '=', 'expense_configurations.payment_mode')
                        ->get();

        return response()->json($paymentModes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            try {
                DB::transaction(function () use ($request) {
                    $expense = new Expense;
                    $expense->user_id = auth()->user()->id;
                    $expense->expense_type = $request->expense_type;
                    $expense->payment_mode = $request->payment_mode;
                    $expense->transaction_code = $request->transaction_code;
                    $expense->date = Carbon::parse($request->date)->toDateTimeString();
                    $expense->amount = $request->amount;
                    $expense->_status = $request->_status;
                    $expense->save();

                    $configuration = ExpenseConfiguration::where([
                        'expense_type' => $expense->expense_type,
                        'payment_mode' => $expense->payment_mode
                    ])->first();

                    if (isset($configuration) && !empty($configuration)) {
                        $group = Groups::where('group_number', 'I0001')->first();

                        // debit the group cash group
                        $group_cash_group_debit = new GroupCashBooks;
                        $group_cash_group_debit->officer_id = auth()->user()->id;
                        $group_cash_group_debit->branch_id = auth()->user()->branch_id;
                        $group_cash_group_debit->transaction_id = $expense->transaction_code;
                        $group_cash_group_debit->transacting_group = $group->id;
                        $group_cash_group_debit->transaction_reference = $expense->transaction_code;
                        $group_cash_group_debit->transaction_type = 1; // debit
                        $group_cash_group_debit->amount = $expense->amount;
                        $group_cash_group_debit->collecting_officer = auth()->user()->name;
                        $group_cash_group_debit->payment_mode = $expense->payment_mode;
                        $group_cash_group_debit->account = $configuration->debitaccountmodel->id;
                        $group_cash_group_debit->transaction_date = $expense->date;
                        $group_cash_group_debit->save();

                        // credit the group cash group
                        $group_cash_group_credit = new GroupCashBooks;
                        $group_cash_group_credit->officer_id = auth()->user()->id;
                        $group_cash_group_credit->branch_id = auth()->user()->branch_id;
                        $group_cash_group_credit->transaction_id = $expense->transaction_code;
                        $group_cash_group_credit->transacting_group = $group->id;
                        $group_cash_group_credit->transaction_reference = $expense->transaction_code;
                        $group_cash_group_credit->transaction_type = 2; // credit
                        $group_cash_group_credit->amount = $expense->amount;
                        $group_cash_group_credit->collecting_officer = auth()->user()->name;
                        $group_cash_group_credit->payment_mode = $expense->payment_mode;
                        $group_cash_group_credit->account = $configuration->creditaccountmodel->id;
                        $group_cash_group_credit->transaction_date = $expense->date;
                        $group_cash_group_credit->save();

                        // debit the general ledger
                        $general_ledger_debit = new GeneralLedgers;
                        $general_ledger_debit->account = $configuration->debitaccountmodel->id;
                        $general_ledger_debit->entry_type = 1; // debit
                        $general_ledger_debit->transaction_number = $expense->transaction_code;
                        $general_ledger_debit->amount = $expense->amount;
                        $general_ledger_debit->date = $expense->date;
                        $general_ledger_debit->save();

                        // credit the general ledger
                        $general_ledger_credit = new GeneralLedgers;
                        $general_ledger_credit->account = $configuration->creditaccountmodel->id;
                        $general_ledger_credit->entry_type = 2; // credit
                        $general_ledger_credit->transaction_number = $expense->transaction_code;
                        $general_ledger_credit->amount = $expense->amount;
                        $general_ledger_credit->date = $expense->date;
                        $general_ledger_credit->save();
                    }
                });
            } catch (\Throwable $th) {
                throw $th;
            }

            return redirect()->route('expense.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['expense'] = Expense::find($id);
        $data['types'] = Accounts::where('financial_category', 2)->get();
        $data['paymentmodes'] = PaymentModes::all();
        $data['transactionstatuses'] = TransactionStatuses::all();

        return view('admin.expense.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $expense = Expense::find($id);
            $expense->user_id = auth()->user()->id;
            $expense->expense_type = $request->expense_type ?? $expense->expense_type;
            $expense->payment_mode = $request->payment_mode ?? $expense->payment_mode;
            $expense->transaction_code = $request->transaction_code ?? $expense->transaction_code;
            $expense->date = Carbon::parse($request->date ?? $expense->date)->toDateTimeString();
            $expense->amount = $request->amount ?? $expense->amount;
            $expense->_status = $request->_status ?? $expense->_status;
            $expense->save();
        } catch (\Throwable $th) {
            // throw $th;
        }

        return redirect()->route('expense.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $expense = Expense::find($id);
            $expense->delete();
        } catch (\Throwable $th) {
            // throw $th;
        }

        return redirect()->route('expense.index');
    }
}
