
@extends('layout.mainlayout')
@section('content')

    <div class="row">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Belongings</h4>
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
                        <form class="form-valide-with-icon needs-validation"
                              action="{{route('add-belonging')}}" method="post">
                            {{csrf_field()}}

                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">Select Ingredients related to the meal</label>
                                <input hidden value="{{$item_id}}" name="item_id" id="item_id">
{{--                                <input hidden value="{{$component_arr}}" name="components" id="components">--}}
                                <select name="belongings[]" class="multi-select  form-control"  multiple data-select2-id="2" tabindex="-1" aria-hidden="true" >
                                    @foreach($belongings_arr as $com)
                                        <option class="form-control" value="{{$com->id}}">{{$com->item_name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" name="action" class="btn me-2 btn-primary" value="save">Submit</button>
                            <button type="submit" name="action" value="skip" class="btn me-2  btn-secondary">Skip</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- end col -->
    </div>
@endsection

