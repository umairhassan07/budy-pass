@extends('layouts.app')


{{-- page title --}}
@section('title', 'Event details')

@section('content')

    <div class="events-feed">
        <div class="back_btn">
            <h2><a href="{{ url()->previous() }}"><i class="fi fi-rr-angle-small-left"></i></a> event details</h2>

            {{-- show edit button for user who created the event --}}
            @if (auth()->id() == $event->user_id)
                <a data-bs-toggle="modal" href="#edit_event_modal" role="button"><i
                        class="fi fi-rr-menu-dots-vertical"></i></a>
            @endif
        </div>
        <!-- event row -->
        <div class="event-div">
            <img src="{{ !empty($event->event_image) ? $event->event_image : asset('assets/images/events/ev-img.png') }}"
                alt="event cover image">
            <!-- event-created-by -->
            <div class="event-created-by">
                <img src="{{ !empty($event->ev_creator_image) ? $event->ev_creator_image : asset('assets/images/buddies/buddy-1.png') }}"
                    alt="event thumnail">
                <h5>{{ $event->ev_creator }}</h5>
            </div>
            <div class="event-details">
                <div class="eve-first">
                    <i class="fi fi-rr-bars-sort gr-color"></i>
                    <a href="javascript:void(0)">
                        <h3 class="event_name">{{ $event->ev_title }}</h3>
                    </a>
                </div>
                <div class="eve_end">
                    <a href="#"><i class="fi fi-rr-share"></i></a>
                    <a href="#"><i class="fi fi-rr-bookmark bookmark-icon"
                            data-event-id="{{ $event->id }}"></i></a>
                </div>
            </div>
            <div class="address-row">
                <i class="fi fi-rr-map-marker"></i>
                <p class="event_location">{{ $event->ev_location }}</p>
            </div>
            <div class="date-row">
                <i class="fi fi-rr-calendar"></i>
                <span class="date_span">{{ $event->ev_date->format('M. j') }}</span>
                <span class="time_span">{{ $event->ev_time }}</span>
            </div>
            <div class="users_row">
                <i class="fi fi-rr-users-alt"></i>
                <p>13 of 20 rsvp’d</p>
                <div class="remaing_users">
                    <a href="#" class="minus-margin-15"><img
                            src="{{ asset('') }}/assets/images/events/event-2.png" alt=""></a>
                    <a href="#" class="minus-margin-15"><img
                            src="{{ asset('') }}/assets/images/events/event-2.png" alt=""></a>
                    <a href="#" class="minus-margin-15"><img
                            src="{{ asset('') }}/assets/images/events/event-2.png" alt=""></a>
                    <a href="#" class="minus-margin-15"><img
                            src="{{ asset('') }}/assets/images/events/event-2.png" alt=""></a>
                    <a href="#" class="minus-margin-15"><img
                            src="{{ asset('') }}/assets/images/events/event-2.png" alt=""></a>
                    <a href="#" class="more_users">+7</a>
                </div>
            </div>
            <div class="links_event">
                <a data-bs-toggle="modal" href="#location_event_modal" role="button">location on
                    maps</a>
                <a data-bs-toggle="modal" href="#calenderModal" role="button">add to calendar</a>
            </div>
            <div class="event_description">
                <p>{{ $event->ev_description }}</p>
            </div>
        </div>
        <!-- end event row -->
    </div>

@endsection


@section('matched_profiles')
    <div class="matched_profiles">
        <h4>perfect matches</h4>
        <div class="similar_profiles">
            @foreach ($interested_users as $user)
                @if ($user->id == $event->user_id)
                    @continue
                @endif
                <!-- profile div start -->
                <div class="profile_div">
                    <img src=" {{ isset($user->profile) ? $user->profile : asset('assets/images/events/event-2.png') }}"
                        alt="profile image">
                    <h4>{{ $user->firstName }} {{ $user->lastName }}</h4>
                    @if ($user->interest_level >= 7)
                        <p style="color: #44DC53;">{{ $user->interest_level }}0%</p>
                    @elseif ($user->interest_level >= 5)
                        <p style="color: #FF8A00;">{{ $user->interest_level }}0%</p>
                    @else
                        <p style="color: #FF0000;">{{ $user->interest_level }}0%</p>
                    @endif

                    {{-- checkif users is already invited or not. --}}
                    @if (in_array($user->id, $invited_users))
                        <button class="invite_button" disabled style="background:#cbced0">Invited</button>
                    @else
                        <button class="invite_button invite_to_event" data-event="{{ $event->id }}"
                            data-id="{{ $user->id }}">Invite</button>
                    @endif

                </div>
                <!-- end profile div -->
            @endforeach

        </div>
    </div>


    @include('events.invite-sent-modal')

    @include('events.invite-accept-reject-modal')

    @include('events.rsvp-modal')
    @include('events.edit-event-modal')
    @include('events.event-location-modal')
    @include('events.event-modal')
    @include('events.calendar-model')
@endsection


@section('scripts')

    @if (!empty($event['invitations']))
        <script>
            $(document).ready(function() {
                $('.parent-ar-div').css('display', 'block');
            });
        </script>
    @endif

    {{-- encode data --}}
    <script>
        $(document).ready(function() {
            $('.invite_to_event').each(function() {
                var eventId = $(this).data('event');
                var userId = $(this).data('id');
                var data = {
                    eventId: eventId,
                    userId: userId
                };

                var encodedData = btoa(JSON.stringify(data));
                $(this).attr('data-encoded', encodedData);
            });
        });
    </script>

    {{-- allow google calendar event --}}
    <script>
        $(document).ready(function() {
            $('#allow_calendar').on('click', function() {

                $.ajax({
                    url: "{{ route('calendar.google') }}",
                    method: 'post',
                    success: function(response) {
                        console.log(response);
                    },
                    error: function() {
                        console.log('failed');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.invite_to_event').on('click', function() {
                var button = $(this);
                var encodedData = button.data('encoded');

                button.text('processing...');
                button.prop('disabled', true);


                $.ajax({
                    url: "{{ route('invite.user') }}",
                    type: 'POST',
                    data: {
                        data: encodedData
                    },
                    success: function(response) {

                        if (response.status == 'success') {

                            $('#invite_sent_modal').modal('show');
                            button.text('Invited');
                            button.css('background-color', '#cbced0');

                        }
                    },
                    error: function(error) {
                        button.text('Invite');
                        console.log(error);
                    }
                });
            });

        });
    </script>

    {{-- invite reject script --}}
    <script>
        $('.reject_invite_btn').click(function() {
            var invitationId = $(this).attr('id');

            $('.reject_invite_btn').text('processing');

            $.ajax({
                url: "{{ route('invite.reject') }}",
                type: 'POST',
                data: {
                    invite: invitationId
                },
                success: function(data) {
                    if (data.success) {
                        $('.reject_invite_btn').text('rejected');
                    }
                    console.log(data);

                },
                error: function(error) {
                    console.log(error);
                    $('.reject_invite_btn').text('processing');
                }
            });
        });
    </script>
@endsection
