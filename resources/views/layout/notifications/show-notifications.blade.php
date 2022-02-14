@extends('layout.mainlayout')

@section('content')

    <div class="col-xl-8 col-xxl-8 col-lg-8 offset-md-2">
        <div class="card">
            <div class="card-header  border-0 pb-0">
                <h4 class="card-title">Notifications</h4>
            </div>
            <div class="card-body">
                <div id="DZ_W_Todo1" class="widget-media dz-scroll height370 ps ps--active-y">
                    <ul class="timeline">

                        @if(auth()->user()->account_type_id == 1)
                            @foreach(auth()->user()->adminNotifications() as $notification)
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2">

                                            <img alt="image" width="50"
                                                 src="{{ URL::to('/') }}/restaurants/logo/{{$notification->logo_path != null? $notification->id .'/'. $notification->logo_path : 'bg-logo.png'}}">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-1">{{$notification->account_name}}
                                                : {{$notification->data}}!</h6>
                                            <small class="d-block">{{$notification->created_at}}</small>
                                        </div>
                                    </div>
                                </li>


                            @endforeach

                        @elseif(auth()->user()->account_type_id == 2)
                            @foreach(auth()->user()->restaurantNotifications() as $notification)
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2 media-success">
                                            <i class="fa fa-home"></i>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-1">{{$notification->username}}
                                                : {{$notification->data}}! <span class="badge light badge-success">{{$notification->type}}</span></h6>
                                            <small class="d-block">{{$notification->created_at}}</small>
                                        </div>
                                    </div>
                                </li>


                            @endforeach
                        @endif
                    </ul>
                    <div class="ps__rail-x" style="left: 0px; bottom: -75px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 75px; height: 324px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 61px; height: 263px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
