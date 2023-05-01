<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Events;
use App\Models\BookmarkEvents;



class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $events = Events::orderBy('ev_date', 'desc')->orderBy('ev_time', 'desc')->get();

        $events = Events::where('ev_date', '>=', date('Y-m-d'))
            ->where(function ($query) {
                $query->where('ev_date', '>', date('Y-m-d'))
                    ->orWhere('ev_time', '>=', date('H:i:s'));
            })
            ->orderBy('ev_date', 'asc')
            ->orderBy('ev_time', 'asc')
            ->get();


        foreach ($events as $event) {

            $url = asset('storage/events/' . $event->ev_image);
            $event['event_image'] = $url;

            $event['ev_creator'] = $event->user['firstName'] . ' ' . $event->user['lastName'] . '.';

            // append user image with event
            $create_image = asset('storage/images/' . $event->user->profilePicture);
            $event['ev_creator_image'] = $create_image;
        }

        return view('welcomePages.home', compact('events'));
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