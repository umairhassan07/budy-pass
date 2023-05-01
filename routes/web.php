<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BuddiesController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\InterestsController;
use App\Http\Controllers\InvitesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginWithGoogleController;
use App\Http\Controllers\ProfilePictureController;
use App\Http\Controllers\CommonPagesController;
use App\Http\Controllers\EventAttendeesController;

// WELCOME PAGES 
Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/verify', [LoginController::class, 'verify'])->name('verify');
Route::post('/send-sms', [LoginController::class, 'send_sms'])->name('send-sms');
Route::post('/verify-code', [LoginController::class, 'verifyCode'])->name('verify-code');

// login with google
Route::get('authorized/google', [LoginWithGoogleController::class, 'redirectToGoogle']);
Route::get('authorized/google/callback', [LoginWithGoogleController::class, 'handleGoogleCallback']);


// for not loggedin users
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');

});



// Logged in routes
Route::middleware(['auth'])->group(function () {

    // home Rotue
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // buddies routes
    Route::get('/find-buddies', [BuddiesController::class, 'index'])->name('buddies');
    Route::get('/buddy-profile/{id}', [BuddiesController::class, 'buddy_profile'])->name('buddy.profile');
    Route::get('/buddy-invite', [BuddiesController::class, 'invites_buddies'])->name('buddy.inviteBuddies');

    // events routes
    Route::get('/create-event', [EventsController::class, 'create'])->name('create-event');
    Route::get('/event-details/{id}', [EventsController::class, 'event_details'])->name('event.detail');
    Route::post('/store-event', [EventsController::class, 'store'])->name('event.store');
    // accept reject invites
    Route::post('/reject-invite',[EventsController::class, 'rejectInvitation'])->name('invite.reject');

    // events bookmark
    Route::post('/event-bookmar', [EventsController::class, 'eventBookmark'])->name('event.bookmark');

    // bookmarked event check
    Route::post('/bookmark-check', [EventsController::class, 'bookmarkCheck'])->name('bookmark.check');

    // invites routes
    Route::get('/invites', [InvitesController::class, 'index'])->name('invites');

    // profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/edit-profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/update-profile', [ProfileController::class, 'update'])->name('profile.update');

    // submit personal information
    Route::post('/personal-info', [SignupController::class, 'store'])->name('personal_info');

    // upload profile picture
    Route::get('/upload-picture', [ProfilePictureController::class, 'index'])->name('upload-picture');
    Route::post('/upload-pic', [ProfilePictureController::class, 'store'])->name('upload-pic-post');

    // interests
    Route::get('/interests', [InterestsController::class, 'create'])->name('interests');
    Route::post('/interests/insert', [InterestsController::class, 'store'])->name('interests.store');

    // profile info 
    Route::get('/profile-info', [SignupController::class, 'index'])->name('signup');

    // google calendar ajax
    Route::post('/add-to-calendar', [EventsController::class, 'add_to_google'])->name('calendar.google');

    // invite user to events
    Route::post('/invite-user', [EventAttendeesController::class, 'store'])->name('invite.user');

    // privacy, faq, terms routes
    Route::get('/terms-of-use', [CommonPagesController::class, 'terms'])->name('terms');
    Route::get('/faq', [CommonPagesController::class, 'faq'])->name('faq');
    Route::get('/privacy-policy', [CommonPagesController::class, 'privacy'])->name('privacy');
    Route::get('/my-account', [ProfileController::class, 'myAccount'])->name('myAccount');
    Route::get('/saved-events', [EventsController::class, 'savedEVents'])->name('savedEvents');


    // update notification checkbox
    Route::post('/notification-ajax', [ProfileController::class,'notification_check_update'])->name('notification_update');
    Route::post('/invitation-ajax', [ProfileController::class,'invitation_check_update'])->name('invitation_update');

});

// Route::middleware(['checkProfile'])->group(function () {
    
//     Route::get('/interests', [InterestsController::class, 'create'])->name('interests');

// });