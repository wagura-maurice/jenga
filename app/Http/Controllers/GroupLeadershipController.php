<?php

namespace App\Http\Controllers;

use App\GroupLeadership;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GroupLeadershipController extends Controller
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
        if ($request->command == 'add') {
            if (GroupLeadership::where([
                'group_id' => $request->group_id,
                'client_id' => $request->client_id
            ])->where('vacated_at', '=', NULL)->exists()) {
                // 
            } else {
                $leadership = new GroupLeadership;
                $leadership->group_id = $request->group_id;
                $leadership->category_id = $request->category_id;
                $leadership->client_id = $request->client_id;
                $leadership->occupied_at = Carbon::now()->toDateTimeString();
                $leadership->save();
            };
        } elseif ($request->command == 'change') {
            if (GroupLeadership::where([
                'group_id' => $request->group_id,
                'client_id' => $request->client_id
            ])->where('vacated_at', '=', NULL)->exists()) {
                // 
            } else {
                $currentLeadership = GroupLeadership::where([
                    'group_id' => $request->group_id,
                    'category_id' => $request->category_id
                ])
                    ->where('vacated_at', '=', NULL)
                    // ->orderBy('id', 'DESC')
                    ->first();

                $currentLeadership->vacated_at = Carbon::now()->toDateTimeString();
                $currentLeadership->save();

                $leadership  = new GroupLeadership;
                $leadership->group_id = $request->group_id;
                $leadership->category_id = $request->category_id;
                $leadership->client_id = $request->client_id;
                $leadership->occupied_at = Carbon::now()->toDateTimeString();
                $leadership->save();
            }
        } elseif ($request->command == 'remove') {
            $currentLeadership = GroupLeadership::where([
                'group_id' => $request->group_id,
                'category_id' => $request->category_id
            ])
                ->where('vacated_at', '=', NULL)
                // ->orderBy('id', 'DESC')
                ->first();

            $currentLeadership->vacated_at = Carbon::now()->toDateTimeString();
            $currentLeadership->save();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupLeadership  $groupLeadership
     * @return \Illuminate\Http\Response
     */
    public function show(GroupLeadership $groupLeadership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupLeadership  $groupLeadership
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupLeadership $groupLeadership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupLeadership  $groupLeadership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupLeadership $groupLeadership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupLeadership  $groupLeadership
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupLeadership $groupLeadership)
    {
        //
    }
}
