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
                    <h4 class="card-title">Tax</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                            <tr>

                                <th>Tax Value</th>
                                <th>Currency</th>
                                <th>Tax Status</th>
                                <th>Created at</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tax as $c)
                                <tr>
                                    <td>{{$c->tax_value}}</td>
                                    <td>{{$c->currency_name}}</td>
                                    <td>{{$c->status_name_en}}</td>


                                    <td>{{$c->created_at}}</td>
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
