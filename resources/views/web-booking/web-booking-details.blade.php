<style>
   .card {
    width: 500px; /* Adjust according to your design */
    background-color: #ffffff;
    border: 1px solid #fff;
    border-radius: 8px;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.line{
   margin: 2vh 0;
    border: 1px dashed #d1d1d1;
}

.bg-loader.actv {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    z-index: 100;
    background-color: black;
    opacity: 0.5;
}
</style>

@if(count($booking_data) > 0)
<div class="model-init" style="display: none;">
   <div class="model-wrapper">
      <div class="model-content1" style="display: none;">
         <div class="model-head">
            update additional Information
         </div>
         <div class="model-head name">
            Name
         </div>
         <div class="model-input1 data1">
            <input type="text" id="model-promo-input-name" value="{{$user_detail->name}}">
         </div>
         <div class="model-head name">
            Phone number
         </div>
         <div class="model-input1 data1">
            <input type="number" id="model-promo-input-number" value="{{$user_detail->mobile}}">
         </div>
         <div class="model-head name">
            Instruction
         </div>
         <div class="model-input1 data1" style="height: 65px;">
            <textarea id="model-promo-input-ins" style="height: 100%;width: 100%;border: none;outline: none;"></textarea>
         </div>
         <div class="promocode">
            <div class="promocode-cancel">
               Cancel
            </div>
            <div class="receiver-add">
               Add
            </div>
         </div>
      </div>
   </div>
</div>
<div id="head" class="head1">
   <div class="header-menu">
      <div class="right-arrow1 "><i class="fa fa-arrow-left booking-back"></i></div>
      <div class="drop_location" style="padding-bottom: 10px;">@lang('view_pages.booking_information')</div>
      <div class="booking_info">
         {{-- <div id="mapImageContainer">
            <img id="mapImage" style="width:100%" src="https://maps.googleapis.com/maps/api/staticmap?center={{ $request->lat }},{{ $request->lng }}&zoom=15&size=600x300&markers=icon:https://maps.google.com/mapfiles/ms/icons/blue-dot.png|{{ $request->lat }},{{ $request->lng }}&key=AIzaSyBgHOLmUHegDdvvQgwH7sqUtb8ZdD1NI4E">
         </div> --}}
         <div style="width: 90vw;background-color: #ffffff;border: 1px solid #fff;border-radius: 8px;padding: 10px;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
         <div class="pick_ups_location" style="padding-top:10px">
            <div class="left-text" style="color:red">@lang('view_pages.pickup')</div>
            <div class="pickup_loc_name pickup">{{$request->pickup_address}}</div>
         </div>
         <div class="line"></div>
         <div class="pick_ups_location">
            <div class="left-text" style="color:green">@lang('view_pages.drop')</div>
            <div class="pickup_loc_name drop">{{$request->drop_address}}</div>
         </div>
         </div>
         <div class="vehicle-details" style="margin-top:20px">
            <div class="price-details" style="padding: 10px 0px; font-size: 3vh;">
               <div class="vehicle-type-text">
                  {{$booking_data[0]->name}}
                  <div class="price-vehicle-desc">{{$booking_data[0]->short_description}}</div>
               </div>
               <div class="price-data-value" style="top: 0px;right:5px"><img src="{{$booking_data[0]->vehicle_icon ?? ' '}}" id="vehicle-image"></div>
            </div>
         </div>
         <div class="fare-breaup-details" style="margin-top:20px; font-size: 3vh;">
            <div class="price-details-head">@lang('view_pages.fare_breakup')</div>
            <div class="price-details1">
               <div class="price-data">@lang('view_pages.base_price')</div>
               <div class="price-data-value" >{{$booking_data[0]->currency}}{{number_format($booking_data[0]->base_price,2,'.',',')}}</div>
            </div>
            <div class="price-details2">
               <div class="price-data">@lang('view_pages.distance_price')</div>
               <div class="price-data-value">{{$booking_data[0]->currency}}{{number_format($booking_data[0]->distance_price,2,'.',',')}}</div>
            </div>
             <div class="price-details1">
               <div class="price-data">@lang('view_pages.time_price')</div>
               <div class="price-data-value" >{{$booking_data[0]->currency}}{{number_format($booking_data[0]->time_price,2,'.',',')}}</div>
            </div>
            <div class="price-details3">
               <div class="price-data">@lang('view_pages.service_price')</div>
               <div class="price-data-value">{{$booking_data[0]->currency}}{{number_format($booking_data[0]->tax_amount,2,'.',',')}}</div>
            </div>
            <div class="price-details4">
               <div class="price-data">@lang('view_pages.convenience_fee')</div>
               <div class="price-data-value">
                  @if($booking_data[0]->has_discount)
                  {{$booking_data[0]->currency}}{{number_format($booking_data[0]->with_discount_admin_commision,2,'.',',')}}
                  @else
                  {{$booking_data[0]->currency}}{{number_format($booking_data[0]->without_discount_admin_commision,2,'.',',')}}
                  @endif
               </div>
            </div>

            <div class="price-details5">
               <div class="price-data">@lang('view_pages.total_price')</div>
               <div class="price-data-value">{{$booking_data[0]->currency}}{{number_format($booking_data[0]->total,2,'.',',')}}</div>
            </div>
         </div>
         <div class="payment-mode-details">
            <div class="payment-mode">
                <div class="payment-text">@lang('view_pages.payment_type')</div>
                <select id="payment-method" class="price-data-value" style="top: 0px;">
                    <option value="1">@lang('view_pages.cash')</option>
                    <option value="0">@lang('view_pages.card')</option>


                </select>
            </div>
        </div>

         <!--   <div class="fare-breaup-details">
            <div class="payment-mode" style="padding-top: 20px";>
             <div class="payment-text">Apply coupon code</div>
             <div class="price-data-value" style="/* right: 25px; */top: 20px;color: blue;text-decoration: underline;cursor: pointer;">Add</div>
             </div>
            </div> -->
         @if(isset($request->booking_type))
         <div class="data">
            <div class="payment-mode">
               <div class="payment-text">@lang('view_pages.date')</div>
               <div class="price-data-value" >{{$request->date}} <i class="fa fa-pencil-square-o date-edit"  style="/* right: 25px; */top: 0px;color: blue;text-decoration: underline;cursor: pointer;padding-left: 10px;" aria-hidden="true"></i></div>
            </div>
         </div>
         @endif
         @if($transport_type == "delivery")
         <div class="data">
            <div class="payment-mode">
               <div class="payment-text">@lang('view_pages.receiver_information')</div>
               <div class="price-data-value receiver-dt" style="/* right: 25px; */top: 0px;color: blue;text-decoration: underline;cursor: pointer;"><i class="fa fa-pencil-square-o" style="/* right: 25px; */top: 0px;color: blue;text-decoration: underline;cursor: pointer;padding-left: 10px;" aria-hidden="true"></i></div>
            </div>
         </div>
         <div class="goods-details">
            <div class="goods_types">
               <div class="goods text">@lang('view_pages.goods_type')</div>
               <div class="from location text placeholder goods_type">
                  <select id="goods_type" class="depart-select ola-select">
                     <option value="select">@lang('view_pages.select_goods_type')</option>
                     @foreach($goods_type as $key=>$value)
                     <option value="{{$value->id}}" @if($key ==0) Selected @endif>{{$value->goods_type_name}}</option>
                     @endforeach
                     <template is="dom-repeat"></template>
                  </select>
               </div>
            </div>
            <div class="loose-goods" style=" margin-top:10px">
               <input type="radio" id="loose" name="goods_types" value="loose" class="radio-option" checked>
               &nbsp; <label for="loose">@lang('view_pages.loose')</label>
               &nbsp; <input type="radio" id="qty" name="goods_types" value="qty" class="radio-option">
               &nbsp; <label for="qty">@lang('view_pages.quantity')</label>
               <div class="model-input1 data1 qunatity-input" style="display:none">
                  <input type="text" id="model-promo-input-qty">
               </div>
            </div>
         </div>
         @endif
         <div class="confirm_your_location3 confirm_to_book text-center" onclick="confirm_booking()" style="margin-top:50px">
            <div class="confirm_button" style="width: 50%;">
             @lang('view_pages.confirm_to_booking')
            </div>
         </div>
      </div>
   </div>

<div id="bg-loader" class="bg-loader" style="display: flex; justify-content: center; align-items: center;">
    <div id="loader" class="loader" >
      <img src="{{asset('images/loader.gif')}}" style="height:50vh " ></img>
    </div></div>
</div>
<script>
   function confirm_booking(){

    $("#loader").show();
    $(".bg-loader").addClass("actv");
    var paymentMethod = document.getElementById('payment-method').value;

    var paymentOptValue = (paymentMethod === '1') ? '1' : '0';
    var web1 = '1';
       var form_data = new FormData($("#eta_calculaion")[0]);


       form_data.append("transport_type",'{{$transport_type}}');
              form_data.append("vehicle_type",'{{$booking_data[0]->zone_type_id}}');
              form_data.append("mobile",'{{$user_detail->mobile}}');
              form_data.append("payment_opt", paymentOptValue);


              form_data.append("request_eta_amount",'{{$booking_data[0]->total}}');

              form_data.append("web_booking",web1);

              form_data.append("country_code",'{{Session("dial_code")}}');
              var poc_name = $("#model-promo-input-name").val();
              @if(isset($request->booking_type))
               form_data.append("is_later",1);
               form_data.append("trip_start_time",'{{date("Y-m-d H:i:s",strtotime($request->date))}}');
              @endif
              @if($transport_type == "delivery")
              const goods_types_name = document.querySelector('input[name="goods_types"]:checked');
               const selectedValue = goods_types_name.value;
               form_data.append("drop_poc_name",$("#model-promo-input-name").val());
               form_data.append("drop_poc_mobile",$("#model-promo-input-number").val());
               form_data.append("drop_poc_instruction",$("#model-promo-input-ins").val());
               if(selectedValue == "qty")
               {
                   form_data.append("goods_type_quantity",$("#model-promo-input-qty").val());
               }
               else{
                   form_data.append("goods_type_quantity",selectedValue);
               }

               form_data.append("goods_type_id",$("#goods_type").val());
               @endif
              $.ajax({
                       url: 'adhoc-create-request',
                       type: 'POST',
                       data: form_data,
                       dataType: 'html',
                       processData: false,
                       contentType: false,
                       success: function(response) {
                           $(".content-wrapper").show();
                           var response_data = JSON.parse(response);

                                        // $(".model-init1").html('<div class="model-wrapper"><div class="model-content">  <div class="booking-confirmation image"> <img src="{{ asset("images/confirmation.gif") }}" id="success-image"> </div>   <div class="booking-confirmation-text">Booking Confirmed Successfully</div>  </div>  </div>');
                                        // $(".model-init1").show();

                           $(".bar").removeClass("actv");

                               if(response_data.data.is_later == 1)
                               {
                                 window.location.reload();

                               }
                               else{

                               var stateObj = { data: response_data.data };
                               var title = "New Page Title";
                               var newUrl = "{{ url('/') }}/web-booking?request_id="+response_data.data.id+"";
                               history.pushState(stateObj, title, newUrl);
                               Listenrequestdata(response_data.data.id);
                               setTimeout(function() {
                                  $(".content-wrapper3").hide();
                                  $(".detail-engine-data").hide();
                                  $(".content-wrapper4").show();
                                  $(".model-init1").hide();
                                  $(".content-wrapper4").html('<div class="waiting-for-booking"><h5 style="line-height: 32px;">Hey '+poc_name+', Your Booking has Confirmed Successfully.</h5><div class="owner-accept-data"><img src="{{asset("images/ride search.gif")  }}" id="taxi" class="img-fluid" style="width:60%"></div><div class="waiting_fr_driver" style="font-size: 22px;color: black;font-weight: 600; position: relative;text-align: center !important;display: flex; justify-content: center;top: 0px;">waiting for Driver\'s accept....</div></div>');

                                  $("#loader").hide();
                                  $(".bg-loader").removeClass("actv");
                                 $(".waiting-for-booking").append('<div class="cancel-booking" data-val="'+response_data.data.id+'" style=""><div class="cancel_button">Cancel Booking</div></div>');
                               }, 200);
                               setTimeout(function() {
                                 if(cancel_button_showing === false)
                                 {
                                    $(".waiting_fr_driver").html('Taking more time.....');

                                    $(".waiting-for-booking").append('<div class="cancel-booking" data-val="'+response_data.data.id+'" style=""><div class="cancel_button">Cancel Booking</div></div>');
                                 }

                               }, 10000);
                           }
                        },
                           error: function(xhr, status, error) {
                           // Handle errors
                           console.error('Error:', xhr.responseText);
                           }
                       });

   }

</script>
@endif
