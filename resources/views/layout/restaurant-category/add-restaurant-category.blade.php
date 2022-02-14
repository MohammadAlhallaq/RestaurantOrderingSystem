@extends('layout.mainlayout')
@section('content')
    <!-- start page title -->
    {{--    <div class="row">--}}
    {{--        <div class="col-12">--}}
    {{--            <div class="page-title-box">--}}
    {{--                <div class="page-title-right">--}}
    {{--                    <ol class="breadcrumb m-0">--}}
    {{--                        <li class="breadcrumb-itemController"><a href="javascript: void(0);"> restaurant Admin</a></li>--}}
    {{--                        <li class="breadcrumb-itemController"><a href="javascript: void(0);">Restaurant Category</a></li>--}}
    {{--                        <li class="breadcrumb-itemController active">Add Category</li>--}}
    {{--                    </ol>--}}
    {{--                </div>--}}
    {{--                <h4 class="page-title"></h4>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <!-- end page title -->
    <div class="row">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Category Information</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="my-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif (null !== session('errors') && session('errors')->any())
                        <div class="alert alert-danger">
                            <ul class="my-0">
                                @foreach (session('errors')->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="basic-form">
                        <form class="form-valide-with-icon needs-validation" action="{{route('add-category')}}"
                              method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">Category English
                                    Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                    <input type="text" class="form-control" name="categoryName" id="categoryName"
                                           placeholder="Enter English category name" required
                                           value="{{old('categoryName')}}">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">Category Arabic
                                    Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                    <input type="text" class="form-control" name="categoryNameAr" id="categoryNameAr"
                                           placeholder="Enter Arabic category name" required
                                           value="{{old('categoryNameAr')}}">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="text-label form-label">Select Sorting Number*</label>
                                <select class="dropdown-groups select2-hidden-accessible" data-select2-id="5"
                                        tabindex="-1" aria-hidden="true" name="sort_number">
                                    <option value="">Select Number</option>
                                    @foreach(\App\Models\Category::all('id') as $cat)
                                        @if (!in_array($cat->id, \App\Models\Category::pluck('sort_id')->toArray()))
                                            <option class="form-control"
                                                    value="{{$cat->id}}">{{$cat->id}}</option>
                                        @endif
                                    @endforeach

                                    @if((\App\Models\Category::orderBy('sort_id')->pluck('sort_id')->toArray()) === (\App\Models\Category::pluck('id')->toArray()))
                                        <option class="form-control"
                                                value="{{\App\Models\Category::max('sort_id') + 1}}">{{\App\Models\Category::max('sort_id') + 1}}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="mb-3 col-md-6">

                                <label class="text-label form-label" for="validationCustomUsername">Category
                                    Photo</label>
                                <div class="input-group">
                                    <div class="form-file">
                                        <input type="file" class="form-file-input form-control" name="catPhoto"
                                               id="catPhoto" value="{{old('catPhoto')}}">
                                    </div>
                                    <div class="invalid-feedback">

                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn me-2 btn-primary">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection
