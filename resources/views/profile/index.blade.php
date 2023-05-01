@extends('layouts.app')


{{-- page title --}}
@section('title', 'Profile')

@section('content')

    <div class="profile-page-header">
        <h2 class="my-profile">my profile</h2>
        <a href="#" class="bars-for-mobile"><i class="fi fi-rr-bars-sort"></i></a>
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
        <img src="{{ $user->profile }}" alt="profile picture">
        <div class="content_profile_view">
            <h5>{{ $user->firstName . ' ' . $user->lastName }}.</h5>
            <span>hi, i am {{ $user->firstName }}. my top interests are</span>
            @foreach ($user->interests as $interest)
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
                    <p>{{ count($user->events) }}</p>
                    <p>events</p>
                </div>
            </div>
            <a class="prfoile_invite" href="{{ route('profile.edit', ['id' => $user->id]) }}">edit profile</a>

        </div>
    </div>
@endsection

@section('right-side')
    <!-- right side profile -->
    <div class="settings-tab">
        {{-- {{ dd($user->notifications) }} --}}
        <ul>
            <li><a href="#"> Settings <i class="fi fi-rr-cross-small"></i></a></li>
            <li>notifications
                <div class="form-check form-switch">
                    <input class="form-check-input notification_checkbox" {{ $user->notifications == 1 ? 'checked' : '' }}
                        type="checkbox" id="flexSwitchCheckChecked">
                </div>
            </li>
            <li>invitations
                <div class="form-check form-switch">
                    <input class="form-check-input invitataions_checkbox" {{ $user->invitations == 1 ? 'checked' : '' }}
                        type="checkbox" id="flexSwitchCheckChecked">
                </div>
            </li>
            <li><a href="{{ route('terms') }}"> terms of use <i class="fi fi-rr-arrow-small-right"></i></a></li>
            <li><a href="{{ route('privacy') }}"> privacy note <i class="fi fi-rr-arrow-small-right"></i></a></li>
            <li><a href="{{ route('faq') }}"> faqs <i class="fi fi-rr-arrow-small-right"></i></a></li>
            <li><a href="{{ route('myAccount') }}"> my account <i class="fi fi-rr-arrow-small-right"></i></a></li>
            <li><a href="{{ route('savedEvents') }}"> saved events <i class="fi fi-rr-arrow-small-right"></i></a></li>
            <li><a data-bs-toggle="modal" href="#logout_modal" role="button"> Logout <i
                        class="fi fi-rr-sign-out-alt"></i></a></li>
        </ul>
    </div>


    {{-- logout modal --}}
    @include('profile.logout-modal')
@endsection


@section('scripts')

    {{-- update notications --}}
    <script>
        $('.notification_checkbox').on('change', function() {
            var check = $(this).prop('checked');
            $.ajax({
                url: "{{ route('notification_update') }}",
                type: 'POST',
                data: {
                    check: check ? 1 : 0
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

    {{-- update invitatios --}}
    <script>
        $('.invitataions_checkbox').on('change', function() {
            var check = $(this).prop('checked');

            $.ajax({
                url: "{{ route('invitation_update') }}",
                type: 'POST',
                data: {
                    check: check ? 1 : 0
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        })
    </script>
@endsection
