@extends('layouts.app')


{{-- page title --}}
@section('title', 'Invite Buddy')


@section('content')
    <div class="profile_page_tp">
        <h2 class="buddy_name"><a href="{{ route('create-event') }}"><i class="fi fi-rr-angle-small-left"></i></a> invite
            buddies</h2>
    </div>

    <div class="search-bar">
        <i class="fi fi-rr-search"></i>
        <input type="text" placeholder="Search">
    </div>


    <div class="list_profiles">
        <!-- profile row start -->
        <div class="profile_tab_row">
            <div>
                <img src="assets/images/buddies/buddy-2.png" alt="profile image">
                <h5>Iifrah a.</h5>
                <i class="fi fi-rr-shield-check"></i>
            </div>
            <button class="invite_button invite_bg">invite</button>
        </div>
        <!-- profile row end -->

        <!-- profile row start -->
        <div class="profile_tab_row">
            <div>
                <img src="assets/images/buddies/buddy-3.png" alt="profile image">
                <h5>Iifrah a.</h5>
                <i class="fi fi-rr-shield-check"></i>
            </div>
            <button class="invite_button invited_bg">invited</button>
        </div>
        <!-- profile row end -->

        <!-- profile row start -->
        <div class="profile_tab_row">
            <div>
                <img src="assets/images/buddies/buddy-1.png" alt="profile image">
                <h5>Iifrah a.</h5>
                <i class="fi fi-rr-shield-check"></i>
            </div>
            <button class="invite_button invite_bg">invite</button>
        </div>
        <!-- profile row end -->

        <!-- profile row start -->
        <div class="profile_tab_row">
            <div>
                <img src="assets/images/buddies/buddy-2.png" alt="profile image">
                <h5>Iifrah a.</h5>
                <i class="fi fi-rr-shield-check"></i>
            </div>
            <button class="invite_button invite_bg">invite</button>
        </div>
        <!-- profile row end -->

        <!-- profile row start -->
        <div class="profile_tab_row">
            <div>
                <img src="assets/images/buddies/buddy-3.png" alt="profile image">
                <h5>Iifrah a.</h5>
                <i class="fi fi-rr-shield-check"></i>
            </div>
            <button class="invite_button invited_bg">invited</button>
        </div>
        <!-- profile row end -->

        <!-- profile row start -->
        <div class="profile_tab_row">
            <div>
                <img src="assets/images/buddies/buddy-1.png" alt="profile image">
                <h5>Iifrah a.</h5>
                <i class="fi fi-rr-shield-check"></i>
            </div>
            <button class="invite_button invite_bg">invite</button>
        </div>
        <!-- profile row end -->

    </div>

    <button class="common_btn bg_green_btn">done!</button>


@endsection
