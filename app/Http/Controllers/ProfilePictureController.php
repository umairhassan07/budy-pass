<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Str;


class ProfilePictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcomePages.profile-picture');
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

        // get image from request
        $image = $request->file('image');

        // generate unique image name
        $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();

        // Get the logged in user
        $user_id = Auth::id();

        // get old image and delete it
        $old_image = User::where('id', $user_id)->first();
        if (!empty($old_image->profilePicture)) {
            // Delete the old image file
            Storage::delete('public/images/' . $old_image->profilePicture);
        }

        // Update the image filename in the database
        $user = User::where('id', $user_id)->update([
            'profilePicture' => $filename,
            'profileStatus' => 'interests'

        ]);

        // Store the new image file
        Storage::put('public/images/' . $filename, file_get_contents($image));

        return response()->json([
            'success' => 'true',
            'msg' => 'The image updated successfully!'
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