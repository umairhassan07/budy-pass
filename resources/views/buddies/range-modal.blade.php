<div class="modal fade" id="filter_buddies_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="filter_match">
                    <h5>filter matches</h5>

                    <!-- range slider -->
                    <div class="flex relative justify-center items-center h-20 w-full mx-auto rounded">

                        <div class="range-slider">
                            <div class="progress"></div>
                            <span class="range-min-wrapper">
                                <input class="range-min" type="range" min="0" max="100" value="25">
                                <!-- <span class="range-min-value">0</span> -->
                            </span>
                            <span class="range-max-wrapper">
                                <input class="range-max" type="range" min="0" max="100" value="100">
                                <!-- <span class="range-max-value">100</span> -->
                            </span>
                        </div>
                        <div class="range-value">
                            <div class="min-value numberVal">
                                <input type="number" class="" min="0" max="100" value="25"
                                    disabled>
                            </div>
                            <div class="max-value numberVal">
                                <input type="number" min="0" max="100" value="75" disabled>
                            </div>
                        </div>
                    </div>



                    <div class="btn-grp">
                        <button class="cnsl-btn" data-bs-dismiss="modal" aria-label="Close">cancel</button>
                        <button class="aply-btn">apply</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
