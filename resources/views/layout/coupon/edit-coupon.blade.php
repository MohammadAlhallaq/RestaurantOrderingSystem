@extends('layout.mainlayout')
@section('content')

    <div class="row">
        <div class="col-xl-12 col-xxl-12">

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
                              action="{{route('edit-coupon',array('coupon_id'=>$coupon->id))}}" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <div class="mb-3">
                                            <label class="text-label form-label" for="validationCustomUsername">Coupon
                                                Code</label>
                                            <div class="input-group">
                                                <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                                <input type="text" class="form-control" name="couponCode"
                                                       id="couponCode"
                                                       placeholder="Enter coupon code" readonly
                                                       value="{{$coupon->coupon_code}}">
                                                <div class="invalid-feedback">

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                    @foreach($currency as $cur)
                                        <div class="mb-3 col-md-6">
                                            <div class="mb-3">
                                                <label class="text-label form-label"
                                                       for="validationCustomUsername">Coupon Value</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"> <i
                                                            class="fa fa-list-alt"></i> </span>
                                                    <input type="text" class="form-control"
                                                           name='{{'couponValue'.$cur->id}}'
                                                           id='{{'couponValue'.$cur->id}}'
                                                           placeholder="Enter Coupon Value" readonly
                                                           value="{{$cur->coupon_value}}">
                                                    <div class="invalid-feedback">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <div class="mb-3">
                                                <label class="text-label form-label"
                                                       for="validationCustomUsername">Currency</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"> <i
                                                            class="fa fa-list-alt"></i> </span>
                                                    <input type="text" class="form-control"
                                                           name='{{'currency'.$cur->id}}'
                                                           id='{{'currency'.$cur->id}}'
                                                           readonly
                                                           value="{{$cur->currency_name}}">
                                                    <div class="invalid-feedback">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                    <div class="mb-3 col-md-6">
                                        <div class="mb-3">
                                            <label class="text-label form-label" for="validationCustomUsername">Select
                                                Coupon
                                                Status</label>

                                            <select name="coupon_status" id="coupon_status"
                                                    data-select2-id="single-select"
                                                    tabindex="-1" class="default-select  form-control wide">
                                                <option value="">Choose Status</option>
                                                @foreach($staus_arr as $sat)
                                                    <option
                                                        value={{$sat->id}}  {{ $coupon->status_id == $sat->id ? "selected" :""}}>{{$sat->status_name_en}}</option>
                                                @endforeach
                                            </select>
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
