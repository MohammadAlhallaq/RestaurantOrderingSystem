@extends('layout.mainlayout')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Offers</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3"
                               class="table display mb-4 dataTablesCard order-table shadow-hover card-table text-black dataTable no-footer"
                               style="min-width: 845px">
                            <thead>
                            <tr>
                                <th class="sorting">Offer English Name</th>
                                <th class="sorting">Offer arabic Name</th>
                                <th class="sorting">Restaurant</th>
                                <th class="sorting">Create Date</th>
                                <th class="sorting">expiry_date</th>

                                <th class="sorting">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offers as $o)
                                <tr>
                                    <td>{{$o->offer_name_en}}</td>
                                    <td class="wspace-no">{{$o->offer_name_ar}}</td>
                                    <td class="wspace-no">{{$o->restaurant->account_name}}</td>
                                    <td class="text-ov">{{$o->created_at}}</td>
                                    <td class="text-ov">{{$o->expiry_date}}</td>

                                    <td>
                                        <div class="d-flex">
                                            @if(auth()->user()->account_type_id == 2)
                                                <div class="col-xl-5 col-sm-3 col-lg-4 col-6 text-end check-btn">
                                                    <a href="{{route('edit-offer',array('offer_id'=>$o->id))}}"
                                                       class="text-success fs-14 font-w600 me-3"
                                                       style="color:#fd683e !important"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                </div>

                                            @endif
                                            @can('manage-offers')
                                                <div class="col-xl-5 col-sm-3 col-lg-4 col-6 text-end check-btn">
                                                    <a href="@if($acct_type_id!= \App\Models\Account::IS_ADMIN) {{route('show-offer-details',array('offer_id'=>$o->id))}}@else {{route('show-offer-details-admin',array('offer_id'=>$o->id))}} @endif"
                                                       class=" fs-14 font-w600 me-3"><i class="fas fa-check-circle"></i></a>

                                                </div>
                                            @endcan
                                            @canDelete
                                            <div class="col-xl-5 col-sm-3 col-lg-4 col-6 text-end check-btn">
                                                <a href="{{route('delete-offer', $o->id)}}"
                                                   class="text-success fs-14 font-w600 me-3 sweet-confirm"
                                                   style="color:#fd683e !important"><i
                                                        class="fas fa-trash-alt"></i></a>
                                            </div>
                                            @endcanDelete
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

    <script>

        $(document).on('click', ".sweet-confirm", function (e) {
            var url = $(this).attr('href');
            e.preventDefault();
            swal({
                title: "Are you sure to delete ?",
                text: "You will not be able to recover it !!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it !!",
                cancelButtonText: "No, cancel it !!",
            }).then(
                (result) => {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type: "DELETE",
                            headers: {
                                'X-CSRF-Token': '{{ csrf_token() }}',
                            },
                            success: (data) => {
                                console.log('true')
                                if (data.status === 'true') {
                                    $(this).closest('tr').remove()
                                    toastr.success(data.message, "Great!", {
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
                                        tapToDismiss: !1
                                    })
                                } else {
                                    console.log('wring')
                                    toastr.success('Something went wrong', "Heads Up!", {
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
                                        tapToDismiss: !1
                                    })
                                }
                            }
                        });
                    }
                })
        });
    </script>

@endsection
