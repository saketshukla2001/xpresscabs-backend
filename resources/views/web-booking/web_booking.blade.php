<!doctype html>
<html lang="{{ app()->getLocale() }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{ app_name() ?? 'Tagxi' }}</title>
      <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
      <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css">
      <!-- Add this line to your HTML -->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="shortcut icon" href="{{ fav_icon() ?? asset('assets/img/logo.png')}}">

      <head>
         <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
         <script src="https://maps.googleapis.com/maps/api/js?key={{ get_settings('google_map_key') }}&libraries=places"></script>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">

   </head>
   <body>
      <div class="content-initiate">
         <div class="model-init1" style="display: none;">
            <div class="model-wrapper">
               <div class="model-content" style="display: none;">
                  <div class="model-head">
                     Enter Promo code
                  </div>
                  <div class="model-input">
                     <input type="text" id="model-promo-input">
                     <div class="promo-code-error"></div>
                  </div>
                  <div class="promocode">
                     <div class="promocode-cancel">
                        Cancel
                     </div>
                     <div class="promocode-submit">
                        Submit
                     </div>
                  </div>
               </div>
               <div class="model-content2" style="display: none;">
                  <div class="model-head">
                     Add Date and time
                  </div>
                  <div class="model-input">
                     <input type="date" id="model-promo-input" class="datepicker" name="date" required>
                     <div class="promo-code-error"></div>
                  </div>
                  <br>
                  <div class="model-input">
                     <select id="timepicker" class="select-rt ola-select" name="time" required>
                        <option value="12:00 AM">12:00 AM</option>
                        <option value="12:15 AM">12:15 AM</option>
                        <option value="12:30 AM">12:30 AM</option>
                        <option value="12:45 AM">12:45 AM</option>
                        <option value="1:00 AM">1:00 AM</option>
                        <option value="1:15 AM">1:15 AM</option>
                        <option value="1:30 AM">1:30 AM</option>
                        <option value="1:45 AM">1:45 AM</option>
                        <option value="2:00 AM">2:00 AM</option>
                        <option value="2:15 AM">2:15 AM</option>
                        <option value="2:30 AM">2:30 AM</option>
                        <option value="2:45 AM">2:45 AM</option>
                        <option value="3:00 AM">3:00 AM</option>
                        <option value="3:15 AM">3:15 AM</option>
                        <option value="3:30 AM">3:30 AM</option>
                        <option value="3:45 AM">3:45 AM</option>
                        <option value="4:00 AM">4:00 AM</option>
                        <option value="4:15 AM">4:15 AM</option>
                        <option value="4:30 AM">4:30 AM</option>
                        <option value="4:45 AM">4:45 AM</option>
                        <option value="5:00 AM">5:00 AM</option>
                        <option value="5:15 AM">5:15 AM</option>
                        <option value="5:30 AM">5:30 AM</option>
                        <option value="5:45 AM">5:45 AM</option>
                        <option value="6:00 AM">6:00 AM</option>
                        <option value="6:15 AM">6:15 AM</option>
                        <option value="6:30 AM">6:30 AM</option>
                        <option value="6:45 AM">6:45 AM</option>
                        <option value="7:00 AM">7:00 AM</option>
                        <option value="7:15 AM">7:15 AM</option>
                        <option value="7:30 AM">7:30 AM</option>
                        <option value="7:45 AM">7:45 AM</option>
                        <option value="8:00 AM">8:00 AM</option>
                        <option value="8:15 AM">8:15 AM</option>
                        <option value="8:30 AM">8:30 AM</option>
                        <option value="8:45 AM">8:45 AM</option>
                        <option value="9:00 AM">9:00 AM</option>
                        <option value="9:15 AM">9:15 AM</option>
                        <option value="9:30 AM">9:30 AM</option>
                        <option value="9:45 AM">9:45 AM</option>
                        <option value="10:00 AM">10:00 AM</option>
                        <option value="10:15 AM">10:15 AM</option>
                        <option value="10:30 AM">10:30 AM</option>
                        <option value="10:45 AM">10:45 AM</option>
                        <option value="11:00 AM">11:00 AM</option>
                        <option value="11:15 AM">11:15 AM</option>
                        <option value="11:30 AM">11:30 AM</option>
                        <option value="11:45 AM">11:45 AM</option>
                        <option value="12:00 PM">12:00 PM</option>
                        <option value="1:00 PM">1:00 PM</option>
                        <option value="1:15 PM">1:15 PM</option>
                        <option value="1:30 PM">1:30 PM</option>
                        <option value="1:45 PM">1:45 PM</option>
                        <option value="2:00 PM">2:00 PM</option>
                        <option value="2:15 PM">2:15 PM</option>
                        <option value="2:30 PM">2:30 PM</option>
                        <option value="2:45 PM">2:45 PM</option>
                        <option value="3:00 PM">3:00 PM</option>
                        <option value="3:15 PM">1:15 PM</option>
                        <option value="3:30 PM">1:30 PM</option>
                        <option value="3:45 PM">1:45 PM</option>
                        <option value="4:00 PM">2:00 PM</option>
                        <option value="4:15 PM">1:15 PM</option>
                        <option value="4:30 PM">1:30 PM</option>
                        <option value="4:45 PM">1:45 PM</option>
                        <option value="5:00 PM">2:00 PM</option>
                        <option value="5:15 PM">5:15 PM</option>
                        <option value="5:30 PM">5:30 PM</option>
                        <option value="5:45 PM">5:45 PM</option>
                        <option value="6:00 PM">6:00 PM</option>
                        <option value="6:15 PM">6:15 PM</option>
                        <option value="6:30 PM">6:30 PM</option>
                        <option value="6:45 PM">6:45 PM</option>
                        <option value="7:00 PM">7:00 PM</option>
                        <option value="7:15 PM">7:15 PM</option>
                        <option value="7:30 PM">7:30 PM</option>
                        <option value="7:45 PM">7:45 PM</option>
                        <option value="8:00 PM">8:00 PM</option>
                        <option value="8:15 PM">8:15 PM</option>
                        <option value="8:30 PM">8:30 PM</option>
                        <option value="8:45 PM">8:45 PM</option>
                        <option value="9:00 PM">9:00 PM</option>
                        <option value="9:15 PM">9:15 PM</option>
                        <option value="9:30 PM">9:30 PM</option>
                        <option value="9:45 PM">9:45 PM</option>
                        <option value="10:00 PM">10:00 PM</option>
                        <option value="10:15 PM">10:15 PM</option>
                        <option value="10:30 PM">10:30 PM</option>
                        <option value="10:45 PM">10:45 PM</option>
                        <option value="11:00 PM">11:00 PM</option>
                        <option value="11:15 PM">11:15 PM</option>
                        <option value="11:30 PM">11:30 PM</option>
                        <option value="11:45 PM">11:45 PM</option>
                        <dom-repeat style="display: none;">
                           <template is="dom-repeat"></template>
                        </dom-repeat>
                     </select>
                     <div class="date-error"style=" color: red;display:none"> Please select date</div>
                  </div>
                  <div class="promocode">
                     <div class="promocode-cancel">
                        Cancel
                     </div>
                     <div class="date-submit">
                        Submit
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @if(!Session('user_id'))
         <div class="login-page">
            <div class="otp-number">
               <div class="verify-otps" style="display:none">
                <div><img class="logo" alt="Superbidding Logo" src="{{ web_booking_logo() ?? asset('assets/img/logo.png')}}"></div>
                  <div class="back-to-home"><i class="fa fa-arrow-left"></i></div>
                  <div class="mobile_no">Verify OTP</div>
                  <div class="otp_content">Enter the OTP sent to your mobile <span class="entered-no">9566754418</span></div>
                  <div class="intel-input" style="margin-top: 16px;">
                     <input type="text" id="input-name1"  style="/* height: 100%; */" placeholder="Enter 6-digit OTP">
                     <div class="otp-error-message-verify" style="display:none">Please enter the mobile number</div>
                     <div class="verify-otp">
                        <div class="text opt-text-button-verify">VERIFY OTP</div>
                     </div>
                  </div>
               </div>
               <div class="otp-design" method="post">
                  <form id="Adduser" >
                     @csrf
                     <div><img class="logo" alt="Superbidding Logo" src="{{web_booking_logo() ?? asset('assets/img/logo.png')}}"></div>
                     <div class="mobile_no"> Enter Your Mobile Number</div>
                     <div class="otp_content"> A 6-digit OTP will be sent on SMS</div>
                     <div class="name-opt" style=" text-align: left; margin-top: 15px;opacity: 0.7;">Name (optional)</div>
                     <div class="intel-input" style="margin-top: 8px;">
                        <input type="text" id="input-name" name="name" style="/* height: 100%; */">
                     </div>
                     <div class="name-opt" style="text-align: left; margin-top: 15px; opacity: 0.7;">Enter the mobile number</div>
                     <div class="intel-input">
                        <div class="dropdown" style="margin-right: 177px;">
                            <button class="btn btn dropdown-toggle" type="button" data-toggle="dropdown" style="height: 50px;"aria-expanded="false"></button>
                            <ul class="dropdown-menu country-menu" id="countrySelect">

                            </ul>
                          </div>
                        <div class="flag img_src"><img id="flag" src=""></div>
                        <div class="dial code dial_code" style="margin-left: 10px"></div>

                            <div class="dial_number">
                               <input type="hidden" id="dial_code" name="dial_code" value="">
                               <input type="number" id="input-dial-number" name="mobile">
                            </div>

                     </div>

                     @if($sms_gateway == 'enable_firebase_otp')
                     <div id="recaptcha" class="mt-2"></div>
                     @endif
                     <div class="otp-error-message mt-2" style="display:none">Please enter the mobile number</div>
                     <div class="text opt-text-button mt-2">
                        @if(env('APP_FOR') === 'production')
                            NEXT
                        @else
                            Login
                        @endif
                    </div>
                  </form>
               </div>
            </div>
         </div>
         @endif
         @if(Session('user_id'))
         <header class="navbar">
	<div class="container">
		<div class="navbar-inner">
			<input type="checkbox" id="navbar-checkbox" class="navbar-checkbox"></input>
			<label for="navbar-checkbox" class="navbar-toggle">&#9776</label>
			<nav class="navbar-menu">
				<a href="#" class="navbar-link">home</a>
				<a href="#" class="navbar-link">about</a>
				<a href="#" class="navbar-link">blog</a>
				<a href="#" class="navbar-link">contact</a>
			</nav>
		</div>
	</div>
