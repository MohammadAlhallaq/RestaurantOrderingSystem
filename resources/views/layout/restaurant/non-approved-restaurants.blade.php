@extends('layout.mainlayout')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>

<style>
    .leaflet-bar a,
    .leaflet-bar a:hover {
        color: black !important;
    }
</style>
<link href="{{asset('dashboard-layout/css/spinner.css')}}" rel="stylesheet">

@section('content')
    <!-- end page title -->
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Restaurants</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Owner</th>
                                <th>phone number</th>
                                <th>Address</th>
                                <th>license</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($restaurants as $res)
                                <tr id="{{$res->id}}">
                                    <td class="sorting_1"><img class="rounded-circle" width="35"
                                                               src="{{asset($res->logo_path != null ? '/restaurants/logo/'.$res->id.'/'. $res->logo_path : '/restaurants/logo/bg-logo.png')}}"
                                                               alt=""></td>
                                    <td>{{$res->account_name}}</td>
                                    <td>{{$res->owner->account_name}}</td>
                                    <td>{{$res->owner->phone_number}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary mb-2 btn-xs"
                                                onclick="address({{$res->address != null ? $res->address : ''}})"
                                                data-bs-toggle="modal" data-bs-target="#exampleModalpopover">Review
                                            Address
                                        </button>
                                    </td>
                                    <td>
                                        <span class="badge badge-primary badge-lg"><a
                                                href="{{route('review-pdf', $res->id)}}" style="color: #fff">Review License</a></span>
                                    </td>
                                    <td>

                                        @can('manage-restaurants')
                                            <div class="dropdown custom-dropdown mb-0">
                                                <div class="btn sharp btn-primary tp-btn" data-bs-toggle="dropdown"
                                                     aria-expanded="true">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="18px"
                                                         height="18px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                           fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <circle fill="#000000" cx="12" cy="5" r="2"></circle>
                                                            <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                            <circle fill="#000000" cx="12" cy="19" r="2"></circle>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                     data-popper-placement="top-end"
                                                     style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(-105px, -37px);">
                                                    <a class="dropdown-item text-success approve"
                                                       href="{{route('approve-application', $res->id)}}">Approve</a>
                                                    <a class="dropdown-item text-danger reject"
                                                       href="{{route('send-notes', $res->owner->id)}}">Send notes</a>
                                                </div>
                                            </div>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModalpopover">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Address Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>Address</h5>
                            <p class="address"></p>
                            <hr>
                            <h5>Place on the map</h5>
                            <div id="mapid" style="height: 300px"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')


    <script>
        $(document).on('click', ".approve", function (event) {
            event.preventDefault();
            var url = $(this).attr('href');
            swal({
                title: "Approve the application",
                type: "info",
                showCancelButton: !0,
                confirmButtonColor: "#68e365",
                confirmButtonText: "Yes, Approve it",
                cancelButtonText: "No, cancel it !!",
            }).then((result) => {
                if (result.value) {
                    $('#spinner').show();
                    $.ajax({
                        url: url,
                        method: "GET",
                        success: (response) => {
                            $('#spinner').remove();
                            if (response.result == 'success') {
                                $(this).closest("tr").remove();
                                toastr.success(response.message, "Heads Up", {
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
                            } else if (response.status_code == 500) {
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
                            } else if (response.status === "payment_exception") {
                                toastr.info(response.message, "Heads Up", {
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
                            }
                        },
                    });
                }
            })
        })
    </script>




    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
    <script>

        // MAP & ADDRESS
        let marker;
        let map;

        function address(address) {
            $('.address').text(address.address);
            if (map)
                map.remove();

            map = L.map('mapid', {}).setView([address.latitude, address.longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            }).addTo(map);

            if (marker)
                map.removeLayer(marker);

            marker = L.marker([address.latitude, address.longitude]).addTo(map);

            setTimeout(function () {
                map.invalidateSize();
            }, 500);
        }
    </script>


@endsection
