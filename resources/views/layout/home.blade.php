@extends('layout.mainlayout')
@section('content')
    <div class="row">
        @can('show-categories')
            <div class="col-xl-6 col-lg-12 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Restaurant Categories</h4>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="barChart_1" style="display: block; width: 452px; height: 226px;" width="452"
                                height="226" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        @endcan
        @can('show-payments')
            <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                <div class="widget-stat card bg-primary" style="background-color: #212130 !important;">
                    <div class="card-header border-0 pb-0">
                        <h3 class="card-title text-white">Payment Types</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="ico-sparkline">
                            <div id="sparkline12">
                                <canvas id="myChart" width="452" height="452"
                                        style="display: inline-block;width: 244px;height: 244px;"
                                        class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        @can('show-restaurants')
            <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <div class="media ai-icon">
									<span class="me-3 bgl-primary text-primary">
{{--										<i class="ti-shopping-cart"></i>--}}
                                        <i class="la la-cutlery"></i>
									</span>
                            <div class="media-body">
                                <p class="mb-1">Restaurants</p>
                                <h4 class="mb-0">{{$data['restaurantsNum']}}</h4>
                                <span class="badge badge-primary">+3.5%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        @can('show-packages')
            <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <div class="media ai-icon">
									<span class="me-3 bgl-primary text-primary">
                                        <i class="ti-package"></i>
									</span>
                            <div class="media-body">
                                <p class="mb-1">Packages</p>
                                <h4 class="mb-0">{{$data['packages']}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        @can('show-payments')
            <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body  p-4">
                        <div class="media ai-icon">
									<span class="me-3 bgl-success text-success">
										<svg id="icon-revenue" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-dollar-sign">
											<line x1="12" y1="1" x2="12" y2="23"></line>
											<path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
										</svg>
									</span>
                            <div class="media-body">
                                <p class="mb-1">Revenue</p>
                                <h4 class="mb-0">{{$data['payments']}} AED</h4>
                                {{--                            <span class="badge badge-danger">-3.5%</span>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        @can('show-customers')
            <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <div class="media ai-icon">
									<span class="me-3 bgl-primary text-primary">
{{--                                        <i class="la la-user"></i>--}}
                                        <i class="ti-user"></i>

									</span>
                            <div class="media-body">
                                <p class="mb-1">Customers</p>
                                <h4 class="mb-0">{{$data['customers']}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>
@endsection

@section('js')
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    'Cash',
                    'online',
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [{!! $data['cashPayments']!!}, {!! $data['onlinePayments'] !!}],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


    <script>
        var ctx = document.getElementById('barChart_1').getContext('2d');
        var labels = {!! json_encode($data['categories']) !!};
        var data = {!! json_encode($data['categoriesChartData']) !!};
        var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: 'rgb(54, 162, 235)',
                        hoverOffset: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            }
        );
    </script>
@endsection