</header>

         <div class="content-wrapper">
            <div id="head">
                <div class="header-menu">
<div class="top-nav">
<div>
<nav class="mobilescreen">
   <div title="Menu" id="menuToggle">
      <input type="checkbox">
      <span></span>
      <span></span>
      <span></span>
      <ul id="menu">
        <li><a href="{{ url('web-booking-history') }}"><i class="bi bi-layout-text-sidebar-reverse p-2"></i>History</a></li>
         <li><a href="{{ route('logout') }}"><i class="fa fa-power-off p-2"></i>Logout </a></li>
      </ul>
   </div>
</nav>
</div>

                    <a style="margin-left:100px;">
                        <div><img class="logo" alt="Superbidding Logo" src="{{web_booking_logo() ?? asset('assets/img/logo.png')}}"></div>
                    </a>


                    <div class="profile-icon" id="profileIcon">
                        <i class="bi bi-person"></i>
                        <div class="profile-menu" id="profileMenu">
                           <div style="display:block;">
                              <div><img src="{{ asset('assets/img/user-dummy.svg')}}" class="img-fluid" width="50px" alt=""></div>
                              <div class="mt-2"><h6>{{ $userDetails->name}}</h6></div>
                              <div><h6 class="text-muted">{{ $userDetails->mobile }}</h6></div>

                           </div>
                           <div class="log-btn text-center mt-5" style="">
                            <a href="{{ route('logout') }}" class="logout d-flex align-items-center justify-content-center"><i class="fa fa-power-off mx-2"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="content-wrapper" id="cardShowing">

        <div id="cardContainer"></div>

            </div>

         @endif
         <form id="eta_calculaion" method="post">
            @csrf
            <div class="content-wrapper1" style="display: none;">
               <div id="head" class="head1">
                  <div class="header-menu">
                     <div class="right-arrow1 drop-locations"><i class="fa fa-arrow-left"></i></div>
                     <div class="drop_location">Enter drop location</div>
                     <div class="drop_loc_heading input" style=" line-height: 46px;background: #f7f7f7;">
                        <input type="text" class="autocomplete" id="address" placeholder="Enter address..">
                        <input type="hidden" value="" name="drop_lat" id="lat">
                        <input type="hidden" value="" name="drop_lng" id="lng">
                        <input type="hidden" value="" name="drop_address" id="formattedAddress">
                     </div>
                     <div id="map" style="height: 600px;">
                     </div>
                  </div>
               </div>
               <div class="confirm_your_location" style="display:none">
                  <div class="confirm_button2">
                     <input type="hidden" value="" id="confirm_lat">
                     <input type="hidden" value="" id="confirm_lng">
                     <input type="hidden" value="" id="confirm_formattedAddress">
                     Confirm your location
                  </div>
               </div>
            </div>
            <div class="content-wrapper2" style="display: none;">
               <div id="head" class="head1">
                  <div class="header-menu">
                     <div class="right-arrow1 drop-location"><i class="fa fa-arrow-left"></i></div>
                     <div class="drop_location">Enter Pickup location</div>
                     <div class="drop_loc_heading input" style=" line-height: 46px;background: #f7f7f7;">
                        <input type="text" class="autocomplete" id="address1" placeholder="Enter address.." style="width: 100%; max-width: 600px;">

                        <input type="hidden" value="" name="pick_lat" id="lat1">
                        <input type="hidden" value="" name="pick_lng" id="lng1">
                        <input type="hidden" value="" name="pick_address" id="formattedAddress1">
                     </div>
                     <div id="map1" style="height: 600px;"></div>
                  </div>
               </div>
               <div class="confirm_your_location1" style="display:none">
                  <div class="confirm_button_1">
                     <input type="hidden" value="" id="confirm_lat1">
                     <input type="hidden" value="" id="confirm_lng1">
                     <input type="hidden" value="" id="confirm_formattedAddress1">
                     Confirm your location
                  </div>
               </div>
            </div>
         </form>
         <div class="content-wrapper3" style="display: none;">
         </div>
         <div class="content-wrapper4" style="display: none;">
         </div>
         <div class="desktop-bg p2p">
            <div></div>
         </div>
         @if(Session('user_id'))
         <div class="detail-engine-data">
            <div class="detail-engine">
               <div class="nav-list">
                  @if(isset($modules['taxi']))
                  <div class="nav-tab">
                     <a class="item-name daily-ride actv" data-val="taxi">@lang('view_pages.taxi')</a>
                  </div>
                  @endif
                  @if(isset($modules['delivery']))
                  <div class="nav-tab">
                     <a class="item-name out_station @if($app_for == 'delivery') actv @endif" data-val="delivery"> @lang('view_pages.delivery')</a>
                  </div>
                  @endif
                  @if($modules['rental'])
                  <div class="nav-tab">
                     <a class="item-name rental" data-val="rentals">@lang('view_pages.rentals')</a>
                  </div>
                  @endif
               </div>
               <div class="book-details">
                  <div class="from-container" >
                     <div class="from-details" >
                        <div class="from text"> @lang('view_pages.from')</div>
                        <div class="from location text placeholder pickup_address">@lang('view_pages.search_your_pick_up_location')</div>
                     </div>
                  </div>
                  <div class="to-container">
                     <div class="from-details daily_rides">
                        <div class="from text">@lang('view_pages.to')</div>
                        <div class="from location text placeholder search_pickup_location">@lang('view_pages.search_your_drop_location')</div>
                     </div>
                     <!--   <div class="from-details out_station" style="display: none;">
                        <div class="from text">TO</div>
                        <div class="from location text placeholder search_location">Enter a City,hotel or Address</div>
                        </div>  -->
                        @if($app_for !== 'taxi' && $app_for !== 'delivery')
                     <div class="from-details booking_type" style="display: none;">
                        <div class="from text"> @lang('view_pages.type')</div>
                        <div class="from location text placeholder">
                           <select id="rental_type" class="depart-select ola-select">
                              <option value="select" disabled="" selected="">@lang('view_pages.select_a_rental_type')</option>
                              <option value="taxi">@lang('view_pages.taxi')</option>
                              <option value="delivery">@lang('view_pages.delivery')</option>
                              <dom-repeat style="display: none;">
                                 <template is="dom-repeat"></template>
                              </dom-repeat>
                           </select>
                        </div>
                     </div>
                  </div>
                  @endif

                     <div class="from-details rentals" style="display: none;">
                     </div>
               </div>
               <div class="ride title available_ride" style="display:none">
                  <div>@lang('view_pages.available_ride')</div>
               </div>


               <div class="ride title rental_ride" style="display:none">
                  <div>@lang('view_pages.select_vechicle_type')</div>
               </div>
               <div class="vehicle-engine daily_ride_vehicle" style="display:none">
               </div>
               <!--- Package Vechile types start -->
               <div class="vehicle-engine package" style="display:none">
               </div>
               <!-- package vehile type End -->
            </div>
            <div class="book_now" style="display: none;">
               <div class="confirm_button book_now_details">
                @lang('view_pages.book_now')
               </div>
               <br>
               <div class="confirm_button1">
                @lang('view_pages.book_later')
               </div>
            </div>
            <div class="book_now1" style="display: none;">
               <div class="confirm_button book-package" onclick="package_booking()">
                @lang('view_pages.book_now')
               </div>
            </div>
         </div>
         @endif
      </div>
      <!--     <div id="map" style="height: 600px;"></div>
         <div id="marker-position"></div>
         <div id="address"></div> -->
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.10.0/firebase-app.min.js"></script>
      <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.10.0/firebase-auth.min.js"></script>
      <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
         async defer></script>
      <script>
var sms_gateway = "{{$sms_gateway}}";
   
var app_for = '{{$app_for}}';
document.addEventListener('DOMContentLoaded', function() {
        fetch('{{ url("/") }}/api/v1/countries')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const countrySelect = document.getElementById('countrySelect');
                countrySelect.innerHTML = ''; // Clear existing options
                data.data.forEach(country => {
                    const option = document.createElement('li');
                option.classList.add('dropdown-item');
                option.dataset.dialCode = country.dial_code;
                option.dataset.flag = `{{url("/")}}/images/country/flags/${country.code}.png`;
                option.textContent = `${country.name} (${country.code})`;

                // Create flag image element
                const flagImg = document.createElement('img');
                flagImg.src = option.dataset.flag;
                flagImg.alt = country.name + ' Flag';
                option.appendChild(flagImg);

                countrySelect.appendChild(option);
                });

                countrySelect.addEventListener('click', function(event) {
                    const selectedOption = event.target;
                    if (selectedOption.classList.contains('dropdown-item')) {
                        $(".dial_code").html(selectedOption.dataset.dialCode);
                        $("#dial_code").val(selectedOption.dataset.dialCode);
                        $(".img_src").html(`<img id="flag" alt="Country Flag" src="${selectedOption.dataset.flag}">`);
                        //$(".btn.dropdown-toggle").text(selectedOption.textContent); // Update button text
                    }
                });
            })
            .catch(error => console.error('Error fetching countries:', error));
    });



fetch('{{ url("/") }}/api/v1/countries')
    .then(response => response.json())
    .then(data => {
        const countrySelect = document.getElementById('countrySelect');
        data.data.forEach(country => {
            const option = document.createElement('option');
            option.value = country.id;
            option.text = country.name;
            countrySelect.appendChild(option);
            option.dataset.dialCode = country.dial_code;
            option.dataset.flag = country.flag;
        });

        countrySelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption) {
                $(".dial_code").html(selectedOption.dataset.dialCode);
                $("#dial_code").val(selectedOption.dataset.dialCode);
                $(".img_src").html(`<img id="flag" alt="Country Flag" src="${selectedOption.dataset.flag}">`);
            }
        });
    })
    .catch(error => console.error('Error fetching countries:', error));



