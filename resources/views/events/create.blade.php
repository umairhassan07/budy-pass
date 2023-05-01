@extends('layouts.app')


{{-- page title --}}
@section('title', 'Create Events')

@section('content')
    <!-- page start -->
    <div class="profile_page_tp">
        <h2 class="create_event">create new event </h2>
        <a href="{{ route('home') }}" class="cancel_event">cancel</a>
    </div>

    <form id="create_event_form" enctype="multipart/form-data">

        <!-- select category -->
        <div class="select_cates">
            <div class="cates-list">
                @foreach ($user->interests as $key => $interest)
                    <div class="cates-div">
                        <input type="radio" class="btn-check" name="interests" id="category{{ $key + 1 }}"
                            value="{{ $interest->id }}" autocomplete="off">

                        <label class="btn btn_for_categories"
                            for="category{{ $key + 1 }}">{{ $interest->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- upload thumbnail -->
        <div class="thumbnail-div">
            <label for="thumbnail" id="thumbnail-preview">
                <i class="fi fi-rr-picture"></i>
                <span>upload thumbnail</span>
                <input type="file" id="thumbnail" name="event_thumbnail">
            </label>
        </div>

        <!-- event title -->
        <div class="location-div title_div">
            <label for="title">title</label>
            <input type="text" placeholder="Event title" name="event_title">
        </div>

        <!-- date & time -->
        <h4 class="date-time">date & time</h4>
        <div class="date-div">
            <input type="date" id="myDateField" name="event_date">
        </div>

        <!-- time div -->
        <div class="time-div">
            <input type="number" placeholder="hh" name="hours" min="1" max="12" pattern="\d*"
                maxlength="2">
            <input type="number" placeholder="mm" name="minutes" min="0" max="59" pattern="\d*"
                maxlength="2">
            <div class="am-pm">
                <select name="amORpm" id="">
                    <option value="am">AM</option>
                    <option value="pm">PM</option>
                </select>
            </div>
        </div>

        <!-- location -->
        <div class="location-div">
            <label for="location">location</label>
            <i class="fi fi-rr-map-marker"></i>
            <input type="text" placeholder="grand art theater" name="event_location">
        </div>

        <!-- description -->
        <div class="descript-div">
            <label for="description">description</label>
            <textarea name="event_description" placeholder="this is event is about..."></textarea>
        </div>

        <!-- invite buddies -->
        <div class="invite-buddies-div">
            <a data-bs-toggle="modal" href="#invite_buddies_modal" role="button" class="invite-buddies">invite buddies <i
                    class="fi fi-rr-user-add"></i></a>
            <div class="remaing_users">
                {{-- <a href="#" class="minus-margin-15"><img src="assets/images/events/event-2.png" alt=""></a>
                <a href="#" class="more_users">+7</a> --}}
            </div>
        </div>

        <!-- max capacity -->
        <div class="max-capacity-div">
            <label for="max-capacity">Max Capacity</label>
            <span>buddies</span>
            <input type="text" placeholder="10" name="max_capacity">
        </div>

        <!-- offer div -->
        <div class="offer-div">
            <label for="offer-div">What do you offer?</label>
            <input type="text" placeholder="I will..." name="offer">
        </div>

        <button class="common_btn bg_green_btn" type="submit">create event</button>

    </form>



    <!-- event created modal -->
    @include('events.event-modal')
    @include('events.invide-buddies-modal')
@endsection





@section('scripts')

    {{-- create event script --}}
    <script>
        $(document).ready(function() {

            $('#create_event_form').on('submit', function(e) {
                e.preventDefault();

                // disable button and change text
                $('.bg_green_btn').prop('disabled', true);
                $('.bg_green_btn').text('processing...');


                // csrf token setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formData = new FormData(this);

                // Get all selected profile IDs
                var selectedProfiles = [];
                $('.selected_profiles').each(function() {
                    selectedProfiles.push($(this).data('id'));
                });

                formData.append('selected_profiles', selectedProfiles);

                $.ajax({
                    url: "{{ route('event.store') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Code to handle successful response from the server
                        if (response.success) {
                            $('.bg_green_btn').prop('disabled', true);
                            $('.bg_green_btn').text('Successfull');
                            $('#event_created_modal').modal('show');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('.bg_green_btn').prop('disabled', false);
                        $('.bg_green_btn').text('create event');
                    }

                });


            });
        });
    </script>

    {{-- redirect on home page after the event is created --}}
    <script>
        $('#event_created_modal').on('hidden.bs.modal', function() {
            window.location.href = "{{ route('home') }}";
        });
    </script>


    {{-- add today's date to input --}}
    <script>
        // Get today's date
        var today = new Date();
        // Set the value of the input field
        document.getElementById("myDateField").value = today.toISOString().slice(0, 10);
    </script>


    <!-- upload thumbnail preview script -->
    <script>
        $(function() {
            $('#thumbnail').on('change', function(e) {
                var file = e.target.files[0];
                var reader = new FileReader();
                reader.onload = function() {
                    $('#thumbnail-preview').css('background-image', 'url(' + reader.result + ')');
                }
                reader.readAsDataURL(file);
            });
        });
    </script>


    {{-- invite selected --}}
    <script>
        const assetUrl = '{{ asset('') }}';
        $('.invite_selected').on('click', function() {

            $('.invite_selected').text('processing..');
            // Collect selected users' data
            const selectedUsers = [];
            $('#invite_buddies_modal input[type=checkbox]:checked').each(function(e) {
                const userId = $(this).data('id');
                const userImage = $(this).data('image');
                selectedUsers.push({
                    id: userId,
                    image: userImage
                });
            });

            // Update remaining users div
            const remaingUsersDiv = $('.remaing_users');
            if (selectedUsers.length > 0) {
                // Clear previous contents of div
                remaingUsersDiv.empty();
                // Add images of selected users
                $.each(selectedUsers, function(i, user) {
                    const userImg = $('<img>', {
                        src: assetUrl + 'storage/images/' + user.image,
                        alt: ''
                    });


                    const userLink = $('<a>', {
                        href: 'javascrtip:void(0)',
                        class: 'minus-margin-15 selected_profiles',
                        'data-id': user.id
                    }).append(userImg);
                    remaingUsersDiv.append(userLink);
                });
                // Add more users link if there are more than 5 users
                if (selectedUsers.length > 5) {
                    const moreUsersLink = $('<a>', {
                        href: '#',
                        class: 'more_users'
                    }).text('+' + (selectedUsers.length - 5));
                    remaingUsersDiv.append(moreUsersLink);
                }
                // Show the div
                remaingUsersDiv.show();
            } else {
                // Hide the div if no users are selected
                remaingUsersDiv.hide();
            }



            // hide the modal after 1 second
            setTimeout(function() {
                $('.invite_selected').text('successful!');
                $('#invite_buddies_modal').modal('hide');
                $('.invite_selected').text('done!');
            }, 1000);

            console.log(selectedUsers);
        });
    </script>

@endsection
