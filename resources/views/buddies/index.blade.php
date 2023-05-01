@extends('layouts.app')


{{-- page title --}}
@section('title', 'Find Buddies')


{{-- extra id for main content div --}}
@section('extra-ids', 'content_area_buddies')

@section('content')
    <h4 class="buddies_heading">buddies <a data-bs-toggle="modal" href="#filter_buddies_modal" role="button"
            class="filter_icon"><i class="fi fi-rr-settings-sliders"></i></a>
    </h4>

    <div class="buddies_parent">
        <div class="row mb-3">

            @foreach ($buddies as $buddy)
                <div class="col-md-3 col-sm-6 col-6 mb-3 buddies_profile_col">
                    <!-- start profile buddy -->
                    <div class="buddy_profile">
                        <a href="{{ route('buddy.profile', ['id' => $buddy->id]) }}">
                            <img src="{{ asset('storage/images/' . $buddy->profilePicture) }}" alt="buddy profile image">
                        </a>
                        <div class="buddy-content">
                            <div>
                                <h4>{{ $buddy->firstName }} {{ $buddy->lastName }}</h4>
                                <p
                                    style="color:
                                    @if ($buddy['interest_percentage'] >= 75) #44DC53
                                    @elseif ($buddy['interest_percentage'] >= 50)
                                        #FF8A00
                                    @else
                                        #FF0000 @endif">
                                    {{ $buddy['interest_percentage'] }}%</>
                            </div>
                            <i class="fi fi-rr-star"></i>
                        </div>
                    </div>
                    <!-- end profile buddy -->
                </div>
            @endforeach


        </div>
    </div>


    <!-- filter modal -->
    @include('buddies.range-modal')
@endsection





@section('scripts')
    <!-- script for range filter modal -->
    <script>
        const range = document.querySelectorAll(".range-slider span input");
        progress = document.querySelector(".range-slider .progress");
        let gap = 0.1;
        const inputValue = document.querySelectorAll(".numberVal input");

        range.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minRange = parseInt(range[0].value);
                let maxRange = parseInt(range[1].value);

                if (maxRange - minRange < gap) {
                    if (e.target.className === "range-min") {
                        range[0].value = maxRange - gap;
                    } else {
                        range[1].value = minRange + gap;
                    }
                } else {
                    progress.style.left = (minRange / range[0].max) * 100 + "%";
                    progress.style.right = 100 - (maxRange / range[1].max) * 100 + "%";
                    inputValue[0].value = minRange;
                    inputValue[1].value = maxRange;
                }
            });
        });
    </script>

    <script>
        // Get the range inputs and apply button
        const rangeMin = document.querySelector('.range-min');
        const rangeMax = document.querySelector('.range-max');
        const applyBtn = document.querySelector('.aply-btn');

        applyBtn.addEventListener('click', function() {
            // Get the min and max values
            const min = parseInt(rangeMin.value);
            const max = parseInt(rangeMax.value);

            $('.aply-btn').text('filtering...');
            $('.aply-btn').prop('disabled', true);

            // Loop through each profile column
            const profileCols = document.querySelectorAll('.buddies_profile_col');

            profileCols.forEach(function(col) {
                // Get the percentage value from the profile column
                const percentage = parseInt(col.querySelector('p').textContent);

                setTimeout(function() {

                    // Check if the percentage value is within the range
                    var profileCount = 0;
                    var cols = document.querySelectorAll('.buddies_profile_col');
                    for (var i = 0; i < cols.length; i++) {
                        var percentage = parseInt(cols[i].querySelector('.buddy-content p')
                            .textContent);
                        if (percentage >= min && percentage <= max) {
                            // Show the profile column
                            cols[i].style.display = 'block';
                            profileCount++;
                        } else {
                            // Hide the profile column
                            cols[i].style.display = 'none';
                        }
                    }

                    // Remove any existing "No results found" messages
                    var noResultsMsgs = document.querySelectorAll('.no-results-msg');
                    noResultsMsgs.forEach(function(msg) {
                        msg.remove();
                    });

                    // Show "No results found" message if no profiles are displayed
                    if (profileCount === 0) {
                        var noResultsMsg = document.createElement('p');
                        noResultsMsg.classList.add('no-results-msg');
                        noResultsMsg.textContent = 'No results found';
                        document.querySelector('.row.mb-3').appendChild(noResultsMsg);
                    }

                    $('#filter_buddies_modal').modal('hide');
                    $('.aply-btn').text('apply');
                    $('.aply-btn').prop('disabled', false);
                }, 300);
            });
        });
    </script>

@endsection