// fetch('{{ url("/") }}/api/v1/countries')
//     .then(response => response.json())
//     .then(data => {
//         const countrySelect = document.getElementById('countrySelect');


//         const indiaOption = document.createElement('option');
//         indiaOption.value = 'IN';
//         indiaOption.text = 'India';
//         indiaOption.selected = true;
//         countrySelect.appendChild(indiaOption);


//         data.data.forEach(country => {
//             if (country.code !== 'IN') {
//                 const option = document.createElement('option');
//                 option.value = country.id;
//                 option.text = country.name;
//                 option.dataset.dialCode = country.dial_code;
//                 option.dataset.flag = country.flag;
//                 countrySelect.appendChild(option);
//             }
//         });

//         countrySelect.addEventListener('change', function() {
//             const selectedOption = this.options[this.selectedIndex];
//             if (selectedOption) {
//                 $(".dial_code").html(selectedOption.dataset.dialCode);
//                 $("#dial_code").val(selectedOption.dataset.dialCode);
//                 $(".img_src").html(`<img id="flag" alt="Country Flag" src="${selectedOption.dataset.flag}">`);
//             }
//         });
//     })
//     .catch(error => console.error('Error fetching countries:', error));






         var latitude;
                            var longitude;
                            let map;
                            let marker,marker1;
                            var widgetid;
                            var otp_btn_active = false;
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
         var cancel_button_showing = false;
         firebase.initializeApp(firebaseConfig);
         var database = firebase.database();
         function Listenrequestdata(request_id){
            var dataref = database.ref('requests/'+request_id);
             dataref.on('value', (snapshot) => {
            const data = snapshot.val();
            if (data.hasOwnProperty("is_accept")) {
               console.log("exists");

               if(data.is_accept == 1)
               {
                  cancel_button_showing = true;
                   setTimeout(function() {
                  window.location.href='{{url("/")}}/track/request/'+data.request_id;
                   }, 1000);
                  // cancel_button_showing = true;
                  // console.log("accepted");
                  // $(".cancel-booking").html('');
                  // $(".owner-accept-data").html('<img src="{{ asset("images/Accept_ride.gif") }}" id="taxi"">');
                  // $(".waiting_fr_driver").html('<div class="booking-accepted">owner accepted your request. please visit <span class="track_request" data-val='+data.request_id+'>here</span> to track the owner.</div>');
                  // alert("test");
               }
            }
            if (data.hasOwnProperty("is_cancel")) {

               if(data.is_cancel == 1)
               {
                  dataref.off('value');
                  $(".owner-accept-data").html('<img src="{{ asset("images/automatic_cancellation.gif") }}" id="taxi"">');
                  $(".waiting_fr_driver").html('<div class="booking-cancelled"> Trip has been cancelled . </div>');
                    setTimeout(function() {
                    window.location.href='{{url("/")}}/web-booking';
                  }, 500);
               }
            }
            if (data.hasOwnProperty("is_completed")) {

            //    if(data.is_completed == 1 || data.is_completed === true)
            //    {
            //       console.log("Completed");
            //       dataref.off('value');
            //       $(".owner-accept-data").html('<img src="{{ asset("images/confirmation.gif") }}" id="taxi"">');
            //       $(".waiting_fr_driver").html('<div class="booking-cancelled">Your booking has been completed.</div>');
            //        setTimeout(function() {
            //          window.location.href='{{url("/")}}/web-booking';
            //       }, 500);


            //    }

               if(data.is_payment == '0')
               {
                  // console.log("Completed");
                  dataref.off('value');
                //   $(".owner-accept-data").html('<img src="{{ asset("images/confirmation.gif") }}" id="taxi"">');
                //   $(".waiting_fr_driver").html('<div class="booking-cancelled">Your booking has been completed.</div>');
                //    setTimeout(function() {
                //      window.location.href='{{url("/")}}/web-booking';
                //   }, 500);

               }




            }
            });
         }

         // Example: Rendering reCAPTCHA widget
         var verifyCallback = function(response) {
            if($("#input-dial-number").val() != "" && $("#input-dial-number").val() !== undefined)
            {
                $(".opt-text-button").addClass("actv");
            }

         };

         var onloadCallback = function() {
         @if(!Session('user_id') && $sms_gateway == 'enable_firebase_otp')
         window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha', {
            'size': 'normal',
            'callback': verifyCallback
         });
         recaptchaVerifier.render().then((widgetId) => {
         window.recaptchaWidgetId = widgetId;
         // console.log("widgetId");
         // console.log(window.recaptchaWidgetId);
         });
         @endif

         };
         function rentalsFetch() {
            var form_data = new FormData($("#eta_calculaion")[0]);
            var transport_type = $("#rental_type").val();
             if(app_for !== 'taxi' && app_for !== 'delivery'){
               form_data.append("transport_type",transport_type);
            }
            $.ajax({
                url:'adhoc-list-packages',
                method:'post',
                data:form_data,
                dataType:'json',
                processData:false,
                contentType:false,
                success:function(response){
                    if(response.success)
                    {
                        var html_data = '<div class="from text">Package</div><div class="from location text placeholder select_package"><select id="packagePicker" class="depart-select ola-select"> <option value="select" disabled="" selected="">Select a package</option>';
                        if(response.data.length > 0)
                        {
                        var html_content1 = "";

                        for(var i=0;i < response.data.length;i++)
                        {
                           if(response.data[i].typesWithPrice !== null){
                               html_data+='<option value="'+response.data[i].id+'">'+response.data[i].package_name+'</option>';
                               html_content1 += '<div class="available-vehicle-details package-list package_'+response.data[i].id+'" data-val="'+response.data[i].typesWithPrice.data[0].zone_type_id+'" data-id="'+response.data[i].id+'" data-amount="'+parseFloat(response.data[i].typesWithPrice.data[0].fare_amount.toFixed(2))+'" style="display:none"><div class="vehicle-info"> <div class="vehicle-image"><img src="'+response.data[i].typesWithPrice.data[0].icon+'"></div></div><div class="vehicle-info-details"> <div class="vehicle-names">'+response.data[i].typesWithPrice.data[0].name+'</div><div class="vehicle-content">Get an auto at your doorstep</div></div><div class="right-arrow"><span class="price">'+response.data[i].typesWithPrice.data[0].currency+''+parseFloat(response.data[i].typesWithPrice.data[0].fare_amount.toFixed(2))+'</span> </div>  </div><div class="horizontal-line"></div>';
                               // <div class="time-arrival">2 min</div>
                           }
                        }
                        $(".vehicle-engine.package").html(html_content1);
                        }
                        html_data+='<template is="dom-repeat"></template> </select> </div>';
                        $(".rentals").show();
                        $(".rentals").html(html_data);

                    }
                },
                error: function(xhr, status, error) {
                // Handle errors
                console.error('Error:', xhr.responseText);
                }
            })
         }
         $(document).ready(function(){
            $('.desktop-bg.p2p').css('background-image', 'url("{{ web_booking_taxi() ?? asset("images/TAXI.png") }}")');

         })
            $(document).on("click",".track_request",function(){
               var data_val = $(this).attr("data-val");
               window.open('{{url("/")}}/track/request/'+data_val, '_blank');
               // window.location.href='{{url("/")}}/track/request/'+data_val;
            })
             $(document).on("click",".home-screen",function(){
               window.location.href='{{url("/")}}/web-booking';
            })

            $(document).on("input","#input-dial-number",function(){
               @if($sms_gateway == "enable_firebase_otp")
               var response = grecaptcha.getResponse(widgetid);
                 if(response != "")
                 {
                     $(".opt-text-button").addClass("actv");
                 }
               @else
               if($(this).val().length >= 7){
                  $(".opt-text-button").addClass("actv");
               }else{
                  $(".opt-text-button").removeClass("actv");
               }
               @endif
            })

              $('.item-name').hover(
                  function() {
                     $(this).closest(".nav-tab").find(".tool-tips").show();
                  },
                  function() {
                      $(this).closest(".nav-tab").find(".tool-tips").hide();
                  }
            );
               $('.fa-info-circle').hover(
                  function() {
                     $(this).closest(".pick_ups_location").find(".tool-tips1").show();
                  },
                  function() {
                      $(this).closest(".pick_ups_location").find(".tool-tips1").hide();
                  }
            );
              $(document).on("click",".daily-ride",function(){

                $(".bar").addClass("actv");
                 setTimeout(function() {
                    // $(".available_ride").show();
                    $(".rental_ride").hide();
                    $(".available-vehicle-details").removeClass('actv');
                    $(".package").hide();
                    $(".bar").removeClass("actv");
                    $(".book_now").removeClass("actv");
                    $(".book_now").hide();
                    $(".book_now1").hide();
                    $(".add-details").hide();


                    $("#packagePicker option[value='select']").prop("selected", true);
                    $('.desktop-bg.p2p').css('background-image', 'url("{{ web_booking_taxi() ?? asset("images/TAXI.png") }}")');

                     $(".from-details.out_station").hide();
                    $(".from-details.booking_type").hide();
                    $(".from-details.daily_rides").show();
                    $(".from-details.rentals").hide();
                  }, 200);
              })
                $(document).on("click",".out_station",function(){
                    if($("#lat").val() != "" && $("#lat1").val() != "")
                    {
                        $(".available_ride").show();
                        $(".promo_coupon").show();
                        $(".daily_ride_vehicle").show();
                        $(".add-details").show();
                    }

                $(".bar").addClass("actv");
                 setTimeout(function() {

                    // $(".available_ride").show();
                    $(".rental_ride").hide();
                    $(".available-vehicle-details").removeClass('actv');
                    // $(".daily_ride_vehicle").show();
                    $(".package").hide();
                    $(".bar").removeClass("actv");
                    $(".book_now").removeClass("actv");
                    $(".book_now").hide();
                    $(".book_now1").hide();
                    $("#packagePicker option[value='select']").prop("selected", true);
                    $('.desktop-bg.p2p').css('background-image', 'url("{{ web_booking_delivery() ?? asset("images/DELIVERY.png") }}")');
                    $(".from-details.out_station").hide();
                    $(".from-details.booking_type").hide();
                    $(".from-details.daily_rides").show();
                    $(".from-details.rentals").hide();

                  }, 200);
              })
                    $(document).on("click",".rental",function(){
                        $(".bar").addClass("actv");
                        $(".add-details").hide();
                         setTimeout(function() {
                              $(".available_ride").hide();
                              $(".promo_coupon").hide();

                              $(".daily_ride_vehicle").hide();
                              $(".book_now1").hide();
                        $(".bar").removeClass("actv");
                        $(".available-vehicle-details").removeClass('actv');
                        $('.desktop-bg.p2p').css('background-image', 'url({{asset("images/RENTAL.png")  }})');
                        $(".from-details.out_station").hide();
                        $(".from-details.daily_rides").hide();
                        $(".from-details.booking_type").show();
                  }, 200);

              })

                     $(document).on("change","#rental_type",function(){
                        rentalsFetch();
                    });

                    $(document).on("change","#packagePicker",function(){
                        var data_value = $(this).val();
                        $(".rental_ride").show();
                        $(".package").show();
                        $(".book_now1").hide();
                        $(".available-vehicle-details.package-list").hide();
                        $(".package_"+data_value+"").show();
                    });
                    $(document).on("click",".search_pickup_location",function(){
                        $(".content-wrapper").hide();
                        $(".detail-engine-data").hide();
                        $(".content-wrapper1").show();
                        $(".content-wrapper2").hide();
                        $(".content-wrapper3").hide();
                    });

                      $(document).on("click",".date-submit",function(){
                        if($(".datepicker").val() != "" && $(".datepicker").val() !== undefined)
                        {

                        $(".date-error").hide();
                        var transport_type = $(".item-name.actv").attr("data-val");
                        var booking_type = $(".available-vehicle-details.actv").attr("data-val");
                        var formattedAddress = $("#formattedAddress").val();
                        var formattedAddress1 = $("#formattedAddress1").val();
                        var form_data = new FormData($("#eta_calculaion")[0]);
                         form_data.append("vehicle_type",booking_type);
                         form_data.append("country_code",$("#dial_code").val());
                         if(app_for !== 'taxi' && app_for !== 'delivery'){
                           form_data.append("transport_type",transport_type);
                        }
                         form_data.append("html_type","html");
                         form_data.append("pickup_address",formattedAddress1);
                         form_data.append("drop_address",formattedAddress);
                         form_data.append("booking_type",1);
                         form_data.append("lat",$("#lat1").val());
                         form_data.append("lng",$("#lng1").val());
                         form_data.append("user_id",'{{Session("user_id")}}');
                         form_data.append("date",$(".datepicker").val()+' '+$("#timepicker").val());

                         $(".bar").addClass("actv");
                                       $.ajax({
                                                url: 'adhoc-eta',
                                                type: 'POST',
                                                data: form_data,
                                                dataType: 'html',
                                                processData: false,
                                                contentType: false,
                                                success: function(response) {
                                                     $(".content-wrapper3").html('');
                                                      setTimeout(function() {
                                                            $(".content-wrapper").hide();
                                                            $(".detail-engine-data").hide();
                                                            $(".content-wrapper1").hide();
                                                            $(".content-wrapper2").hide();
                                                            $(".content-wrapper3").html(response);
                                                            $(".content-wrapper3").show();
                                                            $(".model-init1").hide();
                                                            $(".bar").removeClass("actv");
                                                         }, 500);
                                                    },
                                                    error: function(xhr, status, error) {
                                                    // Handle errors
                                                    console.error('Error:', xhr.responseText);
                                                    }
                                                });
                        }
                        else{
                            $(".date-error").show();
                        }

                    });
                    $(document).on("click",".book_now_details",function(){
                        var transport_type = $(".item-name.actv").attr("data-val");
                        var booking_type = $(".available-vehicle-details.actv").attr("data-val");
                        var formattedAddress = $("#formattedAddress").val();
                        var formattedAddress1 = $("#formattedAddress1").val();
                         var form_data = new FormData($("#eta_calculaion")[0]);
                         form_data.append("vehicle_type",booking_type);
                         if(app_for !== 'taxi' && app_for !== 'delivery'){
                           form_data.append("transport_type",transport_type);
                        }
                         form_data.append("html_type","html");
                         form_data.append("pickup_address",formattedAddress1);
                         form_data.append("drop_address",formattedAddress);
                         form_data.append("lat",$("#lat1").val());
                         form_data.append("lng",$("#lng1").val());
                         form_data.append("user_id",'{{Session("user_id")}}');

                                       $.ajax({
                                                url: 'adhoc-eta',
                                                type: 'POST',
                                                data: form_data,
                                                dataType: 'html',
                                                processData: false,
                                                contentType: false,
                                                success: function(response) {
                                                    // Handle the successful response
                                                    // console.log('Success:', response);
                                                      setTimeout(function() {
                                                            $(".content-wrapper").hide();
                                                            $(".detail-engine-data").hide();
                                                            $(".content-wrapper1").hide();
                                                            $(".content-wrapper2").hide();
                                                            $(".content-wrapper3").html(response);
                                                            $(".content-wrapper3").show();
                                                         }, 200);
                                                    },
                                                    error: function(xhr, status, error) {
                                                    // Handle errors
                                                    console.error('Error:', xhr.responseText);
                                                    }
                                                });


                    });

                    $(document).on("click",".pickup_address",function(){

                        $(".content-wrapper").hide();
                        $(".detail-engine-data").hide();
                        $(".content-wrapper1").hide();
                        $(".content-wrapper3").hide();
                        $(".content-wrapper2").show();

                    })
                    $(document).on("click",".drop-location",function(){
                        $(".content-wrapper").show();
                        $(".detail-engine-data").show();
                        $(".content-wrapper1").hide();
                        $(".content-wrapper2").hide();

                    });
                     $(document).on("click",".drop-locations",function(){
                        $(".content-wrapper").show();
                        $(".detail-engine-data").show();
                        $(".content-wrapper1").hide();
                        $(".content-wrapper2").hide();

                    });
                      function initAutocomplete() {
                            var autocomplete = new google.maps.places.Autocomplete(
                              document.getElementById("address"),
                            );

                            autocomplete.addListener('place_changed', function() {

                              var place = autocomplete.getPlace();
                              // console.log('Place selected:', place);
                              var formattedAddress = place.formatted_address;
                              var latitude = place.geometry.location.lat();
                              var longitude = place.geometry.location.lng();
                              $("#confirm_lat").val(latitude);
                              $("#confirm_lng").val(longitude);
                              $("#confirm_formattedAddress").val(formattedAddress);
                              $(".confirm_your_location").show();

                               var options = {
                                      center: { lat: latitude, lng: longitude }, // Example: San Francisco, CA
                                      zoom: 18,
                                    };
                                     map = new google.maps.Map(document.getElementById('map'), options);

                                    // Add markers
                                     marker1 = new google.maps.Marker({
                                      position: { lat: latitude, lng: longitude }, //
                                      map: map,
                                      draggable: true,
                                      title: 'Marker 1',
                                      icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                                    });
                                     google.maps.event.addListener(marker1, 'dragend', function() {
                                        var latLng1 = new google.maps.LatLng(marker1.getPosition().lat(), marker1.getPosition().lng());
                                        var code2 = new google.maps.Geocoder();
                                        code2.geocode({ 'location': latLng1 }, function(results, status) {

                                        if (status === 'OK') {
                                             if (results[0]) {
                                                 $("#confirm_lat").val(marker1.getPosition().lat());
                                                 $("#confirm_lng").val(marker1.getPosition().lng());
                                                 $("#confirm_formattedAddress").val(results[0].formatted_address);
                                                 $(".confirm_your_location").show();
                                                 $("#address").val(results[0].formatted_address);

                                             }

                                        }
                                    });
                                    });

                            });
                            }
                             function initAutocomplete1() {
                            var autocomplete = new google.maps.places.Autocomplete(
                              document.getElementById("address1"),

                            );
                            autocomplete.addListener('place_changed', function() {
                              var csrfToken = $('meta[name="csrf-token"]').attr('content');
                              var place = autocomplete.getPlace();
                              var formattedAddress = place.formatted_address;
                              var latitude = place.geometry.location.lat();
                              var longitude = place.geometry.location.lng();
                              $("#confirm_lat1").val(latitude);
                              $("#confirm_lng1").val(longitude);
                              $("#confirm_formattedAddress1").val(formattedAddress);
                              $(".confirm_your_location1").show();
                                    if($('.item-name.actv').attr('data-val') == 'rentals'){
                                        var formData = new FormData();
                                        formData.append('pick_lat', latitude);
                                        formData.append('pick_lng', longitude);
                                       $.ajax({
                                          headers: {
                                               'X-CSRF-TOKEN': csrfToken
                                           },
                                           url:'adhoc-list-packages',
                                           method:'post',
                                           data:formData,
                                           dataType:'json',
                                           processData:false,
                                           contentType:false,
                                           success:function(response){
                                               if(response.success)
                                               {
                                                   var html_data = '<div class="from text">Package</div><div class="from location text placeholder select_package"><select id="packagePicker" class="depart-select ola-select"> <option value="select" disabled="" selected="">Select a package</option>';
                                                   if(response.data.length > 0)
                                                   {
                                                   var html_content1 = "";

                                                   for(var i=0;i < response.data.length;i++)
                                                   {
                                                      if(response.data[i].typesWithPrice !== null){
                                                         html_data+='<option value="'+response.data[i].id+'">'+response.data[i].package_name+'</option>';
                                                         html_content1 += '<div class="available-vehicle-details package-list package_'+response.data[i].id+'" data-val="'+response.data[i].typesWithPrice.data[0].zone_type_id+'" data-id="'+response.data[i].id+'" data-amount="'+parseFloat(response.data[i].typesWithPrice.data[0].fare_amount.toFixed(2))+'" style="display:none"><div class="vehicle-info"> <div class="vehicle-image"><img src="'+response.data[i].typesWithPrice.data[0].icon+'"></div></div><div class="vehicle-info-details"> <div class="vehicle-names">'+response.data[i].typesWithPrice.data[0].name+'</div><div class="vehicle-content">Get an auto at your doorstep</div></div><div class="right-arrow"><span class="price">'+response.data[i].typesWithPrice.data[0].currency+''+parseFloat(response.data[i].typesWithPrice.data[0].fare_amount.toFixed(2))+'</span> </div>  </div><div class="horizontal-line"></div>';
                                                          // <div class="time-arrival">2 min</div>
                                                      }
                                                   }
                                                   $(".vehicle-engine.package").html(html_content1);
                                                   }
                                                   html_data+='<template is="dom-repeat"></template> </select> </div>';
                                                   $(".rentals").show();
                                                   $(".rentals").html(html_data);

                                               }
                                           },
                                           error: function(xhr, status, error) {
                                           // Handle errors
                                           console.error('Error:', xhr.responseText);
                                           }
                                       })
                                    }

                                    });
                                   // Create a map
                              var options = {
                                      center: { lat: latitude, lng: longitude }, // Example: San Francisco, CA
                                      zoom: 18,
                                    };
                                     map = new google.maps.Map(document.getElementById('map1'), options);

                                    // Add markers
                                     marker1 = new google.maps.Marker({
                                      position: { lat: latitude, lng: longitude }, //
                                      map: map,
                                      draggable: true,
                                      title: 'Marker 1',
                                      icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                                    });
                                     google.maps.event.addListener(marker1, 'dragend', function() {
                                        var latLng1 = new google.maps.LatLng(marker1.getPosition().lat(), marker1.getPosition().lng());
                                        var code1 = new google.maps.Geocoder()
                                        code1.geocode({ 'location': latLng1 }, function(results, status) {
                                        if (status === 'OK') {
                                             if (results[0]) {
                                                 $("#confirm_lat1").val(marker1.getPosition().lat());
                                                 $("#confirm_lng1").val(marker1.getPosition().lng());
                                                 $("#confirm_formattedAddress1").val(results[0].formatted_address);
                                                 $(".confirm_your_location1").show();
                                                 $("#address1").val(results[0].formatted_address);

                                             }

                                        }
                                    });
                            });
                            }
                            $(document).on("focus","#address",function(){
                                if($(this).val() != "" && $(this).val() != null)
                                {
                                    initAutocomplete("address");
                                }
                            })
                            $(document).on("focus","#address1",function(){
                                if($(this).val() != "" && $(this).val() != null)
                                {
                                    initAutocomplete1();
                                }
                            })
         function default_image(){
            var countryCode ='IN';
             $.ajax({
                                    url: 'get-country-data?countryCode='+countryCode+'',
                                    method: 'GET',
                                    dataType: 'json',
                                    // data:data,
                                    success: function(response) {
                                     // console.log(response);
                                     if(response.status == "success")
                                     {
                                        // $("#flag").attr("src", response.flag.flag);
                                        $(".dial_code").html(response.flag.dial_code);
                                        $("#dial_code").val(response.flag.dial_code);
                                         $(".img_src").html('<img id="flag" alt="Superbidding Logo" src="'+response.flag.flag+'">');

                                     }
                                     else{
                                         $("#flag").attr("src", 'url({{asset("images/country/flags/IN.png")  }})');
                                     }

                                    },
                                    error: function(error) {
                                    // Handle errors
                                    console.log('Error:', error);
                                    }
                            });
         }
                            var status = true;
         function getCurrentLocation() {
         var locationInfo = document.getElementById('location-info');

         // Check if geolocation is supported
         if (navigator.geolocation) {

         // Get current position
         navigator.geolocation.getCurrentPosition(
          function(position) {
            var geocoder = new google.maps.Geocoder();
            // Get latitude and longitude
             latitude = position.coords.latitude;
             longitude = position.coords.longitude;

            // Display location information
            // locationInfo.innerHTML = 'Latitude: ' + latitude + '<br>Longitude: ' + longitude;

            // Optionally, you can use the Google Maps Geocoder API to get a formatted address
            var latLng = new google.maps.LatLng(latitude, longitude);
            geocoder.geocode({ 'location': latLng }, function(results, status) {
              if (status === 'OK') {
                if (results[0]) {
                    if(status)
                    {
                         countryCode = results[0].address_components.find(component => component.types.includes('country')).short_name;
                          $.ajax({
                                    url: 'get-country-data?countryCode='+countryCode+'',
                                    method: 'GET',
                                    dataType: 'json',
                                    // data:data,
                                    success: function(response) {
                                     // console.log(response);
                                     if(response.status == "success")
                                     {
                                        // $("#flag").attr("src", response.flag.flag);
                                        $(".dial_code").html(response.flag.dial_code);
                                        $("#dial_code").val(response.flag.dial_code);
                                         $(".img_src").html('<img id="flag" alt="Superbidding Logo" src="'+response.flag.flag+'">');
                                     }
                                     else{
                                        $("#flag").attr("src", 'url({{asset("images/country/flags/IN.png")  }})');
                                     }

                                    },
                                    error: function(error) {
                                    // Handle errors
                                    console.log('Error:', error);
                                    }
                            });
                          status = false;
                    }
                              $("#lat1").val(latitude);
                              $("#lng1").val(longitude);
                              $("#formattedAddress1").val(results[0].formatted_address);
                              $(".pickup_address").html(results[0].formatted_address);
                              $(".pickup_address").addClass("actv");
                                var mapOptions = {
                                      center: { lat: latitude, lng: longitude }, // Example: San Francisco, CA
                                      zoom: 18,
                                    };

                                    // Create a map
                                     map = new google.maps.Map(document.getElementById('map1'), mapOptions);

                                    // Add markers
                                     marker1 = new google.maps.Marker({
                                      position: { lat: latitude, lng: longitude }, //
                                      map: map,
                                      draggable: true,
                                      title: 'Marker 1',
                                      icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                                    });
                                     google.maps.event.addListener(marker1, 'dragend', function() {
                                        var latLng1 = new google.maps.LatLng(marker1.getPosition().lat(), marker1.getPosition().lng());
                                        geocoder.geocode({ 'location': latLng1 }, function(results, status) {
                                        if (status === 'OK') {
                                             if (results[0]) {
                                                // alert("dfdff");
                                                // var countryCode = results[0].address_components.find(component => component.types.includes('country')).short_name;
                                                // alert(countryCode);
                                                 $("#confirm_lat1").val(marker1.getPosition().lat());
                                                 $("#confirm_lng1").val(marker1.getPosition().lng());
                                                 $("#confirm_formattedAddress1").val(results[0].formatted_address);
                                                 $(".confirm_your_location1").show();
                                                 $("#address1").val(results[0].formatted_address);
                                             }

                                        }
                                    });
                                    });

                } else {
                  default_image();
                }
              } else {
                console.log('Geocoder failed due to: ' + status);
                default_image();
              }
            });
          },
          function(error) {
            console.log('Error getting location:', error.message);
            default_image();
          }
         );
         } else {
         locationInfo.innerHTML = 'Geolocation is not supported by this browser.';
         default_image();
         }
         }
         function updateMarkerPosition(latLng) {
         // Update the marker position on the UI
         document.getElementById('marker-position').innerHTML = `Marker Position: ${latLng.lat()}, ${latLng.lng()}`;
         }

         function updateAddress(latLng) {
         // Use the Geocoder to get the address based on the marker's position
         let geocoder = new google.maps.Geocoder();
         geocoder.geocode({'location': latLng}, function(results, status) {
         if (status === 'OK') {
            if (results[0]) {
                // Update the address on the UI
                document.getElementById('address').innerHTML = `Address: ${results[0].formatted_address}`;
            } else {
                console.error('No results found');
            }
         } else {
            console.error(`Geocoder failed due to: ${status}`);
         }
         });
         }

         function initMap() {
            getCurrentLocation();
         }
         $(document).on("click",".confirm_your_location",function(){
         $("#lat").val($("#confirm_lat").val());
         $("#lng").val($("#confirm_lng").val());
         $("#formattedAddress").val($("#confirm_formattedAddress").val());
         $(".bar").addClass("actv");


                                 if($("#lat").val() != "")
                                 {
                                    var form_data = new FormData($("#eta_calculaion")[0]);
                                    if(app_for !== 'taxi' && app_for !== 'delivery'){
                                    form_data.append("transport_type",$(".item-name.actv").attr("data-val"));
                                    }
                                       $.ajax({
                                                url: 'adhoc-eta',
                                                type: 'POST',
                                                data: form_data,
                                                dataType: 'json',
                                                processData: false,
                                                contentType: false,
                                                success: function(response) {
                                                    // Handle the successful response
                                                    // console.log('Success:', response);
                                                   if(response.success)
                                                    {
                                                        var html_content = "";
                                                    for(var i=0;i<response.data.length;i++)
                                                    {
                                                        var distance = response.data[i].distance;
                                                        var base_distance = response.data[i].base_distance;
                                                        var base_price = parseFloat(response.data[i].base_price) + parseFloat(response.data[i].distance_price);
                                                        html_content += '<div class="available-vehicle-details" data-val="'+response.data[i].zone_type_id+'"><div class="vehicle-info"> <div class="vehicle-image"><img src="'+response.data[i].icon+'"></div></div><div class="vehicle-info-details"> <div class="vehicle-names">'+response.data[i].type_name+'</div><div class="vehicle-content">'+response.data[i].short_description+'</div></div><div class="right-arrow"><span class="price">'+response.data[i].currency+''+parseFloat(response.data[i].total.toFixed(2))+'</span> </div>  </div><div class="horizontal-line"></div>';
                                                        // <div class="time-arrival">2 min</div>
                                                    }
                                                    $(".daily_ride_vehicle").html(html_content)
                                                      setTimeout(function() {
                                                        $(".search_pickup_location").html($("#confirm_formattedAddress").val());
                                                       $(".content-wrapper").show();
                                                        $(".detail-engine-data").show();
                                                        $(".content-wrapper1").hide();
                                                        $(".content-wrapper2").hide();
                                                        $(".content-wrapper3").hide();
                                                        $(".bar").removeClass("actv");
                                                         }, 200);
                                                         $(".search_pickup_location").addClass("actv");
                                                         $(".available_ride").show();
                                                         $(".promo_coupon").show();
                                                         $(".daily_ride_vehicle").show();
                                                      $(".pickup_address").addClass("actv");
                                                    }
                                                    },
                                                    error: function(xhr, status, error) {
                                                    // Handle errors
                                                    console.error('Error:', xhr.responseText);
                                                    }
                                                });


                                 }
                                 else{
                                      setTimeout(function() {
                                                        $(".search_pickup_location").html($("#confirm_formattedAddress").val());
                                                       $(".content-wrapper").show();
                                                        $(".detail-engine-data").show();
                                                        $(".content-wrapper1").hide();
                                                        $(".content-wrapper2").hide();
                                                        $(".content-wrapper3").hide();
                                                        $(".bar").removeClass("actv");
                                                         }, 200);
                                                         $(".search_pickup_location").addClass("actv");
                                    $(".available_ride").hide();
                                     $(".promo_coupon").hide();
                                    $(".daily_ride_vehicle").hide();
                                 }

         })
         $(document).on("click",".confirm_your_location1",function(){

         $("#lat1").val($("#confirm_lat1").val());
         $("#lng1").val($("#confirm_lng1").val());
         $("#formattedAddress1").val($("#confirm_formattedAddress1").val());
                        $(".bar").addClass("actv");


                           if($("#lat").val() != "")
                                 {

                                    var form_data = new FormData($("#eta_calculaion")[0]);
                                    if(app_for !== 'taxi' && app_for !== 'delivery'){
                                    form_data.append("transport_type",$(".item-name.actv").attr("data-val"));
                                    }
                                       $.ajax({
                                                url: 'adhoc-eta',
                                                type: 'POST',
                                                data: form_data,
                                                dataType: 'json',
                                                processData: false,
                                                contentType: false,
                                                success: function(response) {
                                                    // Handle the successful response
                                                    // console.log('Success:', response);
                                                   if(response.success)
                                                    {
                                                        var html_content = "";
                                                    for(var i=0;i<response.data.length;i++)
                                                    {
                                                        var distance = response.data[i].distance;
                                                        var base_distance = response.data[i].base_distance;
                                                        var base_price = parseFloat(response.data[i].base_price) + parseFloat(response.data[i].distance_price);
                                                        html_content += '<div class="available-vehicle-details" data-val="'+response.data[i].zone_type_id+'"><div class="vehicle-info"> <div class="vehicle-image"><img src="'+response.data[i].icon+'"></div></div><div class="vehicle-info-details"> <div class="vehicle-names">'+response.data[i].type_name+'</div><div class="vehicle-content">'+response.data[i].short_description+'</div></div><div class="right-arrow"><span class="price">'+response.data[i].currency+''+response.data[i].total.toFixed(2)+'</span> </div>  </div><div class="horizontal-line"></div>';
                                                        // <div class="time-arrival">2 min</div>
                                                    }
                                                    $(".daily_ride_vehicle").html(html_content)
                                                      setTimeout(function() {
                                                        $(".pickup_address").html($("#confirm_formattedAddress1").val());
                                                        $(".pickup_address").addClass("actv");
                                                        $(".content-wrapper").show();
                                                        $(".detail-engine-data").show();
                                                        $(".content-wrapper1").hide();
                                                        $(".content-wrapper2").hide();
                                                        $(".content-wrapper3").hide();
                                                        $(".bar").removeClass("actv");
                                                         }, 200);
                                                         $(".search_pickup_location").addClass("actv");
                                                         $(".pickup_address").addClass("actv");
                                                         if($(".item-name.actv").attr("data-val") == "rentals")
                                                         {
                                                            $(".available_ride").hide();
                                                            $(".promo_coupon").hide();
                                                            $(".daily_ride_vehicle").hide();
                                                         }
                                                         else{
                                                            $(".available_ride").show();
                                                         $(".promo_coupon").show();
                                                         $(".daily_ride_vehicle").show();
                                                     }

                                                    }
                                                    },
                                                    error: function(xhr, status, error) {
                                                    // Handle errors
                                                    console.error('Error:', xhr.responseText);
                                                    }
                                                });

                                 }
                                 else{
                                      setTimeout(function() {
                                                        $(".pickup_address").html($("#confirm_formattedAddress1").val());
                                                        $(".pickup_address").addClass("actv");
                                                            $(".content-wrapper").show();
                                                            $(".detail-engine-data").show();
                                                            $(".content-wrapper1").hide();
                                                            $(".content-wrapper2").hide();
                                                            $(".bar").removeClass("actv");
                                        }, 200);
                                    $(".available_ride").hide();
                                    $(".promo_coupon").hide();
                                    $(".daily_ride_vehicle").hide();
                                 }
         })


         var appFor = "{{ env('APP_FOR') }}";
         $(document).on("click",".opt-text-button",function(){

            if (appFor === 'demo') {
        $(".otp-error-message-verify").hide();
        $(this).removeClass("actv");

        var this_dt = $(this);
        if ($("#input-dial-number").val() != "" && $("#input-dial-number").val() !== undefined) {
            var code = $("#input-dial-number").val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var form_data = new FormData($("#Adduser")[0]);

            if(sms_gateway == "enable_firebase_otp"){
               grecaptcha.reset(window.recaptchaWidgetId);
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                url: 'Adduser',
                type: 'POST',
                data: form_data,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (response) {
                    // Handle the successful response
                    if (response.status == "success") {
                        const phoneNumber = $("#dial_code").val() + "" + $("#input-dial-number").val() + "";
                        const name = $("#input-name").val();
                        $("#model-promo-input-name").val(name);
                        $("#model-promo-input-number").val(phoneNumber);
                        window.location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    // Handle errors
                    console.error('Error:', xhr.responseText);
                }
            });
        } else {
            $(".otp-error-message-verify").html('Please Enter the OTP');
            $(".otp-error-message-verify").show();
        }
    }

          else{
         $(".opt-text-button").removeClass("actv");
         // grecaptcha.reset(widgetid);
         if($("#input-dial-number").val() != "" && $("#input-dial-number").val() !== undefined ) {
         $(".otp-error-message").hide();
         const phoneNumber = $("#dial_code").val()+""+$("#input-dial-number").val()+"";
         const name = $("#input-name").val();
         var this_data = $(this);
         if(sms_gateway == "enable_firebase_otp"){
            var response = grecaptcha.getResponse(window.recaptchaWidgetId);
            const appVerifier = window.recaptchaVerifier;
            if(response !=""){
            firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
            .then((confirmationResult) => {
             // SMS sent. Prompt user to type the code from the message, then sign the
             // user in with confirmationResult.confirm(code).
             window.confirmationResult = confirmationResult;
            // console.log(confirmationResult);
              this_data.addClass("actv");
               $(".otp-design").hide();
               $(".verify-otps").show();
               $(".bar").removeClass("actv");
               this_data.removeClass("actv");
               $(".entered-no").html($("#input-dial-number").val());
               $(".otp-error-message-verify").html('');
               $(".otp-error-message-verify").hide();
               $(".opt-text-button-verify").removeClass("actv");
               $("#input-name1").val('');
            // ...
            }).catch((error) => {
                $(".otp-error-message").html('OTP Not sent . Please check the Number');
                $(".otp-error-message").show();
                $(".bar").removeClass("actv");
            });
            }
         }else{
            var mobile = $("#input-dial-number").val();
            var dial_code = $("#dial_code").val();
            if(mobile.length <= 7){
                $(".otp-error-message").html('OTP Not sent . The Number must be at least 7 digits');
                $(".otp-error-message").show();
                $(".bar").removeClass("actv");
               return false;
            }else{
                $(".otp-error-message").html('');
                $(".otp-error-message").hide();
                $(".bar").removeClass("actv");
            }
            var otpData = {
               'mobile' : mobile,
               'country_code': dial_code,
            };
            fetch('{{url("/")}}/api/v1/mobile-otp', {
                method: 'POST', // *GET, POST, PUT, DELETE, etc.
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(otpData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data=>{
               if(data.success == true){
                 this_data.addClass("actv");
                  $(".otp-design").hide();
                  $(".verify-otps").show();
                  $(".bar").removeClass("actv");
                  this_data.removeClass("actv");
                  $(".entered-no").html($("#input-dial-number").val());
                  $(".otp-error-message-verify").html('');
                  $(".otp-error-message-verify").hide();
                  $(".opt-text-button-verify").removeClass("actv");
                  $("#input-name1").val('');
               }
            })
            .catch((error) => {
               $(".otp-error-message").html('OTP Not sent . Please check the Number');
               $(".otp-error-message").show();
               $(".bar").removeClass("actv");
            });
         }
        }
         }
        //  else{
        //       $(".otp-error-message").show();
        //       $(".otp-error-message").html('Please Enter the mobile number');
        //  }

         });
         $(document).on("click",".back-to-home",function(){
         $("#input-dial-number").val('');
         $("#input-name").val('');
         @if($sms_gateway == "enable_firebase_otp")
         grecaptcha.reset(window.recaptchaWidgetId);
         @endif
         $(".verify-otps").hide();
         $(".otp-design").show();
         $(".content-wrapper").hide();
         $(".detail-engine-data").hide();
         $(".opt-text-button").removeClass("actv");
         $(".otp-error-message").hide();
         $(".otp-error-message").html('');
         });
         function addUser(){
            var form_data = new FormData($("#Adduser")[0]);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
               headers: {
                  'X-CSRF-TOKEN': csrfToken
               },
               url: 'Adduser',
               type: 'POST',
               data: form_data,
               dataType: 'json',
               processData: false,
               contentType: false,
               success: function(response) {
                  if(response.status == "success")
                  {
                     const phoneNumber = $("#dial_code").val()+""+$("#input-dial-number").val()+"";
                     const name = $("#input-name").val();
                     $("#model-promo-input-name").val(name);
                     $("#model-promo-input-number").val(phoneNumber);
                     window.location.reload();
                  }
               },
               error: function(xhr, status, error) {
                  console.error('Error:', xhr.responseText);
               }
            });
         }
         $(document).on("click",".opt-text-button-verify",function(){
            $(".otp-error-message-verify").html('');
            $(".otp-error-message-verify").hide();
            $(this).removeClass("actv");
            $(".bar").addClass("actv");
            var this_dt = $(this);
            if($("#input-name1").val() != "" && $("#input-name1").val() !== undefined){
               var code = $("#input-name1").val();
               if(sms_gateway == "enable_firebase_otp"){
                  confirmationResult.confirm(code).then((result) => {
                      grecaptcha.reset(window.recaptchaWidgetId);
                      addUser();
                  }).catch((error) => {
                      console.log("bad verification codesss");
                      $(".otp-error-message-verify").html('OTP is Invalid');
                      $(".otp-error-message-verify").show();
                      $(".opt-text-button-verify").addClass("actv");
                      $(".bar").removeClass("actv");
                  });
               }else{
                  var mobile = $("#input-dial-number").val();
                  var otp = $("#input-name1").val();
                  var otpData = {
                     'mobile' : mobile,
                     'otp' : otp,
                  };
                  fetch('{{url("/")}}/api/v1/validate-otp', {
                      method: 'POST', // *GET, POST, PUT, DELETE, etc.
                      cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                      headers: {
                          'Content-Type': 'application/json'
                      },
                      body: JSON.stringify(otpData)
                  })
                  .then(response => {
                      if (!response.ok) {
                          throw new Error('Network response was not ok');
                      }
                      return response.json();
                  })
                  .then(data => {
                     if(data.success == true){
                        addUser();
                     }else{
                        console.log("bad verification codesss");
                        $(".otp-error-message-verify").html('OTP is Invalid');
                        $(".otp-error-message-verify").show();
                        $(".opt-text-button-verify").addClass("actv");
                        $(".bar").removeClass("actv");
                     }
                  });
               }
            }else{
               $(".otp-error-message-verify").html('Please Enter the OTP');
               $(".otp-error-message-verify").show();
            }
         })
         $(document).on("input","#input-name1",function(){
         if($(this).val() != ""){
             $(".opt-text-button-verify").addClass("actv");
         }

            })

         $(document).on("click",".available-vehicle-details",function(){
         $(".available-vehicle-details").removeClass("actv");
         $(this).addClass("actv");
         if($(this).hasClass("package-list"))
         {
            $(".book_now1").addClass("actv");
            $(".book_now1").show();
         }
         else{
            $(".book_now").addClass("actv");
            $(".book_now").show();
         }



         })

         $(document).on("click",".promocode-cancel",function(){
         $(".model-init1").hide();
         $(".model-init").hide();

         })
         $(document).on("click",".receiver-add",function(){
         $(".model-init1").hide();
         $(".model-init").hide();

         })


         $(document).on("click",".promocode-submit",function(){
         if($("#model-promo-input") != "")
         {
             var form_data = new FormData($("#eta_calculaion")[0]);
            form_data.append("promo_code",$("#model-promo-input").val());
            if(app_for !== 'taxi' && app_for !== 'delivery'){
            form_data.append("transport_type",$(".item-name.actv").attr("data-val"));
            }

         $.ajax({
                                                url: 'adhoc-eta',
                                                type: 'POST',
                                                data: form_data,
                                                dataType: 'json',
                                                processData: false,
                                                contentType: false,
                                                success: function(response) {

                                                    // Handle the successful response
                                                    // console.log('Success:', response);
                                                   if(response.success)
                                                    {
                                                        $(".model-init1").hide();
                                                        $(".model-init").hide();
                                                        var html_content = "";
                                                    for(var i=0;i<response.data.length;i++)
                                                    {
                                                        var distance = response.data[i].distance;
                                                        var base_distance = response.data[i].base_distance;
                                                        html_content += '<div class="available-vehicle-details" data-val="'+response.data[i].zone_type_id+'"><div class="vehicle-info"> <div class="vehicle-image"><img src="'+response.data[i].icon+'"></div></div><div class="vehicle-info-details"> <div class="vehicle-names">'+response.data[i].type_name+'</div><div class="vehicle-content">Get an auto at your doorstep</div></div><div class="right-arrow"><span class="price">'+response.data[i].currency+''+parseFloat(response.data[i].total.toFixed(2))+'</span> </div>  </div><div class="horizontal-line"></div>';
                                                        // <div class="time-arrival">2 min</div>
                                                    }
                                                    $(".daily_ride_vehicle").html(html_content)
                                                    // console.log(response);
                                                      setTimeout(function() {
                                                        $(".search_pickup_location").html($("#confirm_formattedAddress").val());
                                                       $(".content-wrapper").show();
                                                        $(".detail-engine-data").show();
                                                        $(".content-wrapper1").hide();
                                                        $(".content-wrapper2").hide();
                                                        $(".content-wrapper3").hide();
                                                        $(".bar").removeClass("actv");
                                                         }, 200);
                                                         $(".search_pickup_location").addClass("actv");
                                                         $(".available_ride").show();
                                                         $(".promo_coupon").show();
                                                         $(".daily_ride_vehicle").show();
                                                      $(".pickup_address").addClass("actv");
                                                    }
                                                    },
                                                    error: function(xhr, status, error) {
                                                    // Handle errors
                                                    console.error('Status Code:', xhr.status);
                                                    var response =JSON.parse(xhr.responseText);
                                                    console.error('Error:', JSON.parse(xhr.responseText));
                                                    if(xhr.status == 500)
                                                    {
                                                        $(".promo-code-error").html(response.message);
                                                    }
                                                    }
                                                });
         }
         else{
         $(".promo-code-error").html('Please enthe the promo code');
         }


         })
         $(document).on("click",".promo_coupon",function(){
         $(".model-init1").show();
         $(".model-content").show();
         $(".model-content1").hide();
         })
         $(document).on("click",".receiver-dt",function(){
          $(".model-init").show();
          $(".model-content1").show();
          $(".model-content").hide();
         })
         $(document).on("click",".confirm_button1",function(){
                      $(".model-init").hide();
                      $(".model-init1").show();
                      $(".model-content1").hide();
                      $(".model-content").hide();
                      $(".model-content2").show();

                    });
         $(document).on("click",".date-edit",function(){
                      $(".model-init1").show();
                      $(".model-content1").hide();
                      $(".model-content").hide();
                      $(".model-content2").show();


                    });

         $(document).on('change', '.radio-option', function() {
         var selectedValue = $(this).val();
         if(selectedValue == "qty")
         {
            $(".qunatity-input").show();
         }
         else{
            $(".qunatity-input").hide();
         }
         });
         $(document).on("click",".booking-back",function(){
          $(".bar").addClass("actv");

                 setTimeout(function() {
                    // $(".available_ride").show();
                    $(".content-wrapper3").hide();
                    $(".rental_ride").hide();
                    $(".available-vehicle-details").removeClass('actv');
                    $(".package").hide();
                    $(".bar").removeClass("actv");
                    $(".book_now").removeClass("actv");
                    $(".book_now").hide();
                    $(".add-details").hide();
                    $(".detail-engine-data").show();
                    $(".content-wrapper").show();


                    $("#packagePicker option[value='select']").prop("selected", true);
                    $('.desktop-bg.p2p').css('background-image', 'url("{{ web_booking_taxi() ?? asset("images/TAXI.png") }}")');

                     $(".from-details.out_station").hide();
                    $(".from-details.booking_type").hide();
                    $(".from-details.daily_rides").show();
                    $(".from-details.rentals").hide();
                  }, 200);
         })
         $(document).on("click",".cancel-booking",function(){
             $(".bar").addClass("actv");
             var request_id = {request_id : $(this).attr("data-val")};
               $.ajax({
                                    headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                             },
                                    url: 'adhoc-cancel-booking',
                                    type: 'POST',
                                    data: request_id,
                                    dataType: 'json',
                                    success: function(response) {
                                        $(".model-init1").html('<div class="model-wrapper"><div class="model-content">  <div class="booking-confirmation image"> <img src="{{ asset("images/cancelled.png") }}" id="success-image" class="img-fluid" style="width:100px;height:100px;"> </div>   <div class="booking-confirmation-text"">Booking Cancelled Successfully</div>  </div>  </div>');
                                        $(".model-init1").show();
                                        $(".bar").removeClass("actv");
                                       setTimeout(function() {
                                           window.location.href='{{url("/")}}/web-booking';
                                            }, 3000);

                                    },
                                     error: function(xhr, status, error) {
                                     // Handle errors
                                     console.error('Error:', xhr.responseText);
                                     }
         });
         });


         function package_booking(){
                    var form_data = new FormData($("#eta_calculaion")[0]);
                        var transport_type = $(".package-list.actv").attr("data-val");
                        var type_vechile= $("#rental_type").val();
                        var rental_package_id = $(".package-list.actv").attr("data-id");
                        var request_eta_amount = $(".package-list.actv").attr("data-amount");
                        var web_on= '1';
                           form_data.append("vehicle_type",transport_type);
                           form_data.append("web_booking",web_on);
                           form_data.append("transport_type",type_vechile);
                           form_data.append("rental_package_id",rental_package_id);
                           form_data.append("request_eta_amount",request_eta_amount);
                           form_data.append("country_code",'{{Session("dial_code")}}');
                           form_data.append("mobile",'{{Session("mobile")}}');
                           $(".bar").addClass("actv");


                           $.ajax({
                                    url: 'adhoc-create-request',
                                    type: 'POST',
                                    data: form_data,
                                    dataType: 'json',
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        // Handle the successful response
                                        $(".content-wrapper").show();
                                        console.log('Success:', response);

                                        // $(".model-init1").html('<div class="model-wrapper"><div class="model-content">  <div class="booking-confirmation image"> <img src="{{ asset("images/confirmation.gif") }}" id="success-image"> </div>   <div class="booking-confirmation-text">Booking Confirmed Successfully</div>  </div>  </div>');
                                        // $(".model-init1").show();

                                        $(".bar").removeClass("actv");
                                          var stateObj = { data: response.data }; // You can pass any data as the state object
                                          var title = "New Page Title";
                                          var newUrl = "{{ url('/') }}/web-booking?request_id="+response.data.id+"";
                                          history.pushState(stateObj, title, newUrl);
                                          Listenrequestdata(response.data.id);
                                          setTimeout(function() {
                                            $(".content-wrapper3").hide();
                                            $(".detail-engine-data").hide();
                                            $(".content-wrapper4").show();
                                            $(".model-init1").hide();
                                            $(".content-wrapper4").html('<div class="waiting-for-booking"><h5 style="line-height: 32px;">Hey {{$user_name}}, Your Booking has Confirmed Successfully.</h5><div class="owner-accept-data"><img src="{{asset("images/ride search.gif")  }}" id="taxi"></div><div class="waiting_fr_driver" style="font-size: 22px;color: black;font-weight: 600; position: relative;text-align: center !important;display: flex; justify-content: center;top: 0px;">waiting for Driver\'s accept....</div></div>');
                                           }, 2000);
                                                 setTimeout(function() {
                                                   if(cancel_button_showing === false)
                                                   {
                                                      $(".waiting_fr_driver").html('Taking more than time.....');
                                                      $(".waiting-for-booking").append('<div class="cancel-booking" data-val="'+response.data.id+'" style=""><div class="cancel_button">Cancel Booking</div></div>');
                                                   }

                                           }, 10000);
                                        },
                                        error: function(xhr, status, error) {
                                        // Handle errors
                                        console.error('Error:', xhr.responseText);
                                        }
                                    });
                }

         google.maps.event.addDomListener(window, 'load', initAutocomplete1);
         google.maps.event.addDomListener(window, 'load', initAutocomplete);
         google.maps.event.addDomListener(window, 'load', initMap);


    var rideInfo = @json($rideInfo);
