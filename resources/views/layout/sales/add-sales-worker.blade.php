@extends('layout.mainlayout')
@section('content')

    <div class="row">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sales worker information</h4>
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
                              action="{{route('add-sales-worker')}}" method="post">
                            {{csrf_field()}}
                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">Worker Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                    <input type="text" placeholder="Enter worker name" class="form-control" name="workerName" id="workerName" required
                                           value="{{old('workerName')}}">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">Worker Code</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-outline-primary" id="generate-code">Generate Code</button>
                                    <input type="text" class="form-control readonly" name="workercode" id="workercode" required>
                                </div>
                            </div>
                                <button type="submit" class="btn me-2 btn-primary mt-3 pull-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection

@section('js')

    <script>
        $(".readonly").on('keydown paste focus mousedown', function(e){
            if(e.keyCode != 9) // ignore tab
                e.preventDefault();
        });
        $('#generate-code').click(function (){
            var firstPart = (Math.random() * 46656) | 0;
            var secondPart = (Math.random() * 46656) | 0;
            firstPart = ("000" + firstPart.toString(36)).slice(-3);
            secondPart = ("000" + secondPart.toString(36)).slice(-3);
            let code =  firstPart + secondPart;
            $("input[name=workercode]").val(code.toLocaleUpperCase())
        })
    </script>
@endsection
