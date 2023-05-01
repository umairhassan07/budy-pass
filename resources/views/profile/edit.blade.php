@extends('layouts.app')


{{-- page title --}}
@section('title', 'Update Profile')

@section('content')

    <div class="profile-page-header">
        <h2 class="my-profile"> <a href="{{ route('profile') }}" class="back-icon"><i class="fi fi-rr-angle-left"></i></a> edit
            profile picture
        </h2>
        <a href="#" class="bars-for-mobile"><i class="fi fi-rr-bars-sort"></i></a>
    </div>
    <p class="edit_profile_desc">Profile picture getting stale? <br> Edit your picture below.</p>

    <form id="profile-image-form" enctype="multipart/form-data">
        <div class="buddy_profile_view">
            <label for="profile_image" id="edit_profile_prevew" style="background: url({{ $user->profile }})">
                <i class="fi fi-rr-picture"></i>
                <span>change photo</span>
                <input type="file" name="profile_img" id="profile_image">
            </label>
            <button type="submit" class="prfoile_invite update-profile-image">save changes</button>
        </div>
    </form>
@endsection

@section('right-side')
    <!-- right side profile -->
    <div class="settings-tab">
        <ul>
            <li><a href="#"> Settings <i class="fi fi-rr-cross-small"></i></a></li>
            <li>notifications
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                </div>
            </li>
            <li>invitations
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
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

    {{-- update image using ajax --}}
    <script>
        $(document).ready(function() {
            $('#profile-image-form').submit(function(event) {
                event.preventDefault(); // prevent the form from submitting normally

                // disable button
                $('.update-profile-image').prop('disabled', true);
                $('.update-profile-image').text('processing...');


                // csrf token set up
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // get form data
                var formData = new FormData(this);

                // ajax request
                $.ajax({
                    url: "{{ route('profile.update') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            $('.update-profile-image').prop('disabled', false);
                            $('.update-profile-image').text('successfull');
                        }
                    },
                    error: function(jqXHR, textStatus, errorMessage) {
                        console.log(errorMessage);
                        $('.update-profile-image').prop('disabled', false);
                        $('.update-profile-image').text('save changes');
                    }
                });
            });
        });
    </script>

    {{-- show image preview --}}
    <script>
        $(document).ready(function() {
            $('#profile_image').change(function() {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#edit_profile_prevew').css('background', 'url(' + e.target.result + ')');
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>


@endsection