$(document).ready(function() {
    $('#historyButton').on('click', function() {
        $(".detail-engine-data").hide();
        $('#cardContainer').empty();
        rideInfo.forEach(function(item) {
            var card = $('<div>').addClass('card position-relative mb-3').css('max-width', '540px');
            var cardBody = $('<div>').addClass('row g-0');
            var cardContent = $('<div>').addClass('col-md-8');
            var cardBodyInner = $('<div>').addClass('card-body');

            var cardTitle = $('<h5>').addClass('card-title').text('Ride ID: ' + item.request_number);
            var cardText = $('<p>').addClass('card-text').text('Transport Type: ' + item.transport_type);
            var pickAddress = $('<p>').addClass('card-text').text('Pick Address: ' + item.pick_address);
            var dropAddress = $('<p>').addClass('card-text').text('Drop Address: ' + item.drop_address);

            cardBodyInner.append(cardTitle, cardText, pickAddress, dropAddress);
            cardContent.append(cardBodyInner);
            cardBody.append(cardContent);
            card.append(cardBody);

            // Completion Status Badge
            var statusBadge = $('<div>').addClass('position-absolute top-0 left-100 translate-middle badge').css('font-size', '0.75rem').text(item.is_completed ? 'Completed' : 'Cancelled');
            statusBadge.addClass(item.is_completed ? 'bg-success' : 'bg-danger');
            card.append(statusBadge);

            $('#cardContainer').append(card);
        });
    });
});




