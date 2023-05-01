@extends('layouts.app')


{{-- page title --}}
@section('title', 'Saved Events')

@section('content')

    <!-- ACCOUNT header -->
    <div class="terms_header d-flex justify-content-between mb-3">
        <div class="d-flex align-items-center gap-1">
            <a href="{{ route('profile') }}" class="btn border-0"><i class="fi fi-rr-angle-left"></i></a>
            <h5 class="fw-bold">saved events</h5>
        </div>
        <button class="btn border-0"><i class="fi fi-rr-menu-dots-vertical"></i></button>
    </div>

    <div class="events-feed">

        @if (count($bookmarked_events) == 0)
            <div class="no-events-found">
                <a href="{{ route('savedEvents') }}">
                    <i class="fi fi-rr-refresh"></i>
                </a>
                <p> No Saved Events <br> couldn’t find any events.</p>
            </div>
        @else
            @foreach ($bookmarked_events as $event)
                <!-- event row -->
                <div class="event-div">
                    <img src="{{ !empty($event->event_image) ? $event->event_image : asset('assets/images/events/ev-img.png') }}"
                        alt="event cover image">
                    <!-- event-created-by -->
                    <div class="event-created-by">
                        <img src="{{ !empty($event->ev_creator_image) ? $event->ev_creator_image : asset('assets/images/buddies/buddy-1.png') }}"
                            alt="">
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
                            <i class="fi bookmark-icon fi-rr-bookmark" data-event-id="{{ $event->id }}"></i>
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
