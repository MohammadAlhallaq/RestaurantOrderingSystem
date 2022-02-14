@extends('layout.mainlayout')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Restaurant Sub Categories</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>English Name</th>
                                <th>Arabic Name</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cat as $c)
                                <tr>
                                    <td>{{$c->sub_category_name}}</td>
                                    <td>{{$c->sub_category_name_ar}}</td>
                                    <td>{{$c->created_at}}</td>
                                    <td>{{$c->updated_at}}</td>
                                    <td>

                                        @can('manage-sub-categories')
                                            <a title="Edit Category"
                                               href="{{route('edit-sub-category',array('category_id'=>$c->id))}}"
                                               class="btn btn-primary shadow btn-xs sharp me-1">
                                                <i class="fas fa-pencil-alt"></i></a>
                                        @endcan
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
