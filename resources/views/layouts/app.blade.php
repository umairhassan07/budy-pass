<!doctype html>
<html lang="en">

@include('layouts.header')

</head>

<body>
    <main class="main-content">
        <div class="container-fluid mp-0 home-page">
            <div class="row mp-0">
                <div class="col-md-3 mp-0">
                    <!-- sidebar -->
                    @include('layouts.sidebar')
                </div>

                <div class="col-md-8 offset-md-1 column-8-main">
                    <!-- content area -->
                    <main class="content-area" id="@yield('extra-ids')">

                        @yield('content')

                    </main>

                    {{-- for event-details page --}}
                    @yield('matched_profiles')

                    {{-- for right sidebar --}}
                    @yield('right-side')
                </div>
            </div>
        </div>
    </main>



    {{-- include footer file --}}
    @include('layouts.footer')
</body>

</html>
