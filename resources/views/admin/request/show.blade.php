<!--//TODO ALLAN - Alterações débito na máquina e voucher-->
@extends('admin.layout.base')

@section('title', __('admin.request.request_details') )

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">@lang('admin.request.request_details')</h4>
            <a href="{{ URL::previous() }}" class="btn btn-default pull-right">
                <i class="fa fa-angle-left"></i> @lang('admin.back')
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">@lang('admin.request.Booking_ID')</dt>
                        <dd class="col-sm-8">{{ $request->booking_id }}</dd>
                        
                        {{-- <dt class="col-sm-4">@lang('admin.request.os_id')</dt>
                        <dd class="col-sm-8">{{ $request->os_id? $request->os_id:'N/A' }}</dd> --}}

                        <dt class="col-sm-4">@lang('admin.request.User_Name')</dt>
                        <dd class="col-sm-8">{{ $request->user->first_name }}</dd>

                        <dt class="col-sm-4">@lang('admin.request.Provider_Name')</dt>
                        @if($request->provider)
                        <dd class="col-sm-8">{{ $request->provider->first_name }}</dd>
                        @else
                        <dd class="col-sm-8">@lang('admin.request.provider_not_assigned')</dd>
                        @endif

                        <dt class="col-sm-4">@lang('admin.request.total_distance')</dt>
                        <dd class="col-sm-8">{{ $request->distance ? $request->distance : '0' }} {{$request->unit}}</dd>

                        @if($request->status == 'SCHEDULED')
                        <dt class="col-sm-4">@lang('admin.request.ride_scheduled_time')</dt>
                        <dd class="col-sm-8">
                            @if($request->schedule_at != "")
                                {{ strftime('%A, %d de %B de %Y', strtotime($request->schedule_at)) }}
                            @else
                                -
                            @endif
                        </dd>
                        @else
                        <dt class="col-sm-4">@lang('admin.request.ride_start_time')</dt>
                        <dd class="col-sm-8">
                            @if($request->started_at != "")
                                {{ strftime('%A, %d de %B de %Y', strtotime($request->started_at)) }}
                            @else
                                -
                            @endif
                         </dd>

                        <dt class="col-sm-4">@lang('admin.request.ride_end_time')</dt>
                        <dd class="col-sm-8">
                            @if($request->finished_at != "")
                                {{ strftime('%A, %d de %B de %Y', strtotime($request->finished_at)) }}
                            @else
                                -
                            @endif
                        </dd>
                        @endif

                        <dt class="col-sm-4">@lang('admin.request.pickup_address')</dt>
                        <dd class="col-sm-8">{{ $request->s_address ? $request->s_address : '-' }}</dd>

                        <dt class="col-sm-4">@lang('admin.request.drop_address')</dt>
                        <dd class="col-sm-8">{{ $request->d_address ? $request->d_address : '-' }}</dd>

                        @if($request->payment)
                        <dt class="col-sm-4">@lang('admin.request.base_price')</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->fixed) }}</dd>
                        @if($request->service_type->calculator=='MIN')
                            <dt class="col-sm-4">@lang('admin.request.minutes_price')</dt>
                            <dd class="col-sm-8">{{ currency($request->payment->minute) }}</dd>
                        @endif
                        @if($request->service_type->calculator=='HOUR')
                            <dt class="col-sm-4">@lang('admin.request.hours_price')</dt>
                            <dd class="col-sm-8">{{ currency($request->payment->hour) }}</dd>
                        @endif
                        @if($request->service_type->calculator=='DISTANCE')
                            <dt class="col-sm-4">@lang('admin.request.distance_price')</dt>
                            <dd class="col-sm-8">{{ currency($request->payment->distance) }}</dd>
                        @endif
                        @if($request->service_type->calculator=='DISTANCEMIN')
                            <dt class="col-sm-4">@lang('admin.request.minutes_price')</dt>
                            <dd class="col-sm-8">{{ currency($request->payment->minute) }}</dd>
                            <dt class="col-sm-4">@lang('admin.request.distance_price')</dt>
                            <dd class="col-sm-8">{{ currency($request->payment->distance) }}</dd>
                        @endif
                        @if($request->service_type->calculator=='DISTANCEHOUR')
                            <dt class="col-sm-4">@lang('admin.request.hours_price')</dt>
                            <dd class="col-sm-8">{{ currency($request->payment->hour) }}</dd>
                            <dt class="col-sm-4">@lang('admin.request.distance_price')</dt>
                            <dd class="col-sm-8">{{ currency($request->payment->distance) }}</dd>
                        @endif
                        <dt class="col-sm-4">@lang('admin.request.commission')</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->commision) }}</dd>

                        <dt class="col-sm-4">@lang('admin.request.discount_price')</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->discount) }}</dd>

                        <dt class="col-sm-4">@lang('admin.request.peak_amount')</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->peak_amount) }}</dd>

                        <dt class="col-sm-4">@lang('admin.request.peak_commission')</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->peak_comm_amount) }}</dd>

                        <dt class="col-sm-4">@lang('admin.request.waiting_charge')</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->waiting_amount) }}</dd>

                        <dt class="col-sm-4" style="padding-right:0px;">@lang('admin.request.waiting_commission')</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->waiting_comm_amount) }}</dd>

                        <dt class="col-sm-4">@lang('admin.request.tax_price')</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->tax) }}</dd>

                       <!--  <dt class="col-sm-4">@lang('admin.request.surge_price') :</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->surge) }}</dd> -->

                        <dt class="col-sm-4">@lang('admin.request.tips')</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->tips) }}</dd>

                        <dt class="col-sm-4">@lang('user.ride.round_off')</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->round_of) }}</dd>

                        <dt class="col-sm-4">@lang('admin.request.total_amount')</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->total+$request->payment->tips) }}</dd>

                        <dt class="col-sm-4">@lang('admin.request.wallet_deduction')</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->wallet) }}</dd>

                        <!-- <dt class="col-sm-4">@lang('admin.request.paid_amount') :</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->payable) }}</dd> -->

                        <dt class="col-sm-4">@lang('admin.request.payment_mode')</dt>
                        <dd class="col-sm-8">
                            @if($request->payment->payment_mode == 'CASH')
                            CASH
                            @elseif($request->payment->payment_mode == 'DEBIT_MACHINE')
                            DEBIT MACHINE
                            @elseif($request->payment->payment_mode == 'VOUCHER')
                                VOUCHER
                            @else
                                CARD
                            @endif
                        </dd>
                        
                        @if($request->payment->payment_mode=='CARD')
                            <dt class="col-sm-4">@lang('admin.request.card_amount')</dt>
                            <dd class="col-sm-8">{{ currency($request->payment->card) }}</dd>
                        @else
                            <dt class="col-sm-4">@lang('admin.request.cash_amount')</dt>
                            <dd class="col-sm-8">{{ currency($request->payment->cash) }}</dd>
                        @endif
                        <dt class="col-sm-4">@lang('admin.request.provider_earnings')</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->provider_pay - $request->payment->discount) }}</dd>

                        <dt class="col-sm-4">Comissão do Admin</dt>
                        <dd class="col-sm-8">{{ currency($request->payment->provider_commission) }}</dd>
                        @endif

                        <dt class="col-sm-4">@lang('admin.request.ride_status')</dt>
                        <dd class="col-sm-8">
                            @if($request->status == "COMPLETED")
                            <span class="tag tag-success">COMPLETED</span>
                            @elseif($request->status == "CANCELLED")
                            <span class="tag tag-danger">CANCELLED</span>
                            @elseif($request->status == "ARRIVED")
                            <span class="tag tag-info">ARRIVED</span>
                            @elseif($request->status == "SEARCHING")
                            <span class="tag tag-info">SEARCHING</span>
                            @elseif($request->status == "ACCEPTED")
                            <span class="tag tag-info">ACCEPTED</span>
                            @elseif($request->status == "STARTED")
                            <span class="tag tag-info">STARTED</span>
                            @elseif($request->status == "DROPPED")
                            <span class="tag tag-info">DROPPED</span>
                            @elseif($request->status == "PICKEDUP")
                            <span class="tag tag-info">PICKEDUP</span>
                            @elseif($request->status == "SCHEDULED")
                            <span class="tag tag-info">SCHEDULED</span>
                            @endif
                            <br /> {{ $request->cancel_reason }}
                        </dd>
                        @if($request->status =="COMPLETED")
                        <dt class="col-sm-4">@lang('admin.request.user_rating')</dt>
                        <dd class="col-sm-8">
                        @if($request->user_rated ==1)
                            {{ $request->rating->user_rating}}
                             @else
                                -
                            @endif
                        </dd>
                        <dt class="col-sm-4">@lang('admin.request.user_comment')</dt>
                        <dd class="col-sm-8">
                        @if($request->user_rated ==1)
                          {{ $request->rating->user_comment }}
                             @else
                                -
                            @endif
                        </dd>
                        <dt class="col-sm-4">@lang('admin.request.provider_rating')</dt>
                        <dd class="col-sm-8">
                        @if($request->provider_rated ==1)
                            {{ $request->rating->provider_rating }}
                             @else
                                -
                            @endif
                        </dd>
                        <dt class="col-sm-4">@lang('admin.request.provider_comment')</dt>
                        <dd class="col-sm-8">
                        @if($request->provider_rated ==1)
                            {{ $request->rating->provider_comment }}
                             @else
                                -
                            @endif
                        </dd>
                       @endif
                       <dt class="col-sm-4">@lang('admin.request.comments')</dt>
                       <dd class="col-sm-8">{{ $request->comments ? $request->comments : '-' }}</dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <div id="map"></div>
                </div>
            </div>
        </div>
        </div>
    </div>

