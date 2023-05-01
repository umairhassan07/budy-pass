@extends('layouts.app')


{{-- page title --}}
@section('title', 'Buddy Profile')


@section('content')
    <div class="profile_page_tp">
        <h2 class="buddy_name"><a href="{{ url()->previous() }}"><i class="fi fi-rr-angle-small-left"></i></a>
            {{ $buddy->firstName }} {{ $buddy->lastName }}</h2>
        <a data-bs-toggle="modal" href="#report_user_modal" role="button"><i class="fi fi-rr-menu-dots-vertical"></i></a>
    </div>


    <?php
    $interestIcons = [
        'art & theater' => 'fi-rr-mask-carnival',
        'live music' => 'fi-rr-music',
        'sports' => 'fi-rr-volleyball',
        'biking / hiking' => 'fi-rr-biking',
        'dancing / nightclub' => 'fi-rr-ferris-wheel',
        'dining out' => 'fi-rr-restaurant',
        'gaming / cards / board games' => 'fi-rr-gamepad',
        'movies' => 'fi-rr-play-alt',
        'meditation / yoga / gym' => 'fi-rr-gym',
        'walking / running / skating' => 'fi-rr-ice-skate',
    
        // Add more interests and icons as needed
    ];
    ?>

    <div class="buddy_profile_view">
        <img src="{{ !empty($buddy->profile) ? $buddy->profile : asset('assets/images/buddies/buddy-1.png') }}"
            alt="buddy profile detail">
        <div class="content_profile_view">
            <h5>{{ $buddy->firstName }} {{ $buddy->lastName }}</h5>
            <span>hi, i am {{ $buddy->firstName }}. my top interests are</span>



            @foreach ($buddy->interests->unique() as $interest)
                <p class="com-p">
                    @if (isset($interestIcons[$interest->name]))
                        <i class="fi {{ $interestIcons[$interest->name] }}"></i>
                    @endif
                    {{ $interest->name }}
                </p>
            @endforeach



            <div class="grouped_info">
                <div class="buds">
                    <p>17</p>
                    <p>buddies</p>
                </div>
                <div class="rsvp">
                    <p>3</p>
                    <p>rsvp’d</p>
                </div>
                <div class="events">
                    <p>7</p>
                    <p>events</p>
                </div>
            </div>
            <button class="prfoile_invite" data-bs-toggle="modal" href="#event_invite_modal" role="button">invite</button>

        </div>
    </div>


    <!-- modals -->
    @include('buddies.report-modal')
    @include('buddies.invite-modal')
@endsection





@section('scripts')
    <!-- script for range filter modal -->
    <script>
        const range = document.querySelectorAll(".range-slider span input");
        progress = document.querySelector(".range-slider .progress");
        let gap = 0.1;
        const inputValue = document.querySelectorAll(".numberVal input");

        range.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minRange = parseInt(range[0].value);
                let maxRange = parseInt(range[1].value);

                if (maxRange - minRange < gap) {
                    if (e.target.className === "range-min") {
                        range[0].value = maxRange - gap;
                    } else {
                        range[1].value = minRange + gap;
                    }
                } else {
                    progress.style.left = (minRange / range[0].max) * 100 + "%";
                    progress.style.right = 100 - (maxRange / range[1].max) * 100 + "%";
                    inputValue[0].value = minRange;
                    inputValue[1].value = maxRange;
                }
            });
        });
    </script>

@endsection
