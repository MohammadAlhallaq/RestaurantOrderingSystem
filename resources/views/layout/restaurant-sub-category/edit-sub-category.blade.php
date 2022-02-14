@extends('layout.mainlayout')
@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sub Category Information</h4>
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

                        <form action="{{route('edit-sub-category', array('category_id'=>$cat->id))}}" method="post"
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
                                    <label class="text-label form-label" for="validationCustomUsername">Sub Category
                                        English
                                        Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                        <input type="text" class="form-control" name="categoryName" id="categoryName"
                                               placeholder="Enter Sub category English name" required
                                               value="{{$cat->sub_category_name}}">
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-label form-label" for="validationCustomUsername">Sub Category
                                        Arabic
                                        Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                        <input type="text" class="form-control" name="categoryNameAr"
                                               id="categoryNameAr"
                                               placeholder="Enter Sub category Arabic name" required
                                               value="{{$cat->sub_category_name_ar}}">
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">Select
                                            Currency</label>
                                        <select name="parent_cat" id="parent_cat" data-select2-id="single-select"
                                                tabindex="-1" class="default-select  form-control wide">
                                            <option value="">Choose Type</option>
                                            @foreach($parent_cat as $par)
                                                <option
                                                    value={{$par->id}}  {{$cat->parent_cat_id  == $par->id ? "selected" :""}}>{{$par->parent_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">

                                    <label class="text-label form-label" for="validationCustomUsername">Menu
                                        Photo</label>
                                    <div class="input-group">
                                        <div class="form-file">
                                            <input type="file" class="form-file-input form-control" name="menuPhoto"
                                                   id="menuPhoto" value="{{old('menuPhoto')}}">
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


