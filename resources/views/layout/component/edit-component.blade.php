@extends('layout.mainlayout')
@section('content')
    <!-- start page title -->



    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Component Information</h4>
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
                        <form action="{{ route('edit-component',array('component_id'=>$component->id))}}" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">Component
                                            English Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control" name="componentNameEn"
                                                   id="componentNameEn"
                                                   placeholder="Enter component English name" required
                                                   value="{{$component->component_name_en}}">
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">Component
                                            Arabic Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control" name="componentNameAr"
                                                   id="componentNameAr"
                                                   placeholder="Enter component arabic name" required
                                                   value="{{$component->component_name_ar}}">
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>
                                </div>

{{--                                @foreach($currency as $cur)--}}

{{--                                    <div class="mb-3 col-md-6">--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label class="text-label form-label"--}}
{{--                                                   for="validationCustomUsername">Price</label>--}}
{{--                                            <div class="input-group">--}}
{{--                                                <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>--}}
{{--                                                <input type="text" class="form-control" name='{{'componentPrice'.$cur->id}}'--}}
{{--                                                       id='{{'componentPrice'.$cur->id}}'--}}
{{--                                                       placeholder="Enter Meal price" required--}}
{{--                                                       value="@if(isset($cur->price)&&$cur->price!=null){{$cur->price}}@endif">--}}
{{--                                                <div class="invalid-feedback">--}}

{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-3 col-md-6">--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label class="text-label form-label"--}}
{{--                                                   for="validationCustomUsername">Currency</label>--}}
{{--                                            <div class="input-group">--}}
{{--                                                <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>--}}
{{--                                                <input type="text" class="form-control" name='{{'currency'.$cur->id}}'--}}
{{--                                                       id='{{'currency'.$cur->id}}'--}}
{{--                                                       readonly--}}
{{--                                                       value="{{$cur->currency_name}}">--}}


{{--                                                <div class="invalid-feedback">--}}

{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                @endforeach--}}
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
