<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile Picture</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @include('layouts.header')

</head>

<body>

    <div class="container profile-picture-container">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-12 col-md-6 col-lg-4">

                <div class="__center-f justify-content-around min-vh-100">
                    <div class="header text-start align-self-start">
                        <h5 class="common-welcome-page-heading">profile picture</h5>
                        <p class="common-welcome-page-tagline">you're a superstar! take the best picture of YOU. </p>
                    </div>

                    <form method="post" id="profile-image-form">
                        @csrf
                        <div class="align-self-start d-flex w-100 gap-2 profile-img-holder">
                            <img src="{{ asset('assets/images/portrait.png') }}" alt="pic"
                                class="img-fluid preview-image">

                            <div class="w-100" id="img-box" onclick="{document.getElementById('img-input').click()}">
                                <input class="d-none" type="file" name="" id="img-input">

                                <div class="tab-to-upload">
                                    <i class="fa-solid fa-camera __text-green"></i>
                                    <p class="__text-grey">tap to upload</p>
                                </div>
                            </div>

                        </div>



                        <div class="align-self-start">
                            <h4 class="photo-description">happy with your photo?</h4>
                            <p class="f_desc">We want you to look amazing on camera!</p>
                            <p class="sec_des"> Make sure you are looking directly at the camera and
                                smiling. If you don’t feel like smiling, try a slight smirk or even just some eye
                                contact.
                            </p>
                            <p class="th_desc">This will help make any photo look more natural and
                                engaging.</p>
                        </div>

                        <div class="w-100">
                            <button type="submit" class="btn btn-primary w-100 border-0 upload_picture">submit my
                                photo</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

    {{-- show image preview --}}
    <script>
        $("#img-input").on("change", function() {
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".preview-image").attr("src", e.target.result);
            }
            reader.readAsDataURL(file);
        });
    </script>


    {{-- update profile image  --}}
    <script>
        $(document).ready(function() {
            $('#profile-image-form').on('submit', function(e) {
                e.preventDefault();

                $('.upload_picture').prop('disabled', true);
                $('.upload_picture').text('processing');

                // ajax header setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formData = new FormData();
                var imageFile = $('#img-input')[0].files[0];
                formData.append('image', imageFile);
                $.ajax({
                    url: "{{ route('upload-pic-post') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $('.upload_picture').prop('disabled', false);
                            $('.upload_picture').text('Successfull');
                            window.location.href = "{{ route('interests') }}"
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error)
                        $('.upload_picture').prop('disabled', false);
                        $('.upload_picture').text('submit my photo');
                    }
                });

            });
        });
    </script>

    <!-- BOOTSTRAP JS FILES -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>

</html>
