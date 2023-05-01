<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Interests</title>

    @include('layouts.header')

    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <link rel="stylesheet" href="assets/range-slider-master/css/rSlider.min.css">
</head>


<body>


    <div class="container my-3">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-11 col-md-6 col-lg-4">

                <div class="__center-f justify-content-around ">
                    <div class="header text-start align-self-start">
                        <h3 class="h3 fw-bold mb-0">what are your interests?</h3>
                        <p class="__text-grey fw-normal lh-1 mb-1">tell us about your interests to find you buddies with
                            similar interests </p>
                        <p style="font-size: 14px;" class="fw-light __text-green">rate your interest from 1 to 10 in
                            each category</p>
                    </div>

                    <div class="__custom w-100">

                        <form id="interests_form" method="post">
                            @foreach ($interests as $key => $interest)
                                <div class="w-100 mb-4">
                                    <div class="range-header d-flex justify-content-between">
                                        <label for="customRange3" class="form-label">{{ $interest->name }}</label>
                                        <span class="__text-green">0</span>
                                    </div>
                                    <input type="range" max="10" min="0"
                                        name="interest-level[{{ $interest->id }}]" id="slider{{ $key + 1 }}"
                                        class="slider" />
                                </div>
                            @endforeach

                    </div>


                    <div class="w-100 mt-5">
                        <button type="submit" class="btn btn-primary w-100 border-0 submit_interests">let’s
                            go!</button>

                    </div>
                    </form>
                </div>


            </div>
        </div>
    </div>



    {{-- submit interests form --}}
    <script>
        $(document).ready(function() {
            $('#interests_form').on('submit', function(e) {
                e.preventDefault();

                $('.submit_interests').prop('disabled', true);
                $('.submit_interests').text('processing');

                // ajax header setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formData = $('#interests_form').serialize();

                $.ajax({
                    url: "{{ route('interests.store') }}",
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            $('.submit_interests').prop('disabled', false);
                            $('.submit_interests').text('Successfull');
                            window.location.href = "{{ route('home') }}"
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error)
                        $('.submit_interests').prop('disabled', false);
                        $('.submit_interests').text('submit my photo');
                    }
                });


            });
        });
    </script>



    <script src="assets/range-slider-master/js/rSlider.min.js"></script>

    <script>
        const allSliders = document.querySelectorAll('.slider');

        allSliders.forEach((slider, index) => {
            const newSlider = new rSlider({
                target: `slider${index + 1}`,
                values: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                range: false,
                tooltip: false,
                scale: true,
                labels: true,
                width: null,
                onChange: (value) => {
                    slider.previousElementSibling.lastElementChild.innerHTML = value;
                },
            });
        });
    </script>





    <!-- BOOTSTRAP JS FILES -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
