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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ fav_icon() ?? asset('assets/img.logo.png')}}">

</head>
<body>
    <div class="load-bar">
        <div class="bar"></div>
    </div>
    <div class="content-wrapper">
        <div class="header-menu">
            <a href="{{ url('web-booking') }}"  class="back-button"> <i class="fa fa-arrow-left" style="font-size: 35px;padding:10px"></i></a>



        </div>
    </div>

    <div class="desktop-bg p2p" style="background-image: url('{{ web_booking_taxi() ?? asset("images/TAXI.png") }}'); background-attachment: fixed; background-size: cover; background-position: center;">
        <div></div>
    </div>

    <div class="content-wrapper" id="cardShowing" style="overflow-y: auto; height: 89vh; ">
        <div class="container mt-5">
            <div class="row p-3">
                <div class="col-12 col-lg-12">
                    <div class="worko-tabs">

                        <input class="state" type="radio" title="tab-one" name="tabs-state" id="tab-one" checked />
                        <input class="state" type="radio" title="tab-two" name="tabs-state" id="tab-two" />

                        <div class="tabs flex-tabs">
                            <label for="tab-one" id="tab-one-label" class="tab">@lang('view_pages.upcoming_rides')</label>
                            <label for="tab-two" id="tab-two-label" class="tab">@lang('view_pages.completed_rides')</label>


                            <div id="tab-two-panel" class="panel active">
                                 @forelse($rideInfo as $key => $result)
                              <div class="card p-3" style="margin-bottom: 10px" onclick="handleCardClick('{{ $result->id }}')">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4>Ride ID: {{$result->request_number}}</h4>
                            @if($result->is_completed==0)
                            <h5 class="bg-danger p-1 text-white rounded">@lang('view_pages.cancelled')</h5>
                            @endif
                            @if($result->is_completed==1)
                            <h5 class="bg-success p-1 text-white rounded">@lang('view_pages.completed')</h5>
                            @endif
                        </div>
                        <div class="row mt-3">
                            <div class="col fw-bold">@lang('view_pages.transport_type'):</div>
                            <div class="col">{{$result->transport_type}}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col fw-bold">@lang('view_pages.pick_address')</div>
                            <div class="col">{{$result->pick_address}}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col fw-bold">@lang('view_pages.drop_address')</div>
                            <div class="col">{{$result->drop_address}}</div>
                        </div>
                    </div>
                    @empty
                    <p id="no_data" class="lead no-data text-center">
                        <img src="{{asset('assets/img/dark-data.svg')}}" style="width:150px;margin-top:25px;margin-bottom:25px;" alt="">
                        <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
                    </p>
                    @endforelse
                </div>





                <div id="tab-one-panel" class="panel">
                                @forelse($rideLater as $key => $result)
                                <div class="card p-3" style="margin-bottom: 10px">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4>@lang('view_pages.ride_id') {{$result->request_number}}</h4>

                                    </div>
                                    <div class="row mt-3">
                                        <div class="col fw-bold">@lang('view_pages.trip_start_time') </div>
                                        <div class="col fw-bold">{{ (new DateTime($result->trip_start_time))->format('d-m-Y g.i A') }}</div>

                                    </div>
                                    <div class="row mt-3">
                                        <div class="col fw-bold">@lang('view_pages.transport_type')</div>
                                        <div class="col">{{$result->transport_type}}</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col fw-bold">@lang('view_pages.vehicle_type')</div>
                                        <div class="col">{{$result->vehicle_type_name}}</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col fw-bold">@lang('view_pages.pick_address')</div>
                                        <div class="col">{{$result->pick_address}}</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col fw-bold">@lang('view_pages.drop_address')</div>
                                        <div class="col">{{$result->drop_address}}</div>
                                    </div>
                                    <div class="row mt-5 text-center">
                                        <div class="col col-lg-12 fw-bold">@lang('view_pages.sure_to_cancel')</div>
                                        <div class="col col-lg-12">
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancel">Cancel</button>
                                        </div>
                                    </div>

                                </div>
                                @empty
                                <p id="no_data" class="lead no-data text-center">
                                    <img src="{{asset('assets/img/dark-data.svg')}}" style="width:150px;margin-top:25px;margin-bottom:25px;" alt="">
                                    <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
                                </p>
                                @endforelse

                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="cancelTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelTitle">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               @lang('view_pages.alter_to_cancel')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('view_pages.close')</button>
                <button type="button" class="btn btn-primary" id="confirmButton">@lang('view_pages.confirm')</button>
            </div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.2.2/firebase-app.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-database.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.2.2/firebase-auth.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
 <script>

        function handleCardClick(id) {
            window.location.href = "{{ url('web-booking-history-details') }}/" + id;
        }
        $(document).ready(function(){
    $('#confirmButton').click(function(){
        var url = "{{ url('web-booking-ride-cancel', $result->id ?? '') }}";
        var form = $('<form action="' + url + '" method="POST">@csrf</form>');
        form.append('<input type="hidden" name="_method" value="POST">');
        $('body').append(form);
        form.submit();
    });
});
    </script>