$(document).ready(function() {

    $('#cardShowing').on('click', function() {
        $(".cardContainer").hide();
    });
});

$(document).ready(function() {
    $('#sidebarIcon').click(function() {
        $('#sidebarMenu').slideToggle();
    });

    $('#profileIcon').click(function() {
        $('#profileMenu').slideToggle();
    });

   $('.nav-tab .item-name').click(function() {
      var type = $(this).attr('data-val');
      $(".item-name").removeClass("actv");
      $(this).addClass("actv");
      $(".book_now").removeClass("actv");
      $(".book_now").hide();
      if(type !== 'rentals'){
         if($('#confirm_lat').val().length > 0){
            $(".confirm_your_location").trigger('click');
         }
      }else{
         $('.daily_ride_vehicle').html('');
         if(app_for !== 'taxi' && app_for !== 'delivery'){
            if($('#rental_type').val().length >0 ){
               $('#rental_type').trigger('change');
            }
         }else{
            rentalsFetch();
         }
      }
   })

    $(document).click(function(event) {

        if (!$(event.target).closest('.sidebar-icon, #sidebarMenu, .profile-icon, #profileMenu').length) {

  $('#sidebarMenu, #profileMenu').slideUp();
        }
    });
});

      </script>






<style>


.country-menu {
    max-height: 400px; /* Adjust the max height as needed */
    overflow: hidden;
    overflow-y: scroll;
}


