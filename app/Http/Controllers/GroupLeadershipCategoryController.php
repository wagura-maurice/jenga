<?php

namespace App\Http\Controllers;

use App\GroupLeadershipCategory;
use Illuminate\Http\Request;

class GroupLeadershipCategoryController extends Controller
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
     * @param  \App\GroupLeadershipCategory  $groupLeadershipCategory
     * @return \Illuminate\Http\Response
     */
    public function show(GroupLeadershipCategory $groupLeadershipCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupLeadershipCategory  $groupLeadershipCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupLeadershipCategory $groupLeadershipCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupLeadershipCategory  $groupLeadershipCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupLeadershipCategory $groupLeadershipCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupLeadershipCategory  $groupLeadershipCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupLeadershipCategory $groupLeadershipCategory)
    {
        //
    }
}
