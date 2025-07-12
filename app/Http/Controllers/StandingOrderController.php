<?php

namespace App\Http\Controllers;

use App\Loans;
use App\Users;
use App\Clients;
use App\Accounts;
use App\Branches;
use App\ClientLgfBalances;
use Carbon\Carbon;
use App\StandingOrder;
use Illuminate\Http\Request;
use App\StandingOrderCategory;

class StandingOrderController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        $data['users'] = Users::all();
        $data['clients'] = Clients::all();
        $data['lists'] = StandingOrder::withTrashed()
            ->with('category', 'client', 'by', 'source', 'destination')
            ->orderBy('id', 'desc')
            // ->paginate(10)
            ->get();

        return view('admin.standing_orders.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['client'] = Clients::find($request->client_id);
        $data['categories'] = StandingOrderCategory::all();
        $data['balance'] = ClientLgfBalances::where('client', $request->client_id)->orderBy('id', 'DESC')->first();
        $data['loans'] = Loans::where('client', $request->client_id)->get();
        $data['users'] = Users::all();

        return view('admin.standing_orders.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $order = new StandingOrder;
        $order->_pid = generatePID(StandingOrder::class);
        $order->category_id = $request->category_id;
        $order->client_id = $request->client_id;
        $order->escalated_by = $request->escalated_by;
        $order->source_account = $request->source_account;
        $order->destination_account = $request->destination_account;
        $order->frequency = $request->frequency;
        $order->start_date = Carbon::parse($request->start_date)->toDateTimeString();
        $order->end_date = Carbon::parse($request->end_date)->toDateTimeString();
        $order->amount = $request->amount;
        $order->reason = $request->reason;
        $order->_narrative = $request->_narrative;
        $order->next_transfer = Carbon::parse($request->start_date)->addDay()->toDateTimeString();
        $order->_status = $request->_status;

        $order->save();

        return redirect()->route('standing.order.index')->with('success','Standing order successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StandingOrder  $standingOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];

        $data['order'] = StandingOrder::find($id);
        // dd($data['order']);
        $data['client'] = Clients::find($data['order']->client_id);
        $data['categories'] = StandingOrderCategory::all();
        $data['balance'] = ClientLgfBalances::where('client', $data['order']->client_id)->orderBy('id', 'DESC')->first();
        $data['loans'] = Loans::where('client', $data['order']->client_id)->get();
        $data['users'] = Users::all();

        return view('admin.standing_orders.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StandingOrder  $standingOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(StandingOrder $standingOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StandingOrder  $standingOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StandingOrder $standingOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StandingOrder  $standingOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $order = StandingOrder::where('id', $id)->withTrashed()->first();

        $order->_narrative = isset($request->_narrative) ? trim($request->_narrative) : NULL;
        $order->save();

        if ($request->action == 'deactivate') {
            $order->delete();

            return response()->json([
                'icon' => 'success',
                'message' => 'Standing order successfully deactivated!'
            ]);
        } elseif ($request->action == 'activate') {
            $order->deleted_at = NULL;
            $order->save();

            return response()->json([
                'icon' => 'success',
                'message' => 'Standing order successfully activated!'
            ]);
        } else {
            return response()->json([
                'icon' => 'warning',
                'message' => 'Ops! Standing order deletion unsuccessful, please try again!'
            ]);
        }
    }
}
