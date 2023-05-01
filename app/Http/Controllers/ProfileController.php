<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Events;
use Illuminate\Support\Facades\Storage;
use Str;



class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $url = asset('storage/images/' . $user->profilePicture);
        $user['profile'] = $url;

        $userWithEvents = User::with('events')->find($user->id);

        $user['events'] = $userWithEvents->events;

        return view('profile.index', compact('user'));
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
        $user = User::where('id', $id)->first();

        $url = asset('storage/images/' . $user->profilePicture);
        $user['profile'] = $url;

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // get image from request
        $image = $request->file('profile_img');

        // Get the logged in user
        $user_id = Auth::id();

        // generate unique image name
        $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();

        $old_image = User::where('id', $user_id)->first();
        if (!empty($old_image->profilePicture)) {
            // Delete the old image file
            Storage::delete('public/images/' . $old_image->profilePicture);
        }

        // Update the image filename in the database
        $user = User::where('id', $user_id)->update([
            'profilePicture' => $filename
        ]);

        // Store the new image file
        Storage::put('public/images/' . $filename, file_get_contents($image));

        return response()->json([
            'success' => 'true',
            'msg' => 'Image updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function myAccount()
    {
        return view('profile.my-account');

    }

    public function notification_check_update(Request $request)
    {
        $check = $request->input('check');
        $loggedin_ID = Auth()->id();
        User::where('id', $loggedin_ID)->update([
            'notifications' => $check
        ]);

        return response()->json([
            'success' => 'true',
            'msg' => 'Notifications Updated Successfully!'
        ]);

    }

    public function invitation_check_update(Request $request)
    {
        $check = $request->input('check');
        $loggedin_ID = Auth()->id();
        User::where('id', $loggedin_ID)->update([
            'invitations' => $check
        ]);

        return response()->json([
            'success' => 'true',
            'msg' => 'Onvitations Updated Successfully!'
        ]);

    }
}