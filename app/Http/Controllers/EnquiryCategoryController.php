<?php

namespace App\Http\Controllers;

use App\EnquiryCategory;
use Illuminate\Http\Request;

class EnquiryCategoryController extends Controller
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
        //
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
     * @param  \App\EnquiryCategory  $enquiryCategory
     * @return \Illuminate\Http\Response
     */
    public function show(EnquiryCategory $enquiryCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EnquiryCategory  $enquiryCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(EnquiryCategory $enquiryCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EnquiryCategory  $enquiryCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnquiryCategory $enquiryCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EnquiryCategory  $enquiryCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnquiryCategory $enquiryCategory)
    {
        //
    }
}
