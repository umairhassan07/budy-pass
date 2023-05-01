<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>

    @include('layouts.header')
    {{-- for valiations --}}
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    {{-- select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />


</head>


<body>


    {{-- get loggedin user data --}}
    <?php $user = Auth()->user(); ?>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sx-12 col-11 col-md-6 col-lg-4">

                <div class="__center-f justify-content-around min-vh-100">
                    <div class="header text-start align-self-start">
                        <h5 class="confirmation_heading">personal info</h5>
                        <p class="__text-grey confirmation_p">tell us more about yourself. this will let others know who
                            you
                            are</p>
                    </div>

                    <form id="personal_information" method="post">
                        @csrf
                        <div class="d-grid gap-4 personal">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control __input rounded-3" id="floatingInput"
                                            placeholder="12343445" id="firstName" name="firstName"
                                            value="{{ isset($user->firstName) ? $user->firstName : '' }}">
                                        <label for="floatingInput" class="__text-grey">first name</label>
                                    </div>
                                </div>
                                <div class="col-6 ps-0">
                                    <div class="form-floating">
                                        <input type="text" class="form-control __input rounded-3" id="floatingInput"
                                            placeholder="12343445" id="lastName" name="lastName"
                                            value="{{ isset($user->lastName) ? $user->lastName : '' }}">
                                        <label for="floatingInput" class="__text-grey">last name</label>
                                    </div>
                                </div>
                            </div>
                            <!-- city -->
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-floating">
                                        <input type="text" class="form-control __input rounded-3" id="floatingInput"
                                            placeholder="12343445" id="city" name="city"
                                            value="{{ isset($user->city) ? $user->city : '' }}">
                                        <label for="floatingInput" class="__text-grey">City</label>
                                    </div>
                                </div>
                                <div class="col-4 ps-0">
                                    <div class="form-floating">
                                        <input type="text" class="form-control __input rounded-3" id="floatingInput"
                                            placeholder="12343445" id="state" name="state"
                                            value="{{ isset($user->state) ? $user->state : '' }}">
                                        <label for="floatingInput" class="__text-grey">State</label>
                                    </div>
                                </div>
                            </div>
                            <!-- zip -->
                            <div class="row w-100">
                                <div class="col pe-0">
                                    <div class="form-floating">
                                        <input type="text" class="form-control __input rounded-3" id="floatingInput"
                                            placeholder="12343445" id="zipCode" name="zipcode"
                                            value="{{ isset($user->zipCode) ? $user->zipCode : '' }}">
                                        <label for="floatingInput" class="__text-grey">Zip Code</label>
                                    </div>
                                </div>

                            </div>
                            <!-- date -->
                            <p class="text-start align-self-start __text-grey mb-0">date of birth</p>
                            <div class="row">
                                <div class="col-3 ">
                                    <div class="form-floating">
                                        <input type="text" class="form-control __input rounded-3" id="date_day"
                                            placeholder="12343445" id="day_date" name="day" maxlength="2"
                                            min="1" max="99">
                                        <label for="date_day" class="__text-grey">dd</label>
                                    </div>
                                </div>
                                <div class="col-3 ps-0">
                                    <div class="form-floating">
                                        <input type="text" class="form-control __input rounded-3" id="date_month"
                                            placeholder="12343445" id="month_date" name="month" maxlength="2"
                                            min="1" max="12">
                                        <label for="date_month" class="__text-grey">mm</label>
                                    </div>
                                </div>
                                <div class="col-6 ps-0">
                                    <div class="form-floating">
                                        <input type="text" class="form-control __input rounded-3"
                                            id="floatingInput" placeholder="12343445" id="year_date" name="year"
                                            maxlength="4">
                                        <label for="floatingInput" class="__text-grey">yyyy</label>
                                    </div>
                                </div>

                                {{-- location & calendar permission --}}
                                <input type="hidden" id="location_per" value="false">
                                <input type="hidden" id="calendar_per" value="false">
                            </div>
                        </div>
                        <button class="common_btn submit_person_info">continue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('welcomePages.models.location-model')
    @include('welcomePages.models.calendar-model')




    {{-- submit personal info --}}
    <script>
        $('#personal_information').on('submit', function(e) {
            e.preventDefault();

            // show calendar modal
            $('#calenderModal').modal('show');

            // show location modal
            $('#locationModal').modal('show');


            $('#locationModal').on('hidden.bs.modal', function(e) {

                var calendar_permission = $('#calendar_per').val();
                var location_permission = $('#location_per').val();

                // get form data 
                var formData = $('#personal_information').serialize();

                // if location permission is givin, get lat&long
                if (location_permission == 'true') {

                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var latitude = position.coords.latitude;
                            var longitude = position.coords.longitude;

                            formData += '&latitude=' + latitude + '&longitude=' + longitude;

                            // Send the AJAX request
                            $.ajax({
                                type: 'POST',
                                url: "{{ route('personal_info') }}",
                                data: formData,
                                success: function(data) {
                                    // handle success response
                                    if (data.error != true) {
                                        window.location.href =
                                            "{{ route('upload-picture') }}";
                                    }
                                },
                                error: function(xhr, status, error) {
                                    // handle error response
                                    console.log(error);
                                }
                            });

                        });
                    }
                }

            });

        });
    </script>



    {{-- location & calendar modal  --}}
    <script>
        $('#locationModal .allow_location').on('click', function() {
            $('#location_per').val('true');
        });

        $('#calenderModal .allow_calender').on('click', function() {
            $('#calendar_per').val('true');
        });
    </script>


    <!-- BOOTSTRAP JS FILES -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

</body>

</html>
