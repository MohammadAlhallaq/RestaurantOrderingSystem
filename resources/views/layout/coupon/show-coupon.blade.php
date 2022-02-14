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
                    <h4 class="card-title">Coupons</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>Coupon Code</th>

                                <th>Coupon Status</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $c)
                                <tr>
                                    <td>{{$c->coupon_code}}</td>

                                    <td>{{$c->status_name_en}}</td>
                                    <td>{{$c->created_at}}</td>
                                    <td>{{$c->updated_at}}</td>
                                    <td>

                                        <a title="Edit coupon"
                                           href="{{route('edit-coupon',array('coupon_id'=>$c->id))}}"
                                           class="btn btn-primary shadow btn-xs sharp me-1">
                                            <i class="fas fa-pencil-alt"></i></a>

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
