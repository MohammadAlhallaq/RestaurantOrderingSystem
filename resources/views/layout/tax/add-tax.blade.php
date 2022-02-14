@extends('layout.mainlayout')
@section('content')

    <div class="row">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Coupon Information</h4>
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
                              action="{{route('add-tax')}}" method="post">
                            {{csrf_field()}}

                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">Select Currency</label>

                                <select name="currency" id="currency" data-select2-id="single-select"
                                        tabindex="-1" class="default-select  form-control wide">
                                    <option value="">Choose Currency</option>
                                    @foreach($currency_arr as $sat)
                                        <option
                                            value={{$sat->id}}  {{ old('currency') == $sat->id ? "selected" :""}}>{{$sat->currency_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">Tax Value</label>
                                <div class="input-group">
                                    <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                    <input type="text" class="form-control" name="taxValue" id="taxValue"
                                           placeholder="Enter Tax  Value" required
                                           value="{{old('taxValue')}}">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn mt-3 me-2 btn-primary">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- end col -->
    </div>
@endsection
