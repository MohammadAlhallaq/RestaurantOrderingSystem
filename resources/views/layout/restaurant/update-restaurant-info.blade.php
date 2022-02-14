@extends('layout.mainlayout')
<link href="{{asset('dashboard-layout/css/spinner.css')}}" rel="stylesheet">
@section('content')
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
                <div class="card-header">
                    <h4 class="card-title">Update Info</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{route('update-restaurant-info', $account->id)}}"
                              class="form-wizard order-create sw sw-theme-default sw-justified needs-validation"
                              method="post">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="account_name">Restaurant Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control" name="account_name"
                                                   id="account_name" placeholder="Admin Name" required
                                                   value="{{$account->account_name}}">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="email">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <input type="email" class="form-control" name="email" id="email"
                                                   placeholder="Email Address" required value="{{$account->email}}">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="mobile_number">Phone Number</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="mobile_number"
                                                   id="mobile_number" placeholder="Mobile Number" required
                                                   value="{{$account->phone_number}}">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="text-label form-label">Restaurant Logo*</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" style="background: #fd683e; color: #ffffff">Upload</span>
                                        <div class="form-file">
                                            <input type="file" class="form-file-input form-control" name="logo"
                                                   accept="image/*"
                                                   id="logo">
                                        </div>
                                    </div>
                                    <small>Allowed extension is: jpeg, jpg, png</small><br><br>
                                </div>


                                <div class="mb-3 col-md-4">
                                    <label class="text-label form-label">address*</label>
                                    <input type="text" class="form-control" id="map-input" name="address"
                                           placeholder="Enter Address Details"
                                           value="{{$account->address != null ?  $account->address->address : ''}}"
                                           required>
                                </div>


                                <div class="mb-3 col-md-4">
                                    <label class="text-label form-label">Description*</label>
                                    <textarea type="text" class="form-control" name="description" required
                                              placeholder="Describe your restaurant">{{$account->description != null ?  $account->description : ''}}</textarea>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label">Restaurant Currency*</label>
                                        <select name="currency" id="currency"
                                                tabindex="-1" class="multi-select form-file-input form-control"
                                                multiple>
                                            @foreach(\App\Models\Currency::all() as $currency)
                                                <option class="form-control"
                                                        value="{{$currency->id}}" {{in_array($currency->id, $currencies) ? 'selected' : ''}}>{{$currency->currency_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label">Restaurant Sub category*</label>
                                        <select name="sub_category" id="sub_category" data-select2-id="5"
                                                tabindex="-2"
                                                class="dropdown-groups multi-select form-file-input form-control"
                                                multiple>

                                            @foreach($parent_sub_categories as $parent)
                                                <optgroup label="{{$parent->parent_name}}"
                                                          data-select2-id="{{$parent->id}}">
                                                    @foreach(\App\Models\subCategory::all() as $sub_category)
                                                        @if($sub_category->parent->id == $parent->id && !in_array($sub_category->id, $sub_categories))
                                                            <option class="form-control"
                                                                    value="{{$sub_category->id}}">{{$sub_category->sub_category_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>


                                <div class="mb-3 col-md-12">
                                    <label class="text-label form-label">Select Address*</label>
                                    <div id="map" style="height: 300px; z-index: 1"></div>
                                    <div id="infowindow-content">
                                        <span id="place-name" class="title"></span><br/>
                                        <span id="place-address"></span>
                                    </div>
                                    <hr style="height: 2px">

                                </div>
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="mobile_number">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password"
                                                   id="password" placeholder="Password" required
                                            >
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="mobile_number">Password
                                            Confirmation</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password_confirmation"
                                                   id="password_confirmation" placeholder="Password Confirmation"
                                                   required
                                            >
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-3">

                                <input type="text" class="form-control" name="long" id="long"
                                       value="{{$account->address != null ?  $account->address->longitude : ''}}"
                                       required readonly hidden>

                            </div>

                            <div class="mb-3">

                                <input type="text" class="form-control" name="lat" id="lat"
                                       value="{{$account->address != null ?  $account->address->latitude : ''}}"
                                       required readonly hidden>

                            </div>


                            <div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;">
                                <button class="btn btn-primary submit" data-restaurant-id="{{$account->id}}"
                                        style="background-color: #fd683e;border: 1px solid #fd683e;">Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end col -->

@endsection
@section('js')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_APIKEY') }}&callback=initMap&libraries=places&v=weekly"
        async></script>
    <script src="{{URL::asset('dashboard-layout/libs/mask/jquery.mask.min.js')}}"></script>

    <script>
        let map;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: 25.2048, lng: 55.2708},
                minZoom: 10,
            });

            map.addListener('click', function (event) {
                document.getElementById('long').value = event.latLng.lng();
                document.getElementById('lat').value = event.latLng.lat();
                placeMarker(event.latLng);
            });

            var marker

            function placeMarker(location) {
                if (marker)
                    marker.setMap(null);
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
        $("input[name=mobile_number]").keyup(function () {
            var prefix = '00971';
            if (!(this.value.match('^00971'))) {
                this.value = prefix;
            }
        });

        $("input[name=mobile_number]").blur(function () {
            var prefix = '00971';
            if (!(this.value.match('^00971'))) {
                this.value = prefix;
            }
        });
    </script>

    <script>
        $("#mobile_number").mask("00000 00 000 0000", {placeholder: "Ex: 00971 55 458 3586"});

        $(document).ready(function () {
            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });

        $(".submit").click(function (event) {
            $('#spinner').show();
            event.preventDefault();
            let sub_category = [];
            let account_name = $("input[name=account_name]").val();
            let description = $("textarea[name=description]").val();
            let password = $("input[name=password]").val();
            let password_confirmation = $("input[name=password_confirmation]").val();
            let email = $("input[name=email]").val();
            let currency = $("select[name=currency]").val();
            sub_category = $("select[name=sub_category]").val();
            let mobile_number = $("input[name=mobile_number]").val();
            let long = $("input[name=long]").val();
            let lat = $("input[name=lat]").val();
            let address = $("input[name=address]").val();
            let logo = $("input[name = logo]").get(0).files[0]

            var data = new FormData();
            data.append('password', password)
            data.append('password_confirmation', password_confirmation)
            data.append('account_name', account_name)
            data.append('currency', currency)
            data.append('sub_category', sub_category)
            data.append('description', description)
            data.append('email', email)
            data.append('mobile_number', mobile_number)
            data.append('logo', logo)
            data.append('long', long)
            data.append('lat', lat)
            data.append('address', address)

            var url = $('form').attr('action');
            var restaurant_id = $(this).data('restaurant-id');

            $.ajax({
                url: url,
                method: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: data,
                processData: false,
                contentType: false,

                success: (response) => {
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
                    } else if (response.result == 'exception') {
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
                        window.location.replace('/profile/' + restaurant_id);

                    }
                },
            });
        });
    </script>
@endsection
