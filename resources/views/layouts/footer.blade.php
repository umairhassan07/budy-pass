<!-- FOOTER STARTS HERE -->
<footer>
    <!-- menu for mobile -->
    <div class="mobile_menu">
        <ul class="menu_for_mobile">
            <li><a href="{{ route('home') }}" class="{{ Request::routeIs('home') ? 'active' : '' }} "><i
                        class="fi fi-rr-home"></i></a></li>
            <li><a href="{{ route('buddies') }}" class="{{ Request::routeIs('buddies') ? 'active' : '' }}"><i
                        class="fi fi-rr-users-alt"></i> </a></li>
            <li><a href="{{ route('create-event') }}" class="{{ Request::routeIs('create-event') ? 'active' : '' }}"><i
                        class="fi fi-rr-square-plus"></i></a></li>
            <li><a href="{{ route('invites') }}" class="{{ Request::routeIs('invites') ? 'active' : '' }}"><i
                        class="fi fi-rr-envelope"></i> </a></li>
            <li> <a href="{{ route('profile') }}" class="{{ Request::routeIs('profile') ? 'active' : '' }}"><span
                        class="profile_image"><img src="assets/images/events/ev-img.png" alt=""></a></span>
            </li>
        </ul>
    </div>

</footer>



<!-- Page-specific scripts -->
@yield('scripts')

<!-- script -->

<script>
    $(document).ready(function() {
        $('.bookmark-icon').click(function() {

            // csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Get the event ID from the data attribute
            var eventId = $(this).data('event-id');
            var insert;

            // get clicked element classes
            var bookmarkClass = $(this).attr('class');

            if (bookmarkClass.includes('fi-rr-bookmark')) {
                insert = true;
            } else {
                insert = false;
            }


            // Send AJAX request to update the bookmark status
            $.ajax({
                url: "{{ route('event.bookmark') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    event_id: eventId,
                    insert: insert,
                },
                success: function(response) {
                    console.log(response);
                    // Update the bookmark icon class based on the response
                    if (response.insert) {
                        $('.bookmark-icon[data-event-id="' + eventId + '"]').removeClass(
                            'fi-rr-bookmark').addClass('fi-sr-bookmark');
                    }
                    if (response.delete) {
                        $('.bookmark-icon[data-event-id="' + eventId + '"]').removeClass(
                            'fi-sr-bookmark').addClass('fi-rr-bookmark');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(error);
                }
            });
        });
    });
</script>


{{-- check if event is bookmarked or not --}}
<script>
    $(document).ready(function() {
        // csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Get the event ID from the data attribute

        var eventIds = [];

        $('.bookmark-icon').each(function() {
            var eventId = $(this).data('event-id');
            eventIds.push(eventId);
        });

        // Define the data to send to the controller
        var dataToSend = {
            event_id: eventIds,
        };


        // Make an AJAX request to check if the event is bookmarked by the user
        $.ajax({
            url: "{{ route('bookmark.check') }}",
            type: 'POST',
            data: dataToSend,
            success: function(data) {

                // Update the class of the element based on the bookmark status
                if (data.bookmarked == 'true') {

                    data.ev_id.forEach(function(id) {
                        $('.bookmark-icon[data-event-id="' + id + '"]').removeClass(
                            'fi-rr-bookmark').addClass('fi-sr-bookmark');
                    });

                } else {
                    $('i.bookmark-icon').removeClass('fi-sr-bookmark').addClass(
                        'fi-rr-bookmark');
                }
            },
            error: function() {
                console.log('Error checking bookmark status');
            }
        });
    });
</script>


<!-- BOOTSTRAP JS FILES -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
