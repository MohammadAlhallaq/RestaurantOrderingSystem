@extends('layout.mainlayout')
@section('content')
    <!-- start page title -->
    {{--    <div class="row page-titles">--}}
    {{--        <ol class="breadcrumb">--}}
    {{--            <li class="breadcrumb-itemController active"><a href="javascript:void(0)">restaurant Admin</a></li>--}}
    {{--            <li class="breadcrumb-itemController"><a href="javascript:void(0)">Restaurant Category</a></li>--}}
    {{--        </ol>--}}
    {{--    </div>--}}

    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Comments</h4>
                </div>
                <div class="card-body p-0 dataTables_wrapper display dataTable"  >
                    @foreach($comments as $comment)
                        <div class="card review-table p-0 border-0">
                            <div class="d-lg-flex  d-block flex-wrap align-items-center py-4   border-bottom side-box">
                                <div class="col-xl-5 col-xxl-5 col-lg-5 col-md-12">
                                    <div class="media align-items-center review-img">

                                        <img class="me-3 img-fluid "
                                             src="{{URL::asset('dashboard-layout/images/avatar/unknown.jpg')}}"
                                             alt="DexignZone">
                                        <div class="card-body p-0">
                                            <p class="text-primary fs-14 mb-0">#{{$comment->id}}</p>
                                            <h3 class="fs-20 text-black font-w600 mb-2">{{$comment->customer_name}}</h3>
                                            <span class="text-dark">{{$comment->created_at}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-7 col-xxl-7 col-lg-7 col-md-12 mt-3 mt-lg-0">
                                    <p class="mb-0 text-dark" style="color: #ca8471 !important">{{$comment->comment_text}}
                                    </p>
                                </div>
{{--                                <div class="col-xl-3 col-xxl-4 col-lg-7 col-md-12 offset-lg-5 offset-xl-0 mt-xl-0 mt-3">--}}
{{--                                    <div class="row align-items-center">--}}

{{--                                        <div class="col-xl-5 col-sm-3 col-lg-4 col-6 text-end check-btn">--}}
{{--                                            <a href="" onclick="return markReadFunction({{$comment->id}})" class="text-success fs-14 font-w600 me-3"><i--}}
{{--                                                    class="far fa-check-circle"></i></a>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
{{--    pagination--}}
@endsection
{{--@section('js')--}}
{{--<script>--}}

{{--    function markReadFunction(id) {--}}

{{--        var url = 'approve_comment';--}}
{{--        $.ajax({--}}
{{--            url:url ,--}}
{{--            type: "post",--}}
{{--            dataType: "json",--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--            },--}}
{{--            data: {--}}

{{--                id: id--}}
{{--            },--}}
{{--            success: function (data) {--}}

{{--                if (data.status) {--}}

{{--                    location.reload();--}}
{{--                } else {--}}
{{--                    console.log(data);--}}
{{--                    --}}{{--    toast--}}
{{--                }--}}

{{--            }--}}
{{--        });--}}
{{--    }--}}
{{--</script>--}}
{{--@endsection--}}
