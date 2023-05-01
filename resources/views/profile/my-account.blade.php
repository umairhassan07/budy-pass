@extends('layouts.app')


{{-- page title --}}
@section('title', 'My Account')

@section('content')

    <!-- ACCOUNT header -->
    <div class="terms_header d-flex justify-content-between mb-3">
        <div class="d-flex align-items-center gap-1">
            <a href="{{ route('profile') }}" class="btn border-0"><i class="fi fi-br-angle-left"></i></a>
            <h5 class="fw-bold">my account</h5>
        </div>
        <button class="btn border-0"><i class="fi fi-br-menu-dots-vertical"></i></button>
    </div>

    <!-- ACCOUNTS LINKS  -->
    <div class="d-flex flex-column justify-content-between account-link-container">

        <div class="d-flex flex-column gap-4">
            <a class="link-account" href="#">personal information</a>
            <a class="link-account" href="#">event history</a>
            <a class="link-account" href="#">account status</a>
            <a class="link-account" href="#">sharing to other apps</a>
        </div>

        <div class="d-flex flex-column gap-4">
            <a class="link-danger" href="#">deactivate account</a>
            <a class="link-account fw-bold" href="#">delete account</a>
        </div>

    </div>

@endsection
