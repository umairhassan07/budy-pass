<!-- INVITE ACCEPT OR REJECT -->


@if (!empty($event['invitations']))

    @foreach ($event['invitations'] as $item)
        {{-- {{ dd($item) }} --}}


        <div class="parent-ar-div">
            <img src="{{ asset('storage/images/' . $item->inviter->profilePicture) }}" alt="invite sent picture">
            <h4>{{ $item->inviter->firstName }} {{ $item->inviter->lastName }}</h4>
            <p>invited you to the event above</p>
            <a href="{{ route('buddy.profile', ['id' => $item->inviter->id]) }}">view profile</a>
            <div class="btns-div">
                <button class="reject_invite_btn" id="{{ encrypt($item->id) }}">reject</button>
                <button class="accept_invite_btn" data-bs-toggle="modal" href="#rsvp_modal" role="button">accept</button>
            </div>
        </div>
    @endforeach
@endif
