<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Verification;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;




class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcomePages.login');
    }

    public function send_sms(Request $request)
    {

        // Validate the phone number input
        $validatedData = $request->validate([
            'phone_number' => 'required|numeric'
        ]);

        // Generate a random 4-digit verification code
        $verificationCode = rand(1000, 9999);

        // Send an SMS message containing the code to the specified phone number using the Infobip API
        $client = new Client([
            'base_uri' => "https://4mgmk8.api.infobip.com/",
            'headers' => [
                'Authorization' => "App 2d7062dd26b0f2fa40c77c99a42ba72c-6abc6fd1-c91b-4bb1-a9cf-65facb7ab2f6",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);

        $payload = [
            'messages' => [
                [
                    'from' => 'InfoSMS',
                    'destinations' => [
                        ['to' => $request->phone_number],
                    ],
                    'text' => 'Your verification code is: ' . $verificationCode,
                ]
            ]
        ];

        $response = $client->request(
            'POST',
            'sms/2/text/advanced',
            [
                RequestOptions::JSON => $payload,
            ]
        );



        // Insert the verification code into the database
        $verification = new Verification;
        $verification->phone_number = $request->phone_number;
        $verification->verification_code = $verificationCode;
        $verification->save();


        // Redirect the user to a new page to enter the code received via SMS
        return redirect()->route('verify', ['phone_number' => $request->input('phone_number')]);


    }

    public function verifyCode(Request $request)
    {

        // Get the code entered by the user
        $first = $request->input('first');
        $second = $request->input('second');
        $third = $request->input('third');
        $fourth = $request->input('fourth');

        $combined = $first . $second . $third . $fourth; // concatenate the values
        $number_entered = str_pad($combined, 4, "0", STR_PAD_LEFT); // create a 4-digit number with leading zeros



        // Get the phone number entered by the user
        $phoneNumber = $request->input('phone_number');

        // get verification code from db.
        $db_code = Verification::where('phone_number', $phoneNumber)->first();
        if (!empty($db_code) && isset($db_code)) {
            $db_code = $db_code->verification_code;


            // check if code matches with entered code
            if ($db_code === $number_entered) {
                $user = User::where('phone', $phoneNumber)->first();
                $first_time = false;
                if ($user) {
                    // If the user exists, log them in
                    Auth::login($user);
                    $user = Auth()->user();

                } else {
                    // If the user does not exist, create a new user and log them in
                    $user = new User();
                    $user->phone = $phoneNumber;
                    $user->profileStatus = 'personal-info';
                    $user->save();

                    Auth::login($user);
                }

                $user = Auth()->user();
                $profileStatus = $user->profileStatus;


                Verification::where('phone_number', $phoneNumber)->delete();
                return response()->json([
                    'success' => true,
                    'msg' => 'Number Verification Successful',
                    'profile_status' => $profileStatus
                ]);

            } else {
                // If the codes do not match, show an error message

                return response()->json([
                    'error' => 'true',
                    'msg' => 'the code you just entered is incorrect. Please recehck your code or send code again!'
                ]);

            }

        } else {
            return response()->json([
                'error' => 'true',
                'msg' => 'Phone number not found in database'
            ]);
        }


    }

    public function verify()
    {
        return view('welcomePages.verify');
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


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}