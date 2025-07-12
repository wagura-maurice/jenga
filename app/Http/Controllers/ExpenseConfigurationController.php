<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\PaymentModes;
use Illuminate\Http\Request;
use App\ExpenseConfiguration;

class ExpenseConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['list'] = ExpenseConfiguration::all();

        return view('admin.expense_configuration.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['types'] = Accounts::where('financial_category', 2)->get();
        $data['paymentmodes'] = PaymentModes::all();
        $data['accounts'] = Accounts::all();

        return view('admin.expense_configuration.create', compact('data'));
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
            $configuration = new ExpenseConfiguration;
            $configuration->expense_type = $request->expense_type;
            $configuration->payment_mode = $request->payment_mode;
            $configuration->debit_account = $request->debit_account;
            $configuration->credit_account = $request->credit_account;
            $configuration->save();
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('expenseconfiguration.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExpenseConfiguration  $expenseConfiguration
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseConfiguration $expenseConfiguration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExpenseConfiguration  $expenseConfiguration
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['configuration'] = ExpenseConfiguration::find($id);
        $data['types'] = Accounts::where('financial_category', 2)->get();
        $data['paymentmodes'] = PaymentModes::all();
        $data['accounts'] = Accounts::all();

        return view('admin.expense_configuration.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpenseConfiguration  $expenseConfiguration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $configuration = ExpenseConfiguration::find($id);
            $configuration->expense_type = $request->expense_type ?? $configuration->expense_type;
            $configuration->payment_mode = $request->payment_mode ?? $configuration->payment_mode;
            $configuration->debit_account = $request->debit_account ?? $configuration->debit_account;
            $configuration->credit_account = $request->credit_account ?? $configuration->credit_account;
            $configuration->save();

        } catch (\Throwable $th) {
            // throw $th;
        }

        return redirect()->route('expenseconfiguration.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpenseConfiguration  $expenseConfiguration
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $configuration = ExpenseConfiguration::find($id);
            $configuration->delete();
        } catch (\Throwable $th) {
            // throw $th;
        }

        return redirect()->route('expenseconfiguration.index');
    }
}
