<?php

namespace App\Http\Controllers;

use App\Users;
use App\Clients;
use App\Enquiry;
use App\Branches;
use Carbon\Carbon;
use App\EnquiryCategory;
use Illuminate\Http\Request;

class EnquiryController extends Controller
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

        $data['categories'] = EnquiryCategory::all();

        $data['lists'] = Enquiry::with('category', 'client', 'by', 'to', 'location')
        ->orderBy('id', 'desc')
        // ->paginate(10)
        ->get();
        
        $data['users'] = Users::all();

        return view('admin.clients.enquiry.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];

        $data['categories'] = EnquiryCategory::all();
        $data['clients'] = Clients::all();
        $data['users'] = Users::all();
        $data['user'] = auth()->user();
        $data['branches'] = Branches::all();
        
        return view('admin.clients.enquiry.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enquiry = new Enquiry;
        $enquiry->_pid = generatePID(Enquiry::class);
        $enquiry->category_id = $request->category_id;

        if(isset($request->client_id)) {
            $client = Clients::find($request->client_id);

            $enquiry->client_id = $client->id;

            if(isset($client)) {
                $enquiry->customer_name = $client->first_name. ' '. $client->last_name;
                $enquiry->customer_email = $client->email_address;
                $enquiry->customer_phone_number = $client->primary_phone_number;
            }
        } else {
            $enquiry->customer_name = $request->customer_name;
            $enquiry->customer_email = $request->customer_email;
            $enquiry->customer_phone_number = $request->customer_phone_number;
        }

        $enquiry->topic = $request->topic;
        $enquiry->content = $request->content;
        $enquiry->topic_type = $request->topic_type;
        $enquiry->occurrence_date = Carbon::parse($request->occurrence_date)->toDateTimeString();
        $enquiry->escalated_by = auth()->user()->id;
        $enquiry->escalated_to = $request->escalated_to;
        $enquiry->branch = $request->branch;
        $enquiry->_status = $request->_status;
        $enquiry->save();

        return redirect()->route('client.enquiry.catalog.index')->with('success','enquiry successfully created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];

        $data['enquiry'] = Enquiry::find($id);
        $data['categories'] = EnquiryCategory::all();
        $data['clients'] = Clients::all();
        $data['users'] = Users::all();
        $data['branches'] = Branches::all();

        return view('admin.clients.enquiry.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];

        $data['enquiry'] = Enquiry::find($id);
        $data['categories'] = EnquiryCategory::all();
        $data['clients'] = Clients::all();
        $data['users'] = Users::all();
        $data['branches'] = Branches::all();

        return view('admin.clients.enquiry.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        $enquiry->category_id = $request->category_id ?? $enquiry->category_id;

        if(isset($request->client_id)) {
            $client = Clients::find($request->client_id);

            $enquiry->client_id = $client->id;

            if(isset($client)) {
                $enquiry->customer_name = $client->first_name. ' '. $client->last_name;
                $enquiry->customer_email = $client->email_address;
                $enquiry->customer_phone_number = $client->primary_phone_number;
            }
        } else {
            $enquiry->customer_name = $request->customer_name ?? $enquiry->customer_name;
            $enquiry->customer_email = $request->customer_email ?? $enquiry->customer_email;
            $enquiry->customer_phone_number = $request->customer_phone_number ?? $enquiry->customer_phone_number;
        }

        $enquiry->topic = $request->topic ?? $enquiry->topic;
        $enquiry->content = $request->content ?? $enquiry->content;
        $enquiry->topic_type = $request->topic_type ?? $enquiry->topic_type;
        $enquiry->occurrence_date = Carbon::parse($request->occurrence_date ?? $enquiry->occurrence_date)->toDateTimeString();
        $enquiry->escalated_by = $request->escalated_by ?? $enquiry->escalated_by;
        $enquiry->escalated_to = $request->escalated_to ?? $enquiry->escalated_to;
        $enquiry->branch = $request->branch ?? $enquiry->branch;
        $enquiry->_status = $request->_status ?? $enquiry->_status;
        $enquiry->save();

        return redirect()->route('client.enquiry.catalog.index')->with('success','enquiry successfully created!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enquiry = Enquiry::find($id);

        $enquiry->delete();

        return redirect()->route('client.enquiry.catalog.index')->with('success','enquiry successfully deleted!');
    }
}