.top-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.logo {
    display: block;
    margin: 0 auto; /* Centers the logo horizontally */
}

.sidebar-icon,
.profile-icon {
    font-size: 32px;
    cursor: pointer;
}


.sidebar-icon,.profile-icon {
    position: relative;
    color: #000000;
    cursor: pointer;
    margin-left: 5%;
}

.sidebar-menu,.profile-menu {
    display: none;
    width:300px;
    height:250px;
    background-color: #fff;
    padding: 10px;
    border-radius:5px;
    position: absolute;
    top: 100%;
    right: 0px;
    z-index: 1000;
    border:1px solid #e8e6e6;
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06);
}

.sidebar-menu a , .profile-menu a{
    display: block;
    color: #ffffff;
    font-size:18px;
    text-decoration: none;
    /* margin-left: 5px; */
}


.profile-icon {
    margin-right: 5%; /* Adjusted margin-right */
}

#cardContainer {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    margin-bottom: 20px;
    margin-top: 100px;
}

.card {
    width: 500px; /* Adjust according to your design */
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
    .card {
        width: calc(50% - 20px);
    }
}

@media (max-width: 576px) {
    .card {
        width: calc(100% - 20px);
    }
}

.log-btn{
   border:1px solid #e8e6e6;
   margin:75px;
   padding:1
x;
   box-shadow: 0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06);
   border-radius:5px;
   background:#2b2a2a;
   color:#ffffff;
}


