@extends('layout.mainlayout')
@section('content')


    <div class="row">
        <div class="col-md-6">

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
                        <form action="{{route('add-sub-category')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">Sub Category English
                                    Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                    <input type="text" class="form-control" name="categoryName" id="categoryName"
                                           placeholder="Enter  Sub category  English name" required
                                           value="{{old('categoryName')}}">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">Sub Category arabic
                                    Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                    <input type="text" class="form-control" name="categoryNameAr" id="categoryNameAr"
                                           placeholder="Enter  Sub category Arabic name" required
                                           value="{{old('categoryNameAr')}}">
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
                                                value={{$par->id}}  {{old('parent_cat')  == $par->id ? "selected" :""}}>{{$par->parent_name}}</option>
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

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- end col -->
    </div>
@endsection
