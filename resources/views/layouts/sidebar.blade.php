<aside class="sidebar">
    <div class="top-logo">
        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="sitebar top logo"></a>
    </div>

    <ul class="sidebar-navigation">
        <li><a href="{{ route('home') }}" class="{{ Request::routeIs('home') ? 'active' : '' }}"><i
                    class="fi fi-rr-home mr-20"></i> home</a></li>
        <li><a href="{{ route('buddies') }}" class="{{ Request::routeIs('buddies') ? 'active' : '' }}"><i
                    class="fi fi-rr-users-alt mr-20"></i> find buddies</a>
        </li>
        <li><a href="{{ route('create-event') }}" class="{{ Request::routeIs('create-event') ? 'active' : '' }}"><i
                    class="fi fi-rr-square-plus mr-20"></i> create event</a>
        </li>
        <li><a href="{{ route('invites') }}" class="{{ Request::routeIs('invites') ? 'active' : '' }}"><i
                    class="fi fi-rr-envelope mr-20"></i> invites</a></li>
        <li> <a href="{{ route('profile') }}" class="{{ Request::routeIs('profile') ? 'active' : '' }}"><span
                    class="profile_image"><img
                        src="{{ !empty(asset('storage/images/' . Auth()->user()->profilePicture)) ? asset('storage/images/' . Auth()->user()->profilePicture) : asset('assets/images/events/ev-img.png') }}"
                        alt="">profile</a></span>
        </li>
    </ul>

</aside>
