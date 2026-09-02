<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ app_name() ?? 'Tagxi' }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


</head>
<body>
    <div class="load-bar">
        <div class="bar"></div>
    </div>
    <div class="desktop-bg p2p" style="background-image: url('{{ web_booking_taxi() ?? asset("images/TAXI.png") }}'); background-attachment: fixed; background-size: cover; background-position: center;">
        <div></div>
    </div>
    <div class="content-wrapper">
        <div class="header-menu">
            <a href="{{ url('web-booking-history') }}"  class="back-button"> <i class="fa fa-arrow-left" style="font-size: 35px;padding:10px"></i></a>


        </div>
    </div>


    <div class="content-wrapper" id="cardShowing" style="overflow-y: auto; height: 89vh;">
        <div class="mt-2">

            <div class="row">

                <div class="col-12 col-lg-11 bx" >
                    <h5>Location Details</h5>
                    <div class="d-flex align-items-center justify-content-start mt-3 mb-3">
                        <div style="background:green;width:20px;height:20px;border-radius:50%;margin-right:5px;"></div>
                        <h6 class="ms-3" style="">{{ $rideInfo->pick_address}}</h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-start mt-3">
                        <div style="background:rgb(241, 1, 1);width:20px;height:20px;border-radius:50%;margin-right:5px;"></div>
                        <h6 class="ms-3" style="">-{{ $rideInfo->drop_address }}</h6>
                    </div>


@if($rideInfo->is_cancelled==0)
<div clss="mt-5" style="background:rgb(228, 228, 228);margin:10px 0;padding: 10px;">
    <div class="d-flex align-items-center justify-content-between mt-2">
        <div>
            <div style="background:green;padding:5px;border-radius:50%;width: 50px;height: 50px;margin:auto;font-size:28px;" class="text-white text-center"><i class="fa fa-check" aria-hidden="true"></i></div>
        </div>
        <div style="border:1px solid green;width:150px;margin:0 5px;"></div>
        <div>
           <div style="background:green;padding:5px;border-radius:50%;width: 50px;height: 50px;margin:auto;font-size:28px;" class="text-white text-center"><i class="fa fa-check" aria-hidden="true"></i></div>
        </div>
        <div style="border:1px solid green;width:150px;margin:0 5px;"></div>
        <div>
           <div style="background:green;padding:5px;border-radius:50%;width: 50px;height: 50px;margin:auto;font-size:28px;" class="text-white text-center"><i class="fa fa-check" aria-hidden="true"></i></div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between mt-3">
        <div>
        <p class="text-start"><strong>@lang('view_pages.arrived_at')</strong></p>
        <p class="text-center text-muted">
            {{ $rideInfo->converted_arrived_at }}
        </p>
        </div>
        <div>
            <p class="text-center"><strong>@lang('view_pages.started')</strong></p>
            <p class="text-center text-muted">
                {{ $rideInfo->converted_trip_start_time}}
            </p>
            </div>
            <div>
                <p class="text-center"><strong>@lang('view_pages.completed')</strong></p>
                <p class="text-center text-muted">
                    {{ $rideInfo->converted_completed_at }}
                </p>
                </div>
    </div>
</div>


<div class="d-flex align-items-center justify-content-between mt-3 mb-3">
    <!-- Content aligned to the start -->
    <div class="start-section">
        <div class="d-flex align-items-center justify-content-around">
            <div>
                <img src="{{ asset('assets\img\user-dummy.svg') }}" class="img-fluid rounded-circle" width="60px" alt="">
        </div>
        <div class="mx-2">
            <p class="ms-3">{{ $driverName }}</p>
            <p class="ms-3">{{ $rideInfo->vehicle_type_name }}</p>
        </div>
        </div>
    </div>

    <div class="end-section">
        <img src="profile.png" class="img-fluid rounded-circle" width="60px" alt="">
        <div class="text-end">
            <p class="ms-3">{{ $rideInfo->user_rated }}<i class="fa fa-star" aria-hidden="true"></i></p>
        </div>
    </div>
