<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interest;
use App\Models\UserInterests;

class InterestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $interests = Interest::get();
        return view('welcomePages.interests', compact('interests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $interestLevels = $request->input('interest-level');

        $userId = Auth()->id();
        foreach ($interestLevels as $interestId => $level) {
            $userInterest = new UserInterests();
            $userInterest->user_id = $userId;
            $userInterest->interest_id = $interestId;
            $userInterest->interest_leve = $level;
            $userInterest->save();
        }

        return response()->json([
            'success' => 'true',
            'msg' => 'Interests added to the database!'
        ]);



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