/* sidebar */

.newburgerintown {
  position: absolute;
  left: 0;
  right: 0;
  top: 40vh;
  width:50%;
  min-width: 400px;
  height: 60px;
  margin: 0 auto;
}

.newburgerintown h1 {
    font-weight: 300;
    color: #ECF0F1;
}

.newburgerintown p {
    font-weight: 100;
    color: #ECF0F1;
    letter-spacing: .1em;
}

/**Mobile (Hamburger-)Menu from here on**/

/** This is kind of a styled trigger here **/
#menuToggle
{
    display: block;
    position: fixed;
    top: 25px;
    left: 50px;
    z-index: 1;
    -webkit-user-select: none;
    user-select: none;
}

#menuToggle input
{
    display: block;
    width: 40px;
    height: 32px;
    position: absolute;
    top: -7px;
    left: -5px;
    cursor: pointer;
    opacity: 0;
    z-index: 2;
    -webkit-touch-callout: none;
}

#menuToggle span
{
    display: block;
    width: 26px;
    height: 2px;
    margin-bottom: 5px;
    position: relative;
    background: #000000;
    border-radius: 3px;
    z-index: 1;
    transform-origin: 3px 0px;
    transition: transform 0.2s cubic-bezier(0.77,0.2,0.05,1.0),
    background 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
    opacity 0.55s ease;
}

