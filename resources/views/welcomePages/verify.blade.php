<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify</title>

    @include('layouts.header')

</head>

<?php

if (isset($_GET['phone_number'])) {
    $phone = $_GET['phone_number'];
}
?>



<body>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-12 col-md-6 col-lg-4">

                <div class="__center-f justify-content-around min-vh-100">

                    <div class="d-flex flex-column w-100 align-items-center justify-content-center gap-4 mb-5 pb-5">
                        <div class="header text-start align-self-start mt-0">
                            <h5 class="confirmation_heading">confirmation</h5>
                            <p class="__text-grey confirmation_p">enter the 4 digit code sent to your phone number
                                to verify
                            </p>
                        </div>
                        <form action="{{ route('verify-code') }}" method="post" id="verify_form">
                            @csrf
                            <div class="pin-code d-flex gap-3">
                                <input class="form-control __input __sign-input" required name="first" type="number"
                                    maxlength="1" autofocus>
                                <input class="form-control __input __sign-input" required name="second" type="number"
                                    maxlength="1">
                                <input class="form-control __input __sign-input" required name="third" type="number"
                                    maxlength="1">
                                <input class="form-control __input __sign-input" required name="fourth" type="number"
                                    maxlength="1">
                            </div>
                            <input type="hidden" name="phone_number" value="<?= isset($phone) ? $phone : '' ?>">

                            <div class="align-self-start">

                                <p class="__text-grey mb-0">didn’t receive any code?</p>
                                <a href="#" class="link-primary align-self-start">resend code</a>
                            </div>


                            <p class="incorrect_code_error"><i class="fi fi-rr-info d-flex fs-4"></i></p>

                    </div>

                    <a href="{{ route('login') }}" class="try_different_number">try a different phone number</a>
                    <button class="verify-btn">verify</button>
                    {{-- <div class="w-100">
                        <button type="submit" class="btn btn-primary w-100 border-0 verify-btn">verify</button>
                    </div> --}}
                    </form>
                </div>


            </div>
        </div>
    </div>





    {{-- validations --}}
    <script>
        $(document).ready(function() {
            $('#verify_form').submit(function(event) {
                event.preventDefault();

                $('.verify-btn').text('verifying...');
                $('.verify-btn').prop('disabled', true);

                var allFieldsFilled = true;
                $('.__input.__sign-input').each(function() {
                    if ($(this).val() === '') {
                        allFieldsFilled = false;
                        $(this).addClass('error');
                        $(this).focus();
                        return false; // stop the loop if one field is empty
                    } else {
                        $(this).removeClass('error');
                    }
                });

                if (allFieldsFilled) {
                    // submit the form via AJAX
                    var formData = $(this).serialize();
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('verify-code') }}",
                        data: formData,
                        success: function(data) {
                            // handle success response
                            if (data.error) {
                                $('.incorrect_code_error').css('display', 'flex');
                                $('.incorrect_code_error').text(data.msg);
                                $('.verify-btn').prop('disabled', false);
                                $('.verify-btn').text('verify');
                            }

                            if (data.success) {
                                $('.verify-btn').text('verified');


                                if (data.profile_status == 'personal-info') {
                                    window.location.href = "{{ route('signup') }}";
                                } else if (data.profile_status === 'upload-picture') {
                                    window.location.href = "{{ route('upload-picture') }}";
                                } else if (data.profile_status === 'interests') {
                                    window.location.href = "{{ route('interests') }}";
                                }

                            }
                        },
                        error: function(xhr, status, error) {
                            // handle error response
                            console.log(error);
                        }
                    });



                } else {
                    // display an error message
                    alert('Please fill out all the required fields.');
                    $('.verify-btn').prop('disabled', false);
                    $('.verify-btn').text('verify');
                }
            });
        });
    </script>



    <script>
        // pin Code entering
        var pinContainer = document.querySelector(".pin-code");

        pinContainer.addEventListener('keyup', function(event) {
            var target = event.srcElement;

            var maxLength = parseInt(target.attributes["maxlength"].value, 10);
            var myLength = target.value.length;

            if (myLength >= maxLength) {
                var next = target;
                while (next = next.nextElementSibling) {
                    if (next == null) break;
                    if (next.tagName.toLowerCase() == "input") {
                        next.focus();
                        break;
                    }
                }
            }

            if (myLength === 0) {
                var next = target;
                while (next = next.previousElementSibling) {
                    if (next == null) break;
                    if (next.tagName.toLowerCase() == "input") {
                        next.focus();
                        break;
                    }
                }
            }
        }, false);

        pinContainer.addEventListener('keydown', function(event) {
            var target = event.srcElement;
            target.value = "";
        }, false);
    </script>



    {{-- script js file --}}
    <script src="{{ asset('assets/js/script.js') }}"></script>


    <!-- BOOTSTRAP JS FILES -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>

</html>
