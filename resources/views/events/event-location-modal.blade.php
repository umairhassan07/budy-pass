<!-- event location modal -->
<div class="modal fade" id="location_event_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="location_modal">
                    <h5 class="modal-heading-txt">location <a data-bs-dismiss="modal" aria-label="Close"
                            class="close-location-btn">close</a></h5>
                    <div class="map-div">
                        <div id="map"></div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- google map --}}
<script type="text/javascript">
    function initMap() {
        // get the location from the Laravel variable
        const location = "{{ $event->ev_location }}";

        // create a new Geocoder object
        const geocoder = new google.maps.Geocoder();

        // use the Geocoder to convert the location string into a LatLng object
        geocoder.geocode({
            address: location
        }, (results, status) => {
            if (status === "OK") {
                // get the latitude and longitude from the first result
                const latLng = {
                    lat: results[0].geometry.location.lat(),
                    lng: results[0].geometry.location.lng(),
                };

                // create the map
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 10,
                    center: latLng,
                });

                // add a marker to the map
                new google.maps.Marker({
                    position: latLng,
                    map,
                    title: location,
                });
            } else {
                // handle the geocoding error
                alert("Geocode was not successful for the following reason: " + status);
            }
        });
    }

    window.initMap = initMap;
</script>

<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCexUlk_ag3MgHXiLO-9_d4-1UVLG1saQk&callback=initMap&libraries=places&v=weekly">
</script>
