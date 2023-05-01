<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>

    @include('layouts.header')

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>

    <!-- Welcome Screen -->
    <div class="bg-black " id="welcome-sc">

        <div class="container">

            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-8 col-md-6">
                    <div class="__center-f justify-content-around min-vh-100 text-center">

                        <h3 data-aos="fade-up" class="display-2 text-white fw-bold mb-0">welcome <br> to</h3>

                        <img data-aos="zoom-in" data-aos-delay="100" src="assets/images/buddyApp_logo.png"
                            alt="logo" class="img-fluid mb-5" width="241">

                        <button id="welcome-btn" type="button" class="btn btn-primary rounded-pill px-5 py-2 mt-5"><i
                                class="fa-solid fa-arrow-right d-block"></i></button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End of Welcome Screen -->

    <!-- Carousel -->

    <div id="carousel" class="d-none">

        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="__center-f justify-content-around align-items-center min-vh-100">

                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-touch="true"
                            data-bs-ride="carousel" style="min-height: 80vh;">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="150">

                                    <h3 class="text-start align-self-start">lookin’ for a buddy?</h3>
                                    <img src="assets/images/1.png" class="carousel-img" alt="img">

                                    <div style="font-size: 15px;" class="ms-2">
                                        <p class="m-0 fw-light mt-2">
                                            if you're tired of going out alone, we've got your back!
                                        </p>
                                        <p class="m-0 fw-light my-1">
                                            Buddy Pass gets straight to the point.
                                        </p>
                                        <ul>
                                            <li>answer the interest survey</li>
                                            <li>see your matches</li>
                                            <li>invite them out for fun</li>
                                        </ul>

                                        <p class="m-0 fw-light"> it's fast, easy, and all about making connections.</p>
                                    </div>

                                </div>
                                <div class="carousel-item">
                                    <h3 class="text-start align-self-start">want to do something?</h3>
                                    <img src="assets/images/2.png" class="carousel-img" alt="img">

                                    <div style="font-size: 15px;" class="ms-2">
                                        <p class="m-0 fw-light mt-2">
                                            you're busy. we get it. Buddy Pass has curated events for you!
                                        </p>
                                        <ul class="mt-1">
                                            <li>search for posted events</li>
                                            <li>find a cool invitation</li>
                                            <li>rsvp to the event</li>
                                        </ul>

                                        <p class="m-0 fw-light"> find a group event that takes the stress away from
                                            making the first move.</p>
                                    </div>

                                </div>
                                <div class="carousel-item">
                                    <h3 class="text-start align-self-start">wanna hangout?</h3>
                                    <img src="assets/images/3.png" class="carousel-img" alt="img">

                                    <div style="font-size: 16px;" class="ms-2">
                                        <p class="m-0 fw-light mt-2">
                                            with Buddy Pass, you can easily create an event for other users to attend.
                                        </p>

                                        <ul class="mt-1">
                                            <li>invite one person or many</li>
                                            <li>fill out the invitation</li>
                                            <li>receive RSVPs from other buddies</li>
                                        </ul>

                                        <p class="m-0 fw-light">there are no more excuses for being bored!</p>
                                    </div>

                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>

                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                            </div>
                        </div>

                        <a href="{{ route('login') }}" class="btn btn-primary border-0 w-100 btn-shadow">get started</a>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End of Carosuel -->


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({

            duration: 1000
        });

        document.getElementById('welcome-btn').addEventListener('click', () => {
            document.getElementById('welcome-sc').classList.add('d-none');
            document.getElementById('carousel').classList.remove('d-none');
        })
    </script>


    <!-- BOOTSTRAP JS FILES -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>


</body>

</html>
