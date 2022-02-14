@extends('layout.mainlayout')

<style>
    input:disabled {
        cursor: not-allowed;
        pointer-events: all !important;
    }
</style>
<link href="{{asset('dashboard-layout/css/spinner.css')}}" rel="stylesheet">

@section('content')
    <!-- row -->
    <div class="circles-to-rhombuses-spinner overlay" id="spinner" style=" display: none; position: fixed;
  z-index: 999;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-6 offset-md-3">

                        <div id="smartwizard" class="form-wizard order-create sw sw-theme-default sw-justified"
                             style="border: #212130">
                            <div class="basic-form">
                                <form id="general-information" enctype="multipart/form-data"
                                      class="form-wizard order-create sw sw-theme-default sw-justified needs-validation"
                                      method="post" style="border: #212130"
                                      action="{{route('general-information-step')}}">

                                    <div>
                                        <h3 class="card-title"
                                            style="text-align: center; font-weight: bold ; color: #fff">Bank
                                            Details</h3>
                                        <hr style="height: 2px">
                                    </div>

                                    <div class="form-check custom-checkbox mb-3 offset-9">
                                        <label class="form-check-label" for="customCheckBox1">Payment Details</label>
                                        <input type="checkbox" class="form-check-input" id="paymentCheckBox"
                                               name="paymentCheckBox"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-label form-label">Bank Name*</label>
                                        <input type="text" class="form-control" name="bank_name" id="bank_name"
                                               value="{{$account->bank != null ? $account->bank->bank_name : ''}}"
                                               disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-label form-label">IBan*</label>
                                        <input type="text" class="form-control" name="bank_number" id="bank_number"
                                               onkeyup="this.value = this.value.toUpperCase();"
                                               value="{{$account->bank != null ? $account->bank->iban : ''}}"
                                               disabled>
                                        <small>Eg: AE07 **** **** **** **** ***</small><br>
                                    </div>
                                    <div>
                                        <h3 class="card-title"
                                            style="text-align: center ; font-weight: bold; color: #fff">Restaurant
                                            location Details</h3>
                                        <hr style="height: 2px">
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-label form-label">address*</label>
                                        <input type="text" class="form-control" id="map-input" name="address"
                                               placeholder="Enter Address Details"
                                               value="{{$account->address != null ?  $account->address->address : ''}}"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-label form-label">Description*</label>
                                        <textarea type="text" class="form-control" name="description" required
                                                  placeholder="Describe your restaurant">{{$account->description != null ?  $account->description : ''}}</textarea>
                                    </div>


                                    <div class="mb-3">
                                        <label class="text-label form-label">Select Address*</label>
                                        <div id="map" style="height: 300px; z-index: 1"></div>
                                        <div id="infowindow-content">
                                            <span id="place-name" class="title"></span><br/>
                                            <span id="place-address"></span>
                                        </div>
                                        <hr style="height: 2px">

                                    </div>

                                    <div class="mb-3">
                                        <label class="text-label form-label">longitude*</label>

                                        <input type="text" class="form-control" name="long" id="long"
                                               value="{{$account->address != null ?  $account->address->longitude : ''}}"
                                               required readonly>
                                        <small>Eg: 55.365*****</small><br><br>

                                    </div>

                                    <div class="mb-3">
                                        <label class="text-label form-label">latitude*</label>

                                        <input type="text" class="form-control" name="lat" id="lat"
                                               value="{{$account->address != null ?  $account->address->latitude : ''}}"
                                               required readonly>
                                        <small>Eg: 55.365*****</small><br><br>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="toolbar toolbar-bottom" style="text-align: right;">
                        <button class="btn btn-primary submit"
                                style="background-color: #fd683e;border: 1px solid #fd683e;">Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>


    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_APIKEY') }}&callback=initMap&libraries=places&v=weekly"
        async
    ></script>

    <script>
        let map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 25.2048, lng: 55.2708},
                zoom: 10
            });

            map.addListener('click', function (event) {
                document.getElementById('long').value = event.latLng.lng();
                document.getElementById('lat').value = event.latLng.lat();
                placeMarker(event.latLng);
            });
            var marker

            function placeMarker(location) {
                if (marker) {
                    marker.setMap(null);
                }
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }

            $(document).ready(function () {
                let long = $("input[name=long]").val();
                let lat = $("input[name=lat]").val();
                if (long && lat) {
                    marker = new google.maps.Marker({
                        position: {lat: Number(lat), lng: Number(long)},
                    });
                    marker.setMap(map);
                    let bounds = new google.maps.LatLngBounds();
                    bounds.extend({lat: Number(lat), lng: Number(long)});
                    map.fitBounds(bounds);
                }


                zoomChangeBoundsListener =
                    google.maps.event.addListenerOnce(map, 'bounds_changed', function (event) {
                        if (this.getZoom()) {   // or set a minimum
                            this.setZoom(10);  // set zoom here
                        }
                    });

                setTimeout(function () {
                    google.maps.event.removeListener(zoomChangeBoundsListener)
                }, 1000);
            });

            // const card = document.getElementById("pac-card");
            const input = document.getElementById("map-input");
            // const biasInputElement = document.getElementById("use-location-bias");
            // const strictBoundsInputElement = document.getElementById("use-strict-bounds");
            const options = {
                componentRestrictions: {country: "AE"},
                fields: ["formatted_address", "geometry", "name"],
                strictBounds: false,
                types: ["establishment"],
            };

            // map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

            const autocomplete = new google.maps.places.Autocomplete(input, options);
            autocomplete.bindTo("bounds", map);

            const infowindow = new google.maps.InfoWindow();
            const infowindowContent = document.getElementById("infowindow-content");

            infowindow.setContent(infowindowContent);
            marker = new google.maps.Marker({
                map,
                anchorPoint: new google.maps.Point(0, -29),
            });


            autocomplete.addListener("place_changed", (event) => {
                infowindow.close();
                marker.setVisible(false);

                const place = autocomplete.getPlace();
                if (place.geometry === undefined || place.geometry.location === undefined) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    toastr.error("No details available for input: '" + place.name + "'");
                    return;
                }

                document.getElementById('long').value = place.geometry.location.lng();
                document.getElementById('lat').value = place.geometry.location.lat();

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(10);
                }

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                infowindowContent.children["place-name"].textContent = place.name;
                infowindowContent.children["place-address"].textContent =
                    place.formatted_address;
                infowindow.open(map, marker);
            });
        }

    </script>


    <script>
        $('#paymentCheckBox').change(function () {
            if (this.checked) {
                $("#bank_name").attr('disabled', false);
                $("#bank_number").attr('disabled', false);
            } else if (!this.checked) {
                $("#bank_name").val('');
                $("#bank_number").val('');
                $("#bank_name").attr('disabled', true);
                $("#bank_number").attr('disabled', true);
            }
        });
    </script>

    <script>
        $(".submit").click(function (event) {
            event.preventDefault();
            $('#spinner').show();
            let bank_name = $("input[name=bank_name]").val();
            let bank_number = $("input[name=bank_number]").val();
            let long = $("input[name=long]").val();
            let lat = $("input[name=lat]").val();
            let address = $("input[name=address]").val();
            let description = $("textarea[name=description]").val();

            let paymentCheckBox;
            if ($("input[name=paymentCheckBox]:checked").val()) {
                paymentCheckBox = $("input[name=paymentCheckBox]:checked").val();
            } else {
                paymentCheckBox = ''
            }

            var data = new FormData();
            data.append('bank_name', bank_name)
            data.append('bank_number', bank_number)
            data.append('long', long)
            data.append('lat', lat)
            data.append('address', address)
            data.append('description', description)
            data.append('paymentCheckBox', paymentCheckBox)

            $.ajax({
                url: '{{route('bank-address-step')}}',
                method: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: data,
                processData: false,
                contentType: false,

                success: function (response) {
                    $('#spinner').hide();
                    if (response.result == 'false') {
                        Object.keys(response.errors).forEach(key => {
                            toastr.error(response.errors[key], "Heads Up", {
                                positionClass: "toast-top-right",
                                timeOut: 3e3,
                                closeButton: !0,
                                debug: !1,
                                newestOnTop: !0,
                                progressBar: !0,
                                preventDuplicates: !0,
                                onclick: null,
                                showDuration: "300",
                                hideDuration: "1000",
                                extendedTimeOut: "1000",
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                                tapToDismiss: !1,
                            })
                        })
                    } else if (response.result == 'address_exception') {
                        toastr.error(response.message, "Heads Up", {
                            positionClass: "toast-top-right",
                            timeOut: 3e3,
                            closeButton: !0,
                            debug: !1,
                            newestOnTop: !0,
                            progressBar: !0,
                            preventDuplicates: !0,
                            onclick: null,
                            showDuration: "300",
                            hideDuration: "1000",
                            extendedTimeOut: "1000",
                            showEasing: "swing",
                            hideEasing: "linear",
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut",
                            tapToDismiss: !1,
                        })
                    } else if (response.result == 'success') {
                        window.location.replace("select-package-step");
                    }
                },
            });
        });
    </script>


    <script src="{{URL::asset('dashboard-layout/libs/mask/jquery.mask.min.js')}}"></script>

    <script>
        jQuery(function ($) {
            $('#bank_number').mask('AA00 0000 0000 0000 0000 000', {
                'translation': {
                    A: {pattern: /[A-Za-z]/},
                    0: {pattern: /[0-9]/},

                }
            });
        });
    </script>
@endsection
