<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SignupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcomePages.personal-info');
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

        $date_str = $request->input('day') . '-' . $request->input('month') . '-' . $request->input('year'); // format the date string as yyyy-mm-dd
        $dob = strtotime($date_str);

        $lat = $request->input('latitude');
        $long = $request->input('longitude');

        // get logged in user id
        $user_id = Auth::id();

        if (isset($lat) && isset($long)) {
            $user = User::where('id', $user_id)->update([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zipCode' => $request->input('zipcode'),
                'dob' => $dob,
                'latitude' => $lat,
                'longitude' => $long,
                'profileStatus' => 'upload-picture'
            ]);
        } else {
            $user = User::where('id', $user_id)->update([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zipCode' => $request->input('zipcode'),
                'dob' => $dob,
                'profileStatus' => 'upload-picture'
            ]);
        }

        return response()->json([
            'error' => 'false',
            'msg' => 'Record Updated Successfully!'
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