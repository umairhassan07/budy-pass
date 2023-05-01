<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventAttendees;

class EventAttendeesController extends Controller
{

    public function index()
    {
        //
    }

    // invite users to events
    public function store(Request $request)
    {
        $encodedData = $request->input('data');
        // decode encdoed data
        $decodedData = json_decode(base64_decode($encodedData), true);


        // get user id, loggedin user id, and event id
        $attendee_id = $decodedData['userId'];
        $eventID = $decodedData['eventId'];

        $loggedin = Auth()->user();

        try {
            $event_attendee = new EventAttendees();
            $event_attendee->event_id = $eventID;
            $event_attendee->attendee_id = $attendee_id;
            $event_attendee->attendee_invited_by = $loggedin->id;
            $event_attendee->attendee_status = 'pending';
            $event_attendee->save();

            return response()->json([
                'status' => 'success',
                'msg' => 'User Successfully Inivted'
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }


    }
}