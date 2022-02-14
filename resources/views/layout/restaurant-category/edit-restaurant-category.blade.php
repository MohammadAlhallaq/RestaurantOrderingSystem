@extends('layout.mainlayout')
@section('content')
    <div class="row">
        <div class="col-md-12">

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
                        <form action="{{route('edit-category', array('category_id'=>$cat->id))}}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="profile-news">
                                                <div class="cover-photo rounded">
                                                    <img src="{{URL::asset($cat->cat_url)}}" alt="cat-image"
                                                         class="me-3 rounded"
                                                         style="width: 100%"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Category English
                                        Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                        <input type="text" class="form-control" name="categoryName" id="categoryName"
                                               placeholder="Enter english category name" required
                                               value="{{$cat->category_name}}">
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Category Arabic
                                        Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                        <input type="text" class="form-control" name="categoryNameAr"
                                               id="categoryNameAr"
                                               placeholder="Enter arabic category name" required
                                               value="{{$cat->category_name_ar}}">
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3" data-select2-id="100">
                                    <label class="text-label form-label">Select Sorting Number*</label>
                                    <select class="dropdown-groups select2-hidden-accessible" data-select2-id="5"
                                            tabindex="-1" aria-hidden="true" name="sort_number">
                                        <option value="">Select Number</option>
                                        @foreach(\App\Models\Category::all('id') as $category)
                                            @if (!in_array($category->id, \App\Models\Category::pluck('sort_id')->toArray()) || $category->id == $cat->sort_id)
                                                <option class="form-control"
                                                        value="{{$category->id}}" {{$cat->sort_id == $category->id ? 'selected' : ''}}>{{$category->id}}</option>
                                            @endif
                                        @endforeach
                                        @if((\App\Models\Category::orderBy('sort_id')->pluck('sort_id')->toArray()) === (\App\Models\Category::pluck('id')->toArray()))
                                            <option class="form-control"
                                                    value="{{\App\Models\Category::max('sort_id') + 1}}">{{\App\Models\Category::max('sort_id') + 1}}</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="mb-3 col-md-16">
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

@endsection