@endsection

@section('styles')
<style type="text/css">
    #map {
        height: 450px;
    }
</style>
@endsection

@section('scripts')
<script type="text/javascript">
    var map;
    var zoomLevel = 11;

    function initMap() {

        map = new google.maps.Map(document.getElementById('map'));

        var marker = new google.maps.Marker({
            map: map,
            icon: '/asset/img/marker-start.png',
            anchorPoint: new google.maps.Point(0, -29)
        });

         var markerSecond = new google.maps.Marker({
            map: map,
            icon: '/asset/img/marker-end.png',
            anchorPoint: new google.maps.Point(0, -29)
        });

        var bounds = new google.maps.LatLngBounds();

        source = new google.maps.LatLng({{ $request->s_latitude }}, {{ $request->s_longitude }});
        destination = new google.maps.LatLng({{ $request->d_latitude }}, {{ $request->d_longitude }});

        marker.setPosition(source);
        markerSecond.setPosition(destination);

        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true, preserveViewport: true});
        directionsDisplay.setMap(map);

        directionsService.route({
            origin: source,
            destination: destination,
            travelMode: google.maps.TravelMode.DRIVING
        }, function(result, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                console.log(result);
                directionsDisplay.setDirections(result);

                marker.setPosition(result.routes[0].legs[0].start_location);
                markerSecond.setPosition(result.routes[0].legs[0].end_location);
            }
        });

        @if($request->provider && $request->status != 'COMPLETED')
        var markerProvider = new google.maps.Marker({
            map: map,
            icon: "/asset/img/marker-car.png",
            anchorPoint: new google.maps.Point(0, -29)
        });

        provider = new google.maps.LatLng({{ $request->provider->latitude }}, {{ $request->provider->longitude }});
        markerProvider.setVisible(true);
        markerProvider.setPosition(provider);
        console.log('Provider Bounds', markerProvider.getPosition());
        bounds.extend(markerProvider.getPosition());
        @endif

        bounds.extend(marker.getPosition());
        bounds.extend(markerSecond.getPosition());
        map.fitBounds(bounds);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('constants.map_key') }}&libraries=places&callback=initMap" async defer></script>
@endsection
