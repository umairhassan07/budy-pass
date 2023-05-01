<!-- Invite buddies -->
<div class="modal fade" id="invite_buddies_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content mx-auto">

            <div class="modal-body justify-content-center align-items-center d-flex flex-column mt-5">
                <div class="profile_page_tp w-100">
                    <h2 class="buddy_name"><a href="" data-bs-dismiss="modal"><i
                                class="fi fi-rr-angle-small-left"></i></a> <span>invite
                            buddies</span></h2>
                </div>

                <div class="search-bar w-100">
                    <i class="fi fi-rr-search"></i>
                    <input type="text" placeholder="Search" id="searchInput">
                </div>

                <div class="list_profiles w-100">

                    
                    @forelse ($eventAttendees as $key =>  $item)
                        <!-- profile row start -->
                        <div class="profile_tab_row">
                            <div>
                                <img src="{{ asset('storage/images/' . $item->user->profilePicture) }}"
                                    alt="profile image">
                                <h5>{{ $item->user->firstName }} {{ $item->user->lastName }}</h5>
                                <i class="fi fi-rr-shield-check"></i>
                            </div>
                            <input type="checkbox" class="btn-check" id="btn-check-outlined{{ $key }}"
                                data-id="{{ encrypt($item->user->id) }}"
                                data-image="{{ $item->user->profilePicture }}" autocomplete="off">
                            <label class="btn invite_buddie_btn invite_button "
                                for="btn-check-outlined{{ $key }}">invite</label>
                        </div>
                        <!-- profile row end -->

                    @empty
                        <div class="profile_tab_row">
                            <p>No profile found.</p>
                        </div>
                    @endforelse


                </div>

            </div>
            <div class="modal-footer border-0 gap-3 justify-content-center">
                <button class="common_btn bg_green_btn invite_selected">done!</button>
            </div>
        </div>
    </div>
</div>


{{-- search profile --}}
<script>
    $('#searchInput').on('input', function() {
        const searchQuery = $(this).val().toLowerCase();

        $('.profile_tab_row').each(function() {
            const name = $(this).find('h5').text().toLowerCase();

            if (name.includes(searchQuery)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
</script>
