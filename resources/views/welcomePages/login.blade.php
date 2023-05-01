<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login page</title>


    @include('layouts.header')
</head>


<body>

  


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-10 col-md-6 col-lg-4">

                <div class="__center-f justify-content-around min-vh-100">
                    <div class="header text-start align-self-start">
                        <h5 class="login-heading">login</h5>
                        <p class="login-description">Enter your phone number to get started
                        </p>
                    </div>

                    <form action="{{ route('send-sms') }}" method="post">
                        @csrf
                        <div class="form-floating mb-5 w-100">
                            <input type="number" class="form-control __input rounded-4" id="floatingInput"
                                placeholder="12343445" name="phone_number">
                            <label for="floatingInput" class="__text-grey">Mobile Number</label>
                        </div>
                        @error('phone_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mt-5 d-grid gap-2">
                            <div class="form-check login-aggrement">
                                <input class="form-check-input" required type="checkbox" value="agree-terms"
                                    id="flexCheckDefault">
                                <label class="form-check-label agreement-label" for="flexCheckDefault">
                                    i agree to the <a href="#" class="link-primary">terms of use</a> and <a
                                        href="#" class="link-primary">privacy policy</a> <br> of buddy pass
                                </label>
                            </div>
                            <button class="login-button">login</button>
                    </form>
                    <p class="text-start align-self-start __text-grey">or continue with</p>

                    <div class="d-flex gap-2 align-self-start">
                        <a href="{{ url('authorized/google') }}" class="btn __tag-btn"><i
                                class="fa-brands fa-google"></i></a>
                        <a href="#" class="btn __tag-btn"><i class="fa-brands fa-apple"></i></a>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>



    <!-- jquery file link -->
    <script src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>

    <!-- BOOTSTRAP JS FILES -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>

</html>
