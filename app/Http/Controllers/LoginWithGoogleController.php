<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginWithGoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {


            $user = Socialite::driver('google')->with(['prompt' => 'consent'])->user();


            $full_name = $user->name;
            $name_parts = explode(' ', $full_name);
            $first_name = $name_parts[0];
            $middle_name = $name_parts[1];
            $last_name = $middle_name . ' ' . implode(' ', array_slice($name_parts, 2));

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                $user = Auth()->user();

                return redirect()->route('home');

            } else {

                $newUser = new User();
                $newUser->firstName = $first_name;
                $newUser->lastName = $last_name;
                $newUser->google_id = $user->id;
                $newUser->save();

                Auth::login($newUser);
                return redirect()->route('signup');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}