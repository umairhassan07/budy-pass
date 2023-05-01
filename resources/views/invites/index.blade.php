@extends('layouts.app')


{{-- page title --}}
@section('title', 'Create Events')

@section('content')

    <!-- page start -->
    <div class="profile_page_tp">
        <h2 class="create_event">invites </h2>
    </div>


    <!-- select category -->
    <div class="select_cates">
        <div class="cates-list">

            @foreach ($interests as $key => $interest)
                <div class="cates-div">
                    <input type="radio" class="btn-check" name="interests" id="category{{ $key + 1 }}"
                        value="{{ $interest->id }}" autocomplete="off">

                    <label class="btn btn_for_categories" for="category{{ $key + 1 }}">{{ $interest->name }}</label>
                </div>
            @endforeach

        </div>
    </div>

    <div class="notifications-tab">



        @forelse ($invites as $invite)
            <!-- notification row  -->

            <div class="notification-row category-{{ $invite['event']->interest->id }}">
                <div>
                    <img class="user-img"
                        src="{{ isset($invite['inviter']->profilePicture) ? asset('storage/images/' . $invite['inviter']->profilePicture) : 'assets/images/buddies/buddy-1.png' }} "
                        alt="notification row image">
                    <p class="descriptoin_notification"><span class="name_noti"><a
                                href="{{ route('buddy.profile', ['id' => $invite['inviter']->id]) }}"
                                class="inviter_name">{{ $invite['inviter']->firstName }}</a></span>.
                        invited
                        you
                        to an <span class="catie_noti"><a href="{{ route('event.detail', ['id' => $invite['event']->id]) }}"
                                class="event_category">{{ $invite['event']->interest->name }}</a>
                        </span> event at
                        {{ $invite['event']->ev_location }} <span class="time-ago">{{ $invite['time-ago'] }}</span></p>
                </div>
                <img class="notifi-img"
                    src="{{ isset($invite['event']->ev_image) ? asset('storage/events/' . $invite['event']->ev_image) : 'assets/images/upload-thumbnail.png' }}"
                    alt="images">
            </div>

            <!-- notification row end -->
        @empty
            <p class="text-center">No invites found.</p>
        @endforelse
    </div>


@endsection


@section('scripts')

    <script>
        var categoryRadios = document.getElementsByName('interests');

        for (var i = 0; i < categoryRadios.length; i++) {
            categoryRadios[i].addEventListener('change', function(event) {
                var selectedCategory = event.target.value;

                filterNotificationsByCategory(selectedCategory);
            });
        }
    </script>

    {{-- filter function --}}
    <script>
        function filterNotificationsByCategory(category) {
            console.log(category, 'category-' + category);
            var notifications = document.querySelectorAll('.notification-row');
            for (var i = 0; i < notifications.length; i++) {
                console.log(notifications[i].classList.contains('category-' + category));
                if (notifications[i].classList.contains('category-' + category)) {
                    notifications[i].style.display = 'flex';
                } else {
                    notifications[i].style.display = 'none';
                }
            }
        }
    </script>
@endsection
