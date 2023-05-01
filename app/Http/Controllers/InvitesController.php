<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interest;
use App\Models\EventAttendees;
use Carbon\Carbon;


class InvitesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $interests = Interest::all();

        $invites = EventAttendees::where('attendee_id', Auth()->id())->get();

        $invites = $invites->map(function ($invite) {
            $invite['inviter'] = $invite->inviter;
            $invite['event'] = $invite->event;
            $invite['interest'] = $invite['event']->interest;
            $invite['time-ago'] = Carbon::parse($invite->created_at)->diffForHumans();
            return $invite;
        })
            ->sortBy('created_at')
            ->reverse()
            ->values();

        return view('invites.index', compact('interests', 'invites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}