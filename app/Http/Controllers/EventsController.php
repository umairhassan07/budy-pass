<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Events;
use App\Models\BookmarkEvents;
use App\Models\User;
use App\Models\EventAttendees;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;



class EventsController extends Controller
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
        $user = Auth::user();

        $eventAttendees = EventAttendees::with('user')
            ->where('attendee_invited_by', $user->id)
            ->where('attendee_status', 'confirmed')
            ->get();
        return view('events.create', compact('user', 'eventAttendees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // make time from hours, minutes and AM or PM
        $time = \DateTime::createFromFormat('h:i A', $request->hours . ':' . $request->minutes . ' ' . $request->amORpm);
        $time = $time->format('h:i:s A');

        // Get the logged in user
        $user_id = Auth::id();

        // create new event
        $event = new Events();

        // if event image is selected
        if (!empty($request->file('event_thumbnail'))) {
            $image = $request->file('event_thumbnail');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();

            // Store the new image file
            Storage::put('public/events/' . $imageName, file_get_contents($image));

            $event->ev_image = $imageName;
        }

        $event->ev_date = $request->event_date;
        $event->ev_time = $time;
        $event->ev_title = $request->event_title;
        $event->interest_id = $request->interests;
        $event->ev_location = $request->event_location;
        $event->ev_description = $request->event_description;
        $event->max_capacity = $request->max_capacity;
        $event->ev_offer = $request->offer;

        $event->user_id = $user_id;
        $event->save();


        // invite selected buddies 
        if (!empty($request->input('selected_profiles'))) {
            $profiles = explode(',', $request->input('selected_profiles'));

            // get inserted event id
            $event_id = $event->id;

            // get loggedin user id
            $loggedin = Auth()->id();

            foreach ($profiles as $profile) {
                $profile_id = decrypt($profile);
                $event_attendee = new EventAttendees();
                $event_attendee->event_id = $event_id;
                $event_attendee->attendee_invited_by = $loggedin;
                $event_attendee->attendee_id = $profile_id;
                $event_attendee->save();
            }
        }

        return response()->json([
            'success' => 'true',
            'msg' => 'Event Created Successfully!'
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

    // saved events
    public function savedEVents()
    {
        $user_id = Auth()->id();
        $bookmarked_event_ids = BookmarkEvents::where('user_id', $user_id)->pluck('event_id');

        // Get the event data for the bookmarked events
        $bookmarked_events = Events::whereIn('id', $bookmarked_event_ids)->get();

        foreach ($bookmarked_events as $event) {

            $url = asset('storage/events/' . $event->ev_image);
            $event['event_image'] = $url;

            $event['ev_creator'] = $event->user['firstName'] . ' ' . $event->user['lastName'] . '.';

            // append user image with event
            $create_image = asset('storage/images/' . $event->user->profilePicture);
            $event['ev_creator_image'] = $create_image;
        }

        return view('events.saved-events', compact('bookmarked_events'));
    }

    public function event_details($id)
    {
        // get all events
        $event = Events::where('id', $id)->first();

        // get loggedin user id
        $loggedInID = Auth()->id();

        // get all users with interest level without the loggedin user
        $users = User::where('id', '!=', $loggedInID)
            ->with('interests')
            ->get();

        // get users based on interest same with event
        $interested_users = array();
        $invited_users = array();

        foreach ($users as $user) {

            foreach ($user->interests as $interest) {
                if ($interest->id == $event['interest_id']) {

                    // append users interest on the user array
                    $user['interest_level'] = $interest->pivot->interest_leve;
                    $user['profile'] = asset('storage/images/' . $user->profilePicture);

                    // check if user already exists in interested_users array
                    if (!in_array($user->id, array_column($interested_users, 'id'))) {
                        array_push($interested_users, $user);
                    }

                    // check if the user is already invited
                    $is_invited = \DB::table('event_attendees')
                        ->where('event_id', $event->id)
                        ->where('attendee_id', $user->id)
                        ->where('attendee_invited_by', $loggedInID)
                        ->where('attendee_status', 'pending')
                        ->exists();

                    if ($is_invited) {
                        array_push($invited_users, $user->id);
                    }
                }
            }

        }


        // Sort the array in descending order by interest level
        usort($interested_users, function ($a, $b) {
            return $b['interest_level'] - $a['interest_level'];
        });


        // check the pending invitations for loggedin user.
        $invitations = EventAttendees::with('inviter')
            ->where('event_id', $event->id)
            ->where('attendee_id', $loggedInID)
            ->where('attendee_status', 'pending')
            ->get();



        if ($invitations->count() > 0) {
            $event['invitations'] = $invitations;
        } else {
            $event['invitations'] = NULL;
        }


        // event image full url
        $url = asset('storage/events/' . $event->ev_image);
        $event['event_image'] = $url;

        $event['ev_creator'] = $event->user['firstName'] . ' ' . $event->user['lastName'] . '.';

        // append user image with event
        $create_image = asset('storage/images/' . $event->user->profilePicture);
        $event['ev_creator_image'] = $create_image;

        return view('events.event-detail', compact('event', 'interested_users', 'invited_users'));
    }


    // bookmark event
    public function eventBookmark(Request $request)
    {
        // get event ID from request
        $eventID = $request->input('event_id');

        // $uid = Events::where('id', $eventID)->first()->user_id;
        $uid = Auth()->id();

        // create bookmarkEvents object
        $bookmark = new BookmarkEvents();

        if ($request->input('insert') == 'true') {
            $bookmark->user_id = $uid;
            $bookmark->event_id = $eventID;

            $bookmarkInserted = $bookmark->save();

            if ($bookmarkInserted && $bookmark->wasRecentlyCreated) {
                return response()->json([
                    'insert' => 'true',
                    'msg' => 'Event saved!'
                ]);
            } else {
                return response()->json([
                    'insert' => 'false',
                    'msg' => 'Failed to save event!'
                ]);
            }
        } else {

            $del = BookmarkEvents::where('event_id', $eventID)->delete();
            if ($del) {
                return response()->json([
                    'delete' => 'true',
                    'msg' => 'Record deleted successfully!'
                ]);
            } else {
                return response()->json([
                    'delete' => 'false',
                    'msg' => 'Record not found!'
                ]);
            }
        }
    }


    // check if evet is bookmarked or not
    public function bookmarkCheck(Request $request)
    {
        $user_id = Auth()->id();
        // $event_id = (int) $request->event_id;

        if (!empty($request->event_id)) {


            $eve_ids = array();

            foreach ($request->event_id as $event_id) {
                $bookmarked = BookmarkEvents::where('user_id', $user_id)->where('event_id', (int) $event_id)->first();

                if (!empty($bookmarked)) {
                    $eve_ids[] = $event_id;
                    $bookmark = true;
                }
            }


            if (($bookmark)) {
                return response()->json([
                    'bookmarked' => 'true',
                    'msg' => 'EVent bookmarked!',
                    'ev_id' => $eve_ids

                ]);
            } else {
                return response()->json([
                    'bookmarked' => 'false',
                    'msg' => 'event not bookmarked!'
                ]);
            }
        }

    }


    // add event to google calendar
    public function add_to_google(Request $request)
    {
        //create a new event
        $event = new Event;

        $event->name = 'A new event';
        $event->description = 'Event description';

        $event->startDateTime = Carbon::parse($request->start_date);
        $event->endDateTime = Carbon::parse($request->end_date);

        $event->addAttendee([
            'email' => 'john@example.com',
            'name' => 'John Doe',
            'comment' => 'Lorum ipsum',
        ]);

        $event->addAttendee(['email' => 'anotherEmail@gmail.com']);

        dd($event->save());

        // get all future events on a calendar
        $events = Event::get();

        // update existing event
        $firstEvent = $events->first();
        $firstEvent->name = 'updated name';
        $firstEvent->save();

        $firstEvent->update(['name' => 'updated again']);

        // create a new event
        Event::create([
            'name' => 'A new event',
            'startDateTime' => Carbon\Carbon::now(),
            'endDateTime' => Carbon\Carbon::now()->addHour(),
        ]);

        // delete an event
        $event->delete();
    }


    // reject invite
    public function rejectInvitation(Request $request)
    {
        $original_id = decrypt($request->input('invite'));
        $invitation = EventAttendees::findOrFail($original_id);
        $invitation->attendee_status = 'declined';
        $invitation->save();
        return response()->json([
            'success' => true,
            'message' => 'Invitation rejected successfully'
        ]);

    }

}