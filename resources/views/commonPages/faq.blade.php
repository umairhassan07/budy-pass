@extends('layouts.app')


{{-- page title --}}
@section('title', 'Terms Of Services')

{{-- extra id for main content div --}}
@section('extra-ids', 'terms-of-services')

@section('content')
    <!-- Terms and conditions header -->
    <div class="terms_header d-flex justify-content-between">
        <div class="d-flex align-items-center gap-1">
            <a href="{{ route('profile') }}" class="btn border-0"><i class="fi fi-br-angle-left "></i></a>
            <h5 class="fw-bold">Privacy Policy</h5>
        </div>
        <button class="btn border-0"><i class="fi fi-br-menu-dots-vertical"></i></button>
    </div>
    <p class="lh-1 fw-light __text-gray mb-3">we are buddies and we are always here to assist you on every step of the way.
        here are some commonly asked questions.</p>

    <!-- FAQ Accordians  -->

    <div class="">
        <div class="accordion accordian-container" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        how can i messsage some one?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the first item's accordion body.</strong> It is shown by
                        default, until the collapse plugin adds the appropriate classes that we use
                        to style each element. These classes control the overall appearance, as well
                        as the showing and hiding via CSS transitions. You can modify any of this
                        with custom CSS or overriding our default variables. It's also worth noting
                        that just about any HTML can go within the <code>.accordion-body</code>,
                        though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        can i create my own events as well?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the second item's accordion body.</strong> It is hidden by
                        default, until the collapse plugin adds the appropriate classes that we use
                        to style each element. These classes control the overall appearance, as well
                        as the showing and hiding via CSS transitions. You can modify any of this
                        with custom CSS or overriding our default variables. It's also worth noting
                        that just about any HTML can go within the <code>.accordion-body</code>,
                        though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        does cancelling event affect my profile?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by
                        default, until the collapse plugin adds the appropriate classes that we use
                        to style each element. These classes control the overall appearance, as well
                        as the showing and hiding via CSS transitions. You can modify any of this
                        with custom CSS or overriding our default variables. It's also worth noting
                        that just about any HTML can go within the <code>.accordion-body</code>,
                        though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                        why can’t i message people?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by
                        default, until the collapse plugin adds the appropriate classes that we use
                        to style each element. These classes control the overall appearance, as well
                        as the showing and hiding via CSS transitions. You can modify any of this
                        with custom CSS or overriding our default variables. It's also worth noting
                        that just about any HTML can go within the <code>.accordion-body</code>,
                        though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                        how to get the verified badge?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by
                        default, until the collapse plugin adds the appropriate classes that we use
                        to style each element. These classes control the overall appearance, as well
                        as the showing and hiding via CSS transitions. You can modify any of this
                        with custom CSS or overriding our default variables. It's also worth noting
                        that just about any HTML can go within the <code>.accordion-body</code>,
                        though the transition does limit overflow.
                    </div>
                </div>
            </div>
        </div>

        <div>
            <p class="lh-1 fw-light __text-gray mb-1">have a different question?</p>

            <div class="form-floating">
                <textarea class="form-control __input" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2" class="__text-gray">ask us anything</label>
            </div>
        </div>

        <button class="btn btn-custom my-5 mx-auto d-block px-5 py-2">submit</button>

    </div>






@endsection



@section('scripts')

@endsection
