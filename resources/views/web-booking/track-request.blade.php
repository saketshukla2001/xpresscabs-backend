<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request - {{ app_name() ?? 'Tagxi' }}</title>
    <link rel="shortcut icon" href="{{ fav_icon() ?? asset('assets/img.logo.png') }}">
    <link rel="stylesheet" href="{!! asset('css/track-request.css') !!}">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

    <style>
        /* Map Styles */
        #map {
            height: 400px;
            width: 100%;
            padding: 10px;
        }

        th, td {
            text-align: center;
        }

        .highlight {
            color: red;
            font-weight: 800;
            font-size: large;
        }

        /* Timeline Styles */
        @media (min-width:992px) {
            .page-container {
                max-width: 1140px;
                margin: 0 auto;
            }

            .page-sidenav {
                display: block !important;
            }
        }

        .padding {
            padding: 2rem;
        }

        .w-32 {
            width: 32px !important;
            height: 32px !important;
            font-size: .85em;
        }

        .circle {
            border-radius: 500px;
        }

        .gd-warning {
            color: #fff;
            border: none;
            background: #f4c414 linear-gradient(45deg, #f4c414, #f45414);
        }

        .timeline {
            position: relative;
            border-color: rgba(160, 175, 185, .15);
            padding: 0;
            margin: 0;
        }

        .p-4 {
            padding: 1.5rem !important;
        }

        .block, .card {
            background: #fff;
            border-width: 0;
            border-radius: .25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
            margin-bottom: 1.5rem;
        }

        .mb-4, .my-4 {
            margin-bottom: 1.5rem !important;
        }

        .tl-item {
            border-radius: 3px;
            position: relative;
            display: flex;
        }

        .tl-item>* {
            padding: 10px;
        }

        .tl-dot {
            position: relative;
            border-color: rgba(160, 175, 185, .15);
        }

        .tl-dot:after, .tl-dot:before {
            content: '';
            position: absolute;
            border-color: inherit;
            border-width: 2px;
            border-style: solid;
            border-radius: 50%;
            width: 10px;
            height: 10px;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
        }

        .tl-dot:after {
            width: 0;
            height: auto;
            top: 25px;
            bottom: -15px;
            border-right-width: 0;
            border-top-width: 0;
            border-bottom-width: 0;
            border-radius: 0;
        }

        .tl-item.active .tl-dot:before {
            border-color: #34b807;
            box-shadow: 0 0 0 4px rgba(68, 139, 255, .2);
        }

        .tl-content p:last-child {
            margin-bottom: 0;
        }

        .tl-date {
            font-size: .85em;
            margin-top: 2px;
            min-width: 200px;
        }

        .avatar {
            position: relative;
            line-height: 1;
            border-radius: 500px;
            white-space: nowrap;
            font-weight: 700;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
            box-shadow: 0 5px 10px 0 rgba(50, 50, 50, .15);
        }

        .b-warning {
            border-color: #b1b1b1 !important;
        }

        .b-primary {
            border-color: #f63f3f !important;
        }

        .b-danger {
            border-color: #f54394 !important;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 69%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .payment-list {
            display: flex;
            flex-direction: column;
            margin: auto;
            align-items: center;
        }

        /* width */
        ::-webkit-scrollbar {
            width: 0px;
        }

        @media (min-width:786px) {
            .modal-content {
                width: 30%;
            }
        }

        @media (max-width:320px) {
            .modal-content {
                width: 100%;
            }
        }

        .payment-mode {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        @media (max-width: 768px) {
            .bx {
                width: calc(50% - 20px);
                margin-left: 0;
                margin-right: 17px;
            }
        }

        @media (max-width: 576px) {
            .bx {
                width: calc(100% - 20px);
                margin-right: 0;
            }
        }

        .bx {
            background: #ffffff;
            box-shadow: 10px 10px 9px 7px rgba(235, 235, 235, 1);
            padding: 20px;
            border-radius: 20px;
            border: 1px solid #e4e4e4;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
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
            position: sticky;
            top: 0;
            background: #eee;
        }

        table.responsive-table th {
            background: #eee;
        }

        table.responsive-table td {
            line-height: 2em;
            text-align: left;
        }

        table.responsive-table tr > td, table.responsive-table th {
            text-align: left;
        }

        p {
            margin-top: 0;
            margin-bottom: 0rem;
        }

        .fw-extra-bold {
            font-weight: 700;
        }
    </style>

<body class="bg-white-400">
<div class="row" style="height:100vh;margin:auto">
    <div class="col-12 col-lg-12 mt-10">

        <div class="payment-mode-details" id="payment1" style="display: none;">
            <div class="desktop-bg p2p" style="background-image: url('{{ web_booking_taxi() ?? asset("images/TAXI.png") }}'); background-attachment: fixed; background-size: cover; background-position: center;">
                <div></div>
            </div>
        <div class="content-wrapper" id="cardShowing" style="overflow-y: auto; height: 89vh;">
            <div class="mt-2">

                <div class="row">
                        <div class="col-12 col-lg-11 bx" >
                            <div class="col-12 col-lg-11 bx" style="text-align: center;">
                                <h5>@lang('view_pages.ride_ended')</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-start mt-3 mb-3">
                                <div style="background:green;width:20px;height:20px;border-radius:50%;margin-right:5px;"></div>
                                <h6 class="ms-3" style="">{{ $rideInfo->pick_address}}</h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-start mt-3">
                                <div style="background:rgb(241, 1, 1);width:20px;height:20px;border-radius:50%;margin-right:5px;"></div>
                                <h6 class="ms-3" style="">-{{ $rideInfo->drop_address}}</h6>
                            </div>


        @if( $rideInfo->is_cancelled==0)
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
                    {{ $rideInfo->converted_arrived_at}}
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
                            {{ $rideInfo->converted_completed_at}}
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
                    <p class="ms-3">{{ $rideInfo->vehicle_type_name}}</p>
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
                                    {{-- <div class="text-center">
                                        <h6>Distance</h6>
                                        <p><strong>{{$request_bill->total_distance}}</strong></p>
                                    </div> --}}
                                </div>
                                <div>
                                    <div class="text-center">
                                        <h6>@lang('view_pages.type_of_ride')</h6>

                                        @if($rideInfo->is_rental==0 && $rideInfo->is_bid_ride==0)
                                        <p><strong>@lang('view_pages.regular')</strong></p>
                                        @elseif($rideInfo->is_bid_ride==1)
                                        <p><strong>@lang('view_pages.bidding')</strong></p>
                                        @endif
                                        </div>
                                    {{-- <div class="text-center">
                                        <h6>Duration</h6>
                                        <p><strong>{{$request_bill->total_time}}</strong></p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>



    <section class="content-area">

        <div class="table-area">
            <h5 class="text-center">@lang('view_pages.fare_breakup')</h5>
          <table class="responsive-table table">
            <tbody>


                  <tr>
                    <td>@lang('view_pages.payment_method')</td>
                    <td>
                        <div id="payment-method" class="price-data-value"></div>
                    </td>
                  </tr>
                  @if($rideInfo->is_bid_ride==0)

                  <tr>
                    <td>@lang('view_pages.base_price')</td>
                    <td  id="basePriceValue"></td>
                </tr>
                <tr>
                    <td >@lang('view_pages.distance')</td>
                    <td id="distanceprice"></td>
                </tr>
                <tr>
                    <td>@lang('view_pages.time_price')</td>
                    <td id="timeprice"></td>
                </tr>
                <tr>
                    <td>@lang('view_pages.convenience_fee')</td>
                    <td id="conveniencefee"></td>
                </tr>
                  <tr>
                    <td>@lang('view_pages.service_tax')</td>
                    <td id="servicetax"></td>
                  </tr>
                  <tr class="fw-bold">
                    <td>@lang('view_pages.total_amount')</td>
                    <td id="totalprice"></td>
                  </tr>
                </tbody>
            </table>

          @if($request->payment_opt=="0" && $request->is_paid=="0" &&$request->web_booking)
          <div class="text-center mt-10">
              <button class="btn btn-primary" id="openModalButton" style="margin:auto;">@lang('view_pages.pay')</button>
              </div>
              @elseif($request->web_booking)
              <div class="text-center mt-10">
                <button class="btn btn-primary" id="newbook" style="margin:auto;">@lang('view_pages.book_again')</button>
            </div>
            @else
          @endif
                  @else


                  <tr class="fw-bold">
                    <td>@lang('view_pages.total_amount')</td>
                    <td class="fw-extra-bold"id="totalprice"></td>
                  </tr>
                </tbody>
            </table>
            @if($request->payment_opt=="0" && $request->is_paid=="0" && $request->web_booking)
          <div class="text-center mt-10">
              <button class="btn btn-primary" id="openModalButton" style="margin:auto;">@lang('view_pages.pay')</button>
              </div>
              @elseif($request->web_booking)
              <div class="text-center mt-10">
                <button class="btn btn-primary" id="newbook" style="margin:auto;">@lang('view_pages.book_again')</button>
            </div>
            @else
          @endif


                  <script>
                    const id = "{{ $request->id }}";


async function fetchData() {
    try {
        const response = await fetch(`/totalaccount/${id}`);
        const data = await response.json();
        const datav = data.datavalue;
        const totalpriceElement = document.getElementById('totalprice');
        totalpriceElement.textContent = datav.total_amount;

    } catch (error) {
        console.error('Error fetching data:', error);
    }
    var redirectButton = document.getElementById('newbook');
    redirectButton.addEventListener('click', function() {
        window.location.href = "{{ url('/web-booking') }}";
    });
}

        fetchData();
                  </script>
                 @endif



        </div>
      </section>
                </div>
            </div>

        </div>



    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="d-flex align-items-center justify-content-between">
                <p>Choose Payment Method</p>
                <span class="close">&times;</span>
            </div>
            <div class="payment-list p-5 overflow-auto" style="height:300px;" id="paymentOptions"></div>
        </div>
    </div>
    <br>
</div>
    <div class="col-12 col-lg-8" id="backgroundImage" style="background:url('{{asset('images/pay.jpg')}}');display: none;"></div>
</div>
@endif


<div class="col-12 col-lg-5" id="image5" style="display: block;height:700px;overflow-y:auto;">
        <!-- Trip Details bg-orange-300 shadow-lg-->
        <div class="m-1 p-2 rounded shadow-lg" id= "image1">
            <div class="mx-auto d-flex justify-content-center align-items-center mb-5 p-3">
                <!-- <div class="w-full text-center"> -->
                <strong class="text-blue-900 mx-2">{{ $request->request_number }} -</strong>
                <div class="text-black font-bold ml-3 trip_status"></div>


                <!-- </div> -->
            </div>
                            <div class="text-center text-black font-bold text-center ride_otp"><strong> </strong></div>
            <hr>

  <!-- Map -->
        <div class="lg:mt-10 mt-6">
            <div id="map"></div>
        </div>

                <!-- <div class="text-center text-black font-bold text-center ride_otp"><strong> </strong></div> -->

        </div>



        <!-- Driver Details -->
        <div class="bg-white rounded shadow-lg m-5 p-3 lg:mt-10" id="image2">

            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div>
                    <img src="{{ $request->driverDetail->user->profile_pic ?? 'https://cdn4.iconfinder.com/data/icons/rcons-user/32/child_boy-128.png' }}" alt="" class="rounded-full h-12 w-12 flex items-center justify-center" width="50" height="50">
                    </div>
                   <div class="mx-2">
                        <p class="text-gray-900">{{ ucfirst($request->driverDetail?$request->driverDetail->name : "-"  )}}</p>
                    <p class="d-flex">
                        @php 
                        $request_rating = $request->driverDetail?$request->driverDetail->user->rating:0;
                        @endphp
                        @for($i = 0; $i < 5; $i++)
                            @if($i < $request_rating)
                                <img src="https://cdn0.iconfinder.com/data/icons/typicons-2/24/star-64.png" alt="filled star" class="h-4 w-4 items-center justify-center" style="filter: sepia(100%) saturate(1000%) hue-rotate(180deg);">
                            @else
                                <img src="https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/star-128.png" alt="empty star" class="h-4 w-4 items-center justify-center" style="filter: grayscale(100%);">
                            @endif
                        @endfor
                    </p>

                    </div>
                    </div>
                    <div class="text-center">
                @if($request->is_bid_ride==1)
                    <p style="color:red;">
                        @lang('view_pages.estimated_price')
                        {{$request->requested_currency_symbol?? ''}}
                        {{ $request->accepted_ride_fare ?? ''}}
                    </p>
                @else
                    <p style="color:red;">
                        @lang('view_pages.estimated_price')
                        {{$request->requested_currency_symbol?? ''}}
                        {{ $request->request_eta_amount ?? ''}}
                    </p>
                @endif
                    </div>




                <div class="text-center mt-2">
                <ul class="box-controls pull-right">
                <li>
                <div class="">
                    <p>{{ $request->driverDetail->car_number ?? ''}}</p>
                </div>
                </li>
                 <li>
                    <p class="ml-2 text-gray-900">{{ $request->driverDetail->car_make_name ?? ''}}</p>
                </li>
                <li>
                    <p class="ml-2 text-gray-900">{{ $request->driverDetail->car_model_name ?? ''}}</p>
                </li>
                    </div>
                </ul>

                </div>
                </div>

            <hr>



<!-- pickup & drop address -->

<div class="page-content page-container" id="page-content" style="display: block;">
<div class="padding">
    <div class="row">

        <div class="col-lg-12">
            <div><h5>Location Details</h5></div>
            <div class="timeline p-4 block mb-4">
                <div class="tl-item active">
                    <div class="tl-dot b-warning"></div>
                    <div class="tl-content">
                        <div class="">Pickup</div>
                        <div class="tl-date text-muted mt-1">{{ str_limit($request->requestPlace->pick_address,30) }}</div>
                    </div>
                </div>
                <div class="tl-item">
                    <div class="tl-dot b-primary"></div>
                    <div class="tl-content">
                        <div class="">Drop</div>
                        <div class="tl-date text-muted mt-1">{{ str_limit($request->requestPlace->drop_address,30) }}</div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>
</div>
</div>
<div class="col-12 col-lg-7" id="image6" style="background:url('{{web_booking_track() ??asset('images/track1.jpg')}}');background-size:cover;background-repeat:no-repeat;display: block"></div>
</div>

{{--
    <div class="col-12 col-lg-5" id="image5" style="display: block;">
        <!-- Trip Details bg-orange-300 shadow-lg-->
        <div class="m-1 p-2 rounded shadow-lg" id= "image1">
            <div class="mx-auto d-flex justify-content-center align-items-center mb-5 p-3">
                <!-- <div class="w-full text-center"> -->
                <strong class="text-blue-900 mx-2">{{ $request->request_number }} - </strong>
                <div class="text-md text-black font-bold ml-3 trip_status"></div>


                <!-- </div> -->
            </div>
            <hr>

  <!-- Map -->
        <div class="lg:mt-10 mt-6">
            <div id="map"></div>
        </div>

                <p class="text-md text-black font-bold ml-3 ride_otp"></p>

        </div>



        <!-- Driver Details -->
        <div class="bg-white rounded shadow-lg m-5 p-3 lg:mt-10" id="image2">
            <div class="flex justify-between">

                <div class="flex items-center">
                    <img src="{{ $request->driverDetail->user->profile_pic ?? 'https://cdn4.iconfinder.com/data/icons/rcons-user/32/child_boy-128.png' }}" alt="" class="rounded-full h-12 w-12 flex items-center justify-center" width="50" height="50">

                    <div class="flex-column ml-2">
                        <p class="text-gray-900">{{ ucfirst($request->driverDetail->name) ?? ''}}</p>

                        <p class="flex flex-row">
                            @for($i = 0; $i < $request->driverDetail->user->rating; $i++ ?? '')
                                <img src="https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/star-128.png" alt="" class="h-4 w-4 items-center justify-center bg-yellow">
                            @endfor
                        </p>

                    </div>
                    <div class="flex items-center ml-3 text-center">
                    <p style="color:red;">
                        @lang('view_pages.estimated_price')
                    {{$request->requested_currency_symbol?? ''}}  {{ $request->request_eta_amount ?? ''}}
                    </p>
                </div>

                </div>


                <div class="flex items-center">
                <ul class="box-controls pull-right">
                <li>
                <div class="flex" style="border:1px solid black;padding: 5px;margin-left: 5px;">
                    <p>{{ $request->driverDetail->car_number ?? ''}}</p>
                </div>
                </li>
                 <li>
                    <p class="ml-2 text-gray-900">{{ $request->driverDetail->car_make_name ?? ''}}</p>
                    <p class="ml-2 text-gray-900">{{ $request->driverDetail->car_model_name ?? ''}}</p>
                </li>
                    </div>
                </ul>

                </div>
            </div>

            <hr>



<!-- pickup & drop address -->

<div class="page-content page-container" id="page-content" style="display: block;">
<div class="padding">
    <div class="row">

        <div class="col-lg-6">
            <p>Location Details</p>
            <div class="timeline p-4 block mb-4">
                <div class="tl-item active">
                    <div class="tl-dot b-warning"></div>
                    <div class="tl-content">
                        <div class="">Pickup</div>
                        <div class="tl-date text-muted mt-1">{{ str_limit($request->requestPlace->pick_address,30) }}</div>
                    </div>
                </div>
                <div class="tl-item">
                    <div class="tl-dot b-primary"></div>
                    <div class="tl-content">
                        <div class="">Drop</div>
                        <div class="tl-date text-muted mt-1">{{ str_limit($request->requestPlace->drop_address,30) }}</div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>
</div>
<div class="col-12 col-lg-7"><img src="" alt=""></div>
--}}
</div>

    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&sensor=false&libraries=places"></script>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>
<script>
      fetch('/paymentenable')
        .then(response => response.json())
        .then(data => {
            const paymentOptionsContainer = document.getElementById('paymentOptions');
            paymentOptionsContainer.innerHTML = '';

                    if (data.mercadopago) {
                        paymentOptionsContainer.innerHTML += `
                            <a href="#" class="payment-option" data-method="mercadopago">
                                <img src="{{ asset('assets/img/mercadepago.png')}}" class="img-fluid" width="100px" alt="">
                            </a>`;
                    }

                    if (data.stripe) {
                        paymentOptionsContainer.innerHTML += `
                            <a href="#" class="payment-option mt-4" data-method="stripe">
                                <img src="{{ asset('assets/img/stripe.png')}}" class="img-fluid" width="100px" alt="">
                            </a>`;
                    }

                    if (data.razor_pay) {
                        paymentOptionsContainer.innerHTML += `
                            <a href="#" class="payment-option mt-4" data-method="razor_pay">
                                <img src="{{ asset('assets/img/razor_pay.png')}}" class="img-fluid" width="100px" alt="">
                            </a>`;
                    }

                    if (data.paystack) {
                        paymentOptionsContainer.innerHTML += `
                            <a href="#" class="payment-option mt-4" data-method="paystack">
                                <img src="{{ asset('assets/img/paystack.png')}}" class="img-fluid" width="100px" alt="">
                            </a>`;
                    }

                    if (data.khalti_pay) {
                        paymentOptionsContainer.innerHTML += `
                            <a href="#" class="payment-option mt-4" data-method="khalti">
                                <img src="{{ asset('assets/img/khalti.png')}}" class="img-fluid" width="100px" alt="">
                            </a>`;
                    }

                    if (data.cash_free) {
                        paymentOptionsContainer.innerHTML += `
                            <a href="#" class="payment-option mt-4" data-method="cashfree">
                                <img src="{{ asset('assets/img/cashfree.png')}}" class="img-fluid" width="100px" alt="">
                            </a>`;
                    }

                    if (data.flutter_wave) {
                        paymentOptionsContainer.innerHTML += `
                            <a href="#" class="payment-option mt-4" data-method="flutterwave">
                                <img src="{{ asset('assets/img/flutterwave.png')}}" class="img-fluid" width="100px" alt="">
                            </a>`;
                    }

                    if (data.paymob) {
                        paymentOptionsContainer.innerHTML += `
                            <a href="#" class="payment-option mt-4" data-method="paymob">
                                <img src="{{ asset('assets/img/paymob.png')}}" class="img-fluid" width="100px" alt="">
                            </a>`;
                    }
                    if (data.braintree_tree) {
                        paymentOptionsContainer.innerHTML += `
                            <a href="#" class="payment-option mt-4" data-method="braintree_tree">
                                <img src="{{ asset('assets/img/braintree_tree.png')}}" class="img-fluid" width="100px" alt="">
                            </a>`;
                    }
                    if (data.paypal) {
                        paymentOptionsContainer.innerHTML += `
                            <a href="#" class="payment-option mt-4" data-method="paypal">
                                <img src="{{ asset('assets/img/paypal.png')}}" class="img-fluid" width="100px" alt="">
                            </a>`;
                    }
                    if (data.razor) {
                        paymentOptionsContainer.innerHTML += `
                            <a href="#" class="payment-option mt-4" data-method="razorpay">
                                <img src="{{ asset('assets/img/razor.png')}}" class="img-fluid" width="100px" alt="">
                            </a>`;
                    }


            })
            .catch(error => console.error('Error fetching payment options:', error));
</script>

    <script type="text/javascript">
        var carimage = "{{ url('map/car.png') }}";
        var driverId = '{{ $request->driverDetail?$request->driverDetail->id:null }}';
        var requestId = '{{ $request->id }}';
        var driverLat, driverLng, bearing;

        // Your web app's Firebase configuration
    var firebaseConfig = {
    apiKey: "{{get_settings('firebase-api-key')}}",
    authDomain: "{{get_settings('firebase-auth-domain')}}",
    databaseURL: "{{get_settings('firebase-db-url')}}",
    projectId: "{{get_settings('firebase-project-id')}}",
    storageBucket: "{{get_settings('firebase-storage-bucket')}}",
    messagingSenderId: "{{get_settings('firebase-messaging-sender-id')}}",
    appId: "{{get_settings('firebase-app-id')}}",
    measurementId: "{{get_settings('firebase-measurement-id')}}"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        firebase.analytics();



var tripRef = firebase.database().ref('requests/' + requestId);

tripRef.on('value', function(snapshot) {
    var data = snapshot.val();
    console.log(data);

    var tripStatusText = '';




const headDiv = document.getElementById('payment1');
    const headDiv1 = document.getElementById('image5');
    const headDiv11 = document.getElementById('image6');
    const headDiv2 = document.getElementById('page-content');
    const is_paid = "{{ $request->is_paid }}";






    if (data.is_completed) {




        const id = "{{ $request->id }}";


async function fetchData() {
    try {
        const response = await fetch(`/totalaccount/${id}`);
        const data = await response.json();
        const datav = data.datavalue;
        totalAmount= datav.total_amount;
        const basePriceElement = document.getElementById('basePriceValue');
        const distancepriceElement = document.getElementById('distanceprice');
        const timepriceElement = document.getElementById('timeprice');
        const servicetaxElement = document.getElementById('servicetax');
        const conveniencefeeElement = document.getElementById('conveniencefee');
        const totalpriceElement = document.getElementById('totalprice');

        basePriceElement.textContent = datav.base_price;
        distancepriceElement.textContent = datav.distance_price;
        timepriceElement.textContent = datav.time_price;
        servicetaxElement.textContent = datav.service_tax;
        conveniencefeeElement.textContent = datav.admin_commision;
        totalpriceElement.textContent = datav.total_amount;

    } catch (error) {
        console.error('Error fetching data:', error);
    }
    var redirectButton = document.getElementById('newbook');
    redirectButton.addEventListener('click', function() {
        window.location.href = "{{ url('/web-booking') }}";
    });
}

        fetchData();

// let totalAmount = datav.total_amount;

        headDiv.style.display = 'block';
        headDiv1.style.display = 'none';
        headDiv11.style.display = 'none';
        headDiv2.style.display = 'none';
        backgroundImage.style.display = 'block';

        const paymentMethodSelect = document.getElementById("payment-method");
        const payment_option = "{{ $request->payment_opt }}";
        const openModalButton = document.getElementById("openModalButton");
        const modal = document.getElementById("myModal");
        const closeModalSpan = modal.querySelector(".close");
        const paymentOptions = document.querySelectorAll('.payment-option');

        function showModal() {
            modal.style.display = "block";
        }

        function hideModal() {
            modal.style.display = "none";
        }
        function updatePaymentOptions(paymentValue) {
    paymentMethodSelect.innerHTML = '';
    if (paymentValue === '1') {
        paymentMethodSelect.innerHTML = 'Pay Via Cash';
    } else if (paymentValue === '0') {
        paymentMethodSelect.innerHTML = 'Pay Via Card';
    }
}

        updatePaymentOptions(payment_option);
        paymentMethodSelect.addEventListener('change', function() {
            const selectedPaymentMethod = paymentMethodSelect.value;
            updatePaymentOptions(selectedPaymentMethod);
        });

        openModalButton.addEventListener("click", function() {
       const selectedPaymentMethod = payment_option;
    if (selectedPaymentMethod !== '1') {
        showModal();
    } else {
        hideModal();

        location.reload();
    }
});


        closeModalSpan.addEventListener("click", hideModal);

        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                hideModal();
            }
        });
        paymentOptions.forEach(option => {
        option.addEventListener('click', function(event) {
        event.preventDefault();
        const selectedMethod = option.getAttribute('data-method');
        const requestId = "{{ $request->id }}";
        const user_id = "{{ $request->user_id}}";
        const currency = "{{ $request->requested_currency_code }}";

        let url = `/${selectedMethod}`;
        url += `?amount=${totalAmount}&currency=${currency}&user_id=${user_id}&request_id=${requestId}`;

        window.location.href = url;
    });
});

    }

else if (data.is_cancelled == true) {
        tripStatusText = '@lang("view_pages.trip_cancelled")';
    } else if (data.trip_start == "1") {
        tripStatusText = '@lang("view_pages.trip_started")';

    } else if (data.trip_arrived == "1") {
        tripStatusText = '@lang("view_pages.driver_arrived")';

        // Display ride OTP and set its value
        rideOtpElement.textContent = '@lang("view_pages.ride_otp") : ' + '{{ $request->ride_otp }}';

        // Replace the existing trip status element
        var existingTripStatusElement = document.querySelector('.trip_status');
        if (existingTripStatusElement) {
            existingTripStatusElement.replaceWith(tripStatusElement);
        }

        // Append the ride OTP element
        var rideOtpContainer = document.querySelector('.ride_otp');
        if (rideOtpContainer) {
            rideOtpContainer.replaceWith(rideOtpElement);
        }
    } else {

        rideOtpElement.textContent = '@lang("view_pages.ride_otp") : ' + '{{ $request->ride_otp }}';
        var rideOtpContainer = document.querySelector('.ride_otp');
        if (rideOtpContainer) {
            rideOtpContainer.replaceWith(rideOtpElement);
        }
        tripStatusText = '@lang("view_pages.driver_is_on_the_way")';

    }

        tripStatusElement.textContent = tripStatusText;

        var existingTripStatusElement = document.querySelector('.trip_status');
        if (existingTripStatusElement) {
            existingTripStatusElement.replaceWith(tripStatusElement);
        }
    });

    var tripStatusElement = document.createElement('p'); // Create a new <p> element
tripStatusElement.classList.add('text-md', 'text-black', 'font-bold', 'ml-3', 'trip_status'); // Add classes to the element

var rideOtpElement = document.createElement('p'); // Create a new <p> element for ride OTP
rideOtpElement.classList.add('text-md', 'text-black', 'font-bold', 'ml-3', 'ride_otp'); // Add classes to the element

        var tripRef = firebase.database().ref('requests/' + requestId);

        tripRef.on('value', async function(snapshot) {

            var data = snapshot.val();

            console.log(data);

            driverLat = data.lat;
            driverLng = data.lng;
            bearing = data.bearing;

            await loadCarInMap(driverLat, driverLng, bearing, carimage);

            // await rotateMarker(bearing);
        });


        var area1, area2, icon1, icon2;

        area1 = "{{ $request->pick_address }}";
        area2 = "{{ $request->drop_address }}";
        icon1 = "{{ url('map/start_pin_flag.png') }}";
        icon2 = "{{ url('map/end_pin_flag.png') }}";

        var locations = [
            [area1, "{{ $request->pick_lat }}", "{{ $request->pick_lng }}", icon1],
            [area2, "{{ $request->drop_lat == null ? $request->pick_lat : $request->drop_lat }}", "{{ $request->drop_lng == null ? $request->pick_lng : $request->drop_lng }}", icon2],
        ];

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: new google.maps.LatLng(locations[1][1], locations[1][2]),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        // map new
        var infowindow = new google.maps.InfoWindow();
        var marker, i, carIcon;

        var markers = new Array();
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                icon: locations[i][3],
                map: map
            });
            markers.push(marker);
            marker.setMap(map);

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }

        function loadCarInMap(driverLat, driverLng, bearing, carimage) {
            var icon = {
                url: carimage
            };

            icon.rotation += bearing;

            carIcon = new google.maps.Marker({
                title: 'carIcon',
                icon: icon,
                position: new google.maps.LatLng(driverLat, driverLng)
            });

            deleteCarIcon(carIcon);

            markers.push(carIcon);
            carIcon.setMap(map);

            setTimeout(() => {
                rotateMarker(carimage, bearing);
            }, 3000);
        }


        function rotateMarker(carimage, bearing) {
            document.querySelector(`img[src='${carimage}']`).style.transform = 'rotate(' + bearing + 'deg)';
            // document.querySelector("img[src='http://localhost/future/public/map/car.png']").style.transform = 'rotate(80deg)'
        }

        function deleteCarIcon() {
            for (var i = 0; i < markers.length; i++) {
                if (markers[i].hasOwnProperty('title')) {
                    if (markers[i].title == 'carIcon') {
                        markers[i].setMap(null);
                    }
                }
            }
        }
    </script>



</body>


</html>