<style>

.worko-tabs {
    margin: 0px;
    width: 100%;
}
 .worko-tabs .state {
	 position: absolute;
	 left: -10000px;
}
 .worko-tabs .flex-tabs {
	 display: flex;
	 justify-content: space-between;
	 flex-wrap: wrap;
}
 .worko-tabs .flex-tabs .tab {
	 flex-grow: 1;
	 /* max-height: 40px; */
}
 .worko-tabs .flex-tabs .panel {
	 background-color: #fff;
	 padding: 20px;
	 min-height: 300px;
	 display: none;
	 width: 100%;
	 flex-basis: auto;
}
 .worko-tabs .tab {
	 display: inline-block;
	 padding: 10px;
	 /* vertical-align: top; */
	 background-color: #eee;
	 cursor: hand;
	 cursor: pointer;
	 border-left: 10px solid #ffffff;
     text-align: center;
}
 .worko-tabs .tab:hover {
	 background-color: #fff;
}
 #tab-one:checked ~ .tabs #tab-one-label, #tab-two:checked ~ .tabs #tab-two-label {
    background-color: #0c397b;
    cursor: default;
    border: #284bbe 3px solid;
    color: #ffffff;
    font-size: 18px;
    font-weight: 800;
    padding: 10px;
    text-align: center;
}

 #tab-one:checked ~ .tabs #tab-one-panel, #tab-two:checked ~ .tabs #tab-two-panel {
	 display: block;
}
 @media (max-width: 600px) {
	 .flex-tabs {
		 flex-direction: row;
	}
	 .flex-tabs .tab {
		 background: #fff;
		 border-bottom: 1px solid #ccc;
	}
	 .flex-tabs .tab:last-of-type {
		 border-bottom: none;
	}
	 .flex-tabs #tab-one-label {
		 order: 1;
	}
	 .flex-tabs #tab-two-label {
		 order: 2;
	}
	 .flex-tabs #tab-one-panel {
		 order: 3;
	}
	 .flex-tabs #tab-two-panel {
		 order: 4;
	}
	 #tab-one:checked ~ .tabs #tab-one-label, #tab-two:checked ~ .tabs #tab-two-label{
		 border-bottom: none;
	}
	 #tab-one:checked ~ .tabs #tab-one-panel, #tab-two:checked ~ .tabs #tab-two-panel {
		 border-bottom: 1px solid #ccc;
	}
}


.bx{
    background:#ffffff;
    -webkit-box-shadow: 10px 10px 9px 7px rgba(235,235,235,1);
    -moz-box-shadow: 10px 10px 9px 7px rgba(235,235,235,1);
    box-shadow: 10px 10px 9px 7px rgba(235,235,235,1);padding: 20px;border-radius:20px;
    padding: 20px;
    border-radius:20px;
    border:1px solid #e4e4e4;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    margin-bottom: 20px;
    margin-top: 0px;
}
.header-menu {
    display: flex;
    align-items: flex-start;
    justify-content: space;
    width: 100%;

}
.sidebar-menu {
    position: absolute;
    top: 100%;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
    display: none;
}

.sidebar-menu button {
    display: block;
    width: 100%;
    padding: 8px 0;
    text-align: center;
    border: none;
    background-color: transparent;
    cursor: pointer;
}

.sidebar-icon {
    margin-left: 5%;
}
.card {
    width: 100%; /* Set the initial width to 100% */
    max-width: 500px; /* Set a maximum width */
    background: #ffffff;
    box-shadow: 10px 10px 9px 7px rgba(235, 235, 235, 1);
    padding: 5%; /* Set padding using percentage */
    border-radius: 20px;
    border: 1px solid #e4e4e4;
    cursor: pointer;
}

@media (max-width: 768px) {
    .card {
        max-width: calc(50% - 20px);
    }
}

@media (max-width: 576px) {
    .card {
        max-width: calc(100% - 20px);
    }
}



</style>
   </body>
</html>