</div>


                <div clss="mt-5" style="background:rgb(228, 228, 228);margin:10px 0;padding: 10px;">
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <div>
                            <div class="text-center">
                                <h6>@lang('view_pages.reference_number')</h6>
                                <p><strong>{{ $rideInfo->request_number}}</strong></p>
                            </div>
                            <div class="text-center">
                                <h6>@lang('view_pages.distance')</h6>
                                <p><strong>{{$request_bill->total_distance}}</strong></p>
                            </div>
                        </div>
                        <div>
                            <div class="text-center">
                            <h6>Type of Ride</h6>
                            @if ($rideInfo->is_bid_ride==0)
                            <p><strong>Regular</strong></p>
                            @elseif($rideInfo->is_bid_ride==1)
                            <p><strong>Bidding</strong></p>
                            @endif
                            </div>
                            <div class="text-center">
                                <h6>Duration</h6>
                                <p><strong>{{$request_bill->total_time}}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
<section class="content-area">

    <div class="table-area">
        <h5 class="text-center">@lang('view_pages.fare_breakup')</h5>
      <table class="responsive-table table">
        <tbody>
          <tr>
            <td>@lang('view_pages.base_price')</td>
            <td>{{$request_bill->base_price}}</td>
          </tr>
          <tr>
            <td>@lang('view_pages.distance')</td>
            <td>{{$request_bill->total_distance}}</td>
          </tr>
          <tr>
            <td>@lang('view_pages.time_price')</td>
            <td>{{$request_bill->price_per_time}}</td>
          </tr>
          <tr>
            <td>@lang('view_pages.waiting_charge')</td>
            <td>{{$request_bill->waiting_charge_per_min}}</td>
          </tr>
          <tr>
            <td>@lang('view_pages.convenience_fee')</td>
            <td>{{$request_bill->admin_commision}}</td>
          </tr>
    @if($request_bill->airport_surge_fee>0)          
          <tr>
            <td>@lang('view_pages.airport_surge_fee')</td>
            <td>{{$request_bill->airport_surge_fee}}</td>
          </tr>
    @endif
          <tr>
            <td class="text-danger">@lang('view_pages.discount')</td>
            <td class="text-danger">{{$request_bill->promo_discount}}</td>
          </tr>
          <tr>
            <td>@lang('view_pages.service_tax')</td>
            <td>{{$request_bill->service_tax}}</td>
          </tr>
          <tr class="fw-bold">
            <td>@lang('view_pages.total_amount')</td>
            <td>{{$request_bill->total_amount}}</td>
          </tr>

        </tbody>
      </table>
    </div>
  </section>
            </div>
        </div>
    </div>
@elseif($rideInfo->is_cancelled==1)
<div clss="mt-5" style="background:rgb(228, 228, 228);margin:10px 0;padding: 10px;">
    <div class="d-flex align-items-center justify-content-center mt-2">

        <div>
           <div style="background:red;padding:5px;border-radius:50%;width: 50px;height: 50px;margin:auto;font-size:28px;" class="text-white text-center"><i class="fa fa-ban" aria-hidden="true"></i></div>
        </div>

    </div>
    <div class="d-flex align-items-center justify-content-center mt-3">

        <div>
            <p class="text-center"><strong>Cancelled</strong></p>
            <p class="text-center text-muted">
               {{$rideInfo->converted_cancelled_at}}
            </p>
            </div>

    </div>
</div>


@endif

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.2.2/firebase-app.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-database.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.2.2/firebase-auth.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
 <script>



    </script>
<style>

.bx{
    background:#ffffff;
    -webkit-box-shadow: 10px 10px 9px 7px rgba(235,235,235,1);
    -moz-box-shadow: 10px 10px 9px 7px rgba(235,235,235,1);
    box-shadow: 10px 10px 9px 7px rgba(235,235,235,1);padding: 20px;border-radius:20px;
    padding: 20px;
    border-radius:20px;
    border:1px solid #e4e4e4;
    margin-left: 17px

}
.header-menu {
    display: flex;
    align-items: flex-start;
    justify-content: space;
    width: 100%;

}



.table-area {
  position: relative;
  z-index: 0;
  margin-top: 10px;
}

table.responsive-table {
  display: table;
  width: 100%;
  height: 100%;
}

table.responsive-table thead {
  position: fixed;
  top: 15px;
  left: 0;
  right: 0;
  width: 100%;
  height: 50px;
  line-height: 3em;
  background: #eee;
  table-layout: fixed;
  display: table;
}

table.responsive-table th {
  background: #eee;
}

table.responsive-table td {
  line-height: 2em;
}

table.responsive-table tr > td,
table.responsive-table th {
  text-align: left;
}

@media (max-width: 768px) {
    .bx {
        width: calc(50% - 20px);
    }
}

@media (max-width: 576px) {
    .bx {
        width: calc(100% - 20px);
    }
}


</style>
   </body>
</html>
