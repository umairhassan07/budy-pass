<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BuddiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all buddies from users table.
        $buddies = User::with('interests')->where('id', '<>', Auth()->id())->get();

        // calculate interest percentage
        foreach ($buddies as $buddy) {

            $totalInterestLevel = 0;
            $totalPossibleInterestLevel = 0;

            foreach ($buddy->interests as $interest) {

                $totalInterestLevel += $interest->pivot->interest_leve;
                $totalPossibleInterestLevel += 10;
            }

            $interestPercentage = 0;
            if ($totalInterestLevel != 0) {
                $interestPercentage = round(($totalInterestLevel / $totalPossibleInterestLevel) * 100, 2);
            }

            $buddy['interest_percentage'] = $interestPercentage;

        }


        // sort buddies by interest_percentage in descending order
        $buddies = $buddies->sortByDesc('interest_percentage');


        return view('buddies.index', compact('buddies'));
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

    public function buddy_profile($id)
    {
        $buddy = User::where('id', $id)->first();

        // set full image url to the object
        $url = asset('storage/images/' . $buddy->profilePicture);
        $buddy['profile'] = $url;

        return view('buddies.buddy-profile', compact('buddy'));
    }


    public function invites_buddies()
    {
        return view('buddies.invite-buddies');
    }
}