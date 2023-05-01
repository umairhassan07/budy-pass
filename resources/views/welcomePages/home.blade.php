@extends('layouts.app')


{{-- page title --}}
@section('title', 'Home Page')


@section('content')

    <style>
        .no-events-found {
            text-align: center;
            font-weight: 400;
            font-size: 13px;
            line-height: 16px;
            text-align: center;
            color: #88949C;
            margin-top: 150px;
        }

        .no-events-found .fi-rr-refresh {
            color: #1F3646;
        }

        .no-events-found a {
            display: inline-block;
            margin-bottom: 10px;
        }

        .no-events-found a:hover {
            opacity: 0.9;
        }
    </style>
    <div class="events-feed">
        <div class="greeting-user">
            <h2>hello, {{ Auth()->user()->firstName }}!</h2>
            <p class="greeting-para">here’s some events we’ve picked for you!</p>
        </div>

        @if (count($events) == 0)
            <div class="no-events-found">
                <a href="{{ route('home') }}">
                    <i class="fi fi-rr-refresh"></i>
                </a>
                <p> Refresh feed <br> couldn’t find any events.</p>
            </div>
        @else
            @foreach ($events as $event)
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
                            <a href="{{ route('event.detail', ['id' => $event->id]) }}">
                                <h3 class="event_name">{{ $event->ev_title }}</h3>
                            </a>
                        </div>
                        <div class="eve_end">
                            <a href="#"><i class="fi fi-rr-share"></i></a>
                            <i class="fi fi-rr-bookmark bookmark-icon" data-event-id="{{ $event->id }}"></i>

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
                </div>
                <!-- end event row -->
            @endforeach
        @endif

    </div>
@endsection