#menuToggle span:first-child
{
    transform-origin: 0% 0%;
}

#menuToggle span:nth-last-child(2)
{
    transform-origin: 0% 100%;
}

#menuToggle input:checked ~ span
{
    opacity: 1;
    transform: rotate(45deg) translate(-2px, -1px);
    background: #000000;
}
#menuToggle input:checked ~ span:nth-last-child(3)
{
    opacity: 0;
    transform: rotate(0deg)
      scale(0.2, 0.2);
}

#menuToggle input:checked ~ span:nth-last-child(2)
{
    opacity: 1;
    transform: rotate(-45deg) translate(0, -1px);
}

/*This is the Menu part, which gets triggered by toggle*/
#menu
{
    position: absolute;
    width: 20vw;
    height: 110vh;
    margin: -100px 0 0 -50px;
    padding: 50px;
    padding-top: 125px;
    background: rgba(236, 240, 241, 1);;
    list-style-type: none;
    transform-origin: 0 0;
    transform: translate(-100%, 0);
    transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0);
    text-align: start;

}

@media (min-width:320px) {
    #menu {
        width: 50vw;
    }
}
@media (min-width:786px) {
    #menu {
        width: 20vw;
    }
}

#menu li
{
    padding: 15px 0;
    color: #000000;
    list-style-type: none;
    font-size: 1em;
    font-weight: 300;
}

#menu li a {
      color: #000000;
      text-decoration: none;
      text-transformation: uppercase
}

#menu li a:hover {
    color: #2C3E50;
    text-decoration: none;
}

#menuToggle input:checked ~ ul
{
    transform: scale(1.0, 1.0);
    opacity: 1;
}
.promocode{
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
   </body>
</html>







