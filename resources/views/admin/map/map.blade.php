

@extends('admin.layouts.app')

@section('title', 'Map View')

@section('content')





@php


$value=web_map_settings();
@endphp
@if($value=="google")



<style>
    #map {
        height: 70vh;
        margin: 15px;
    }
    #legend {
        font-family: Arial, sans-serif;
        background: #fff;
        padding: 10px;
        margin: 10px;
        border: 3px solid #000;
    }
    #legend h3 {
        margin-top: 0;
    }
    #legend img {
        vertical-align: middle;
    }
</style>
<!-- Start Page content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">

                <div class="box-header with-border" style="display:flex;align-items:center;justify-content:space-between;">
                    <h3>{{ $page }}</h3>
                    <div>
                        <span style="display:inline-block;background:#28a745;color:#fff;border-radius:4px;padding:6px 12px;margin-right:8px;font-size:14px;">Available: <strong id="god-eye-available">0</strong></span>
                        <span style="display:inline-block;background:#fd7e14;color:#fff;border-radius:4px;padding:6px 12px;margin-right:8px;font-size:14px;">On Ride: <strong id="god-eye-onride">0</strong></span>
                        <span style="display:inline-block;background:#6c757d;color:#fff;border-radius:4px;padding:6px 12px;font-size:14px;">Offline: <strong id="god-eye-offline">0</strong></span>
                    </div>
                </div>
                {{-- <div class="col-sm-12">

                    <form id="god_eye">
                        @csrf

                <div class="row">
                     <div class="col-sm-6">

                            <label for="search-box" class="form-label">@lang('view_pages.search_area')</label>
                            <input id="search-box" class="search__input form-control  p-5" type="text" placeholder="@lang('view_pages.search')" style="height: 40px" required/>
                            <input type="hidden" id="lat" name="lat" value="">
                            <input type="hidden" id="lng" name="lng" value="">
                            <input type="hidden" id="formatted_address" name="formatted_address" value="">

                            </div>
                  <div class="col-sm-6">

                                    <label for="radius" class="form-label">@lang('view_pages.within_distance') (km)</label>
                            <select name="radius" id="radius" placeholder="{{ __('view_pages.within_distance') }}" class="form-control" required>
                                <option value="100"{{ __('view_pages.select') }}  >100</option>
                                <option value="50" {{ old('radius') == '50' ? 'selected' : '' }}>50</option>
                                <option value="25" {{ old('radius') == '25' ? 'selected' : '' }}>25</option>
                            </select>

                            </div>

                </div>


                            <div class="col-12">
                                <button class="btn btn-primary btn-sm pull-right m-5" type="submit">
                                    @lang('view_pages.save')
                                </button>
                            </div>

                    </form>
                </div> --}}

                        <div id="map"></div>

                        <div id="legend"><h3>@lang('view_pages.legend')</h3></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&libraries=visualization"></script>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>

<script type="text/javascript">
    var heatmapData = [];
    var pickLat = [];
    var pickLng = [];
     var default_lat = '{{$default_lat}}';
    var default_lng = '{{$default_lng}}';
     var company_key='{{auth()->user()->company_key}}';
    var driverLat,driverLng,bearing,type;
    var marker = [];


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

    var tripRef = firebase.database().ref('drivers');

    var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(default_lat, default_lng),
            zoom: 5,
            mapTypeId: 'roadmap'
        });

        var iconBase = '{{ asset("map/icon/") }}';
        var icons = {
          car_available: {
            name: 'Available',
            icon: iconBase + '/driver_available.png'
          },
          car_ontrip: {
            name: 'OnTrip',
            icon: iconBase + '/driver_on_trip.png'
          },
         car_offline: {
            name: 'Offline',
            icon: iconBase + '/driver_off_trip.png'
         },
         bike_available: {
            name: 'Available',
            icon: iconBase + '/available-bike.png'
          },
          bike_ontrip: {
            name: 'OnTrip',
            icon: iconBase + '/ontrip-bike.png'
          },
          bike_offline: {
            name: 'Offline',
            icon: iconBase + '/offline-bike.png'
          },
          truck_available: {
            name: 'Available',
            icon: iconBase + '/available-truck.png'
          },
          truck_ontrip: {
            name: 'OnTrip',
            icon: iconBase + '/ontrip-truck.png'
          },
          truck_offline: {
            name: 'Offline',
            icon: iconBase + '/offline-truck.png'
          },
        };

         var fliter_icons = {
          available: {
            name: 'Available',
            icon: iconBase + '/available.png'
          },
          ontrip: {
            name: 'OnTrip',
            icon: iconBase + '/ontrip.png'
          },
         offline: {
            name: 'Offline',
            icon: iconBase + '/offline.png'
         }
        };

        var legend = document.getElementById('legend');

        for (var key in fliter_icons) {
            var type = fliter_icons[key];
            var name = type.name;
            var icon = type.icon;
            var div = document.createElement('div');
            div.innerHTML = '<img src="' + icon + '"> ' + name;
            legend.appendChild(div);
        }

        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);

    var markerById = {};

    function driverPopup(val) {
        return `<div class="p-2">
                    <h6><i class="fa fa-id-badge"></i> : ${val.name ?? '-' } </h6>
                    <h6><i class="fa fa-phone-square"></i> : ${val.mobile ?? '-'} </h6>
                    <h6><i class="fa fa-id-card"></i> : ${val.vehicle_number ?? '-'} </h6>
                    <h6><i class="fa fa-truck"></i> : ${val.vehicle_type_name ?? '-'} </h6>
                </div>`;
    }

    var markerStateById = {};

    function driverState(val) {
        var conditional_timestamp = new Date(Date.now() - 15 * 60000);
        if (!val || conditional_timestamp > val.updated_at) {
            return 'offline';
        }
        if (val.is_available == true && val.is_active == true) {
            return 'available';
        }
        if (val.is_active == true && val.is_available == false) {
            return 'ontrip';
        }
        return 'offline';
    }

    function refreshDriverCounts() {
        var available = 0;
        var onride = 0;
        var offline = 0;
        Object.keys(markerStateById).forEach(function (key) {
            if (markerStateById[key] === 'available') {
                available++;
            } else if (markerStateById[key] === 'ontrip') {
                onride++;
            } else {
                offline++;
            }
        });
        var availableEl = document.getElementById('god-eye-available');
        var onrideEl = document.getElementById('god-eye-onride');
        var offlineEl = document.getElementById('god-eye-offline');
        if (availableEl) availableEl.textContent = available;
        if (onrideEl) onrideEl.textContent = onride;
        if (offlineEl) offlineEl.textContent = offline;
    }

    function driverIconUrl(val) {
        var iconImg = '';
        var state = driverState(val);
        var typeKey = 'car';
        if (val.vehicle_type_icon == 'motor_bike') {
            typeKey = 'bike';
        } else if (val.vehicle_type_icon == 'truck') {
            typeKey = 'truck';
        }
        iconImg = icons[typeKey + '_' + state].icon;
        return iconImg;
    }

    function removeDriverMarker(key) {
        var existing = markerById[key];
        if (!existing) {
            return;
        }
        existing.setMap(null);
        delete markerById[key];
        delete markerStateById[key];
        marker = marker.filter(function (item) { return item !== existing; });
        refreshDriverCounts();
    }

    function upsertDriverMarker(key, val) {
        if (!val || typeof val !== 'object' || typeof val.l === 'undefined' || val.l[0] == null || val.l[1] == null) {
            removeDriverMarker(key);
            return;
        }
        markerStateById[key] = driverState(val);
        var iconImg = driverIconUrl(val);
        var position = new google.maps.LatLng(val.l[0], val.l[1]);
        var existing = markerById[key];
        if (existing) {
            existing.setPosition(position);
            existing.setIcon(iconImg);
            if (existing._info) {
                existing._info.setContent(driverPopup(val));
            }
            refreshDriverCounts();
            return;
        }
        var infowindow = new google.maps.InfoWindow({
            content: driverPopup(val)
        });
        var carIcon = new google.maps.Marker({
            position: position,
            icon: iconImg,
            map: map
        });
        carIcon._info = infowindow;
        carIcon.addListener('click', function() {
            infowindow.open(map, carIcon);
        });
        markerById[key] = carIcon;
        marker.push(carIcon);
        refreshDriverCounts();
    }

    tripRef.on('child_added', function (snapshot) {
        upsertDriverMarker(snapshot.key, snapshot.val());
    });
    tripRef.on('child_changed', function (snapshot) {
        upsertDriverMarker(snapshot.key, snapshot.val());
    });
    tripRef.on('child_removed', function (snapshot) {
        removeDriverMarker(snapshot.key);
    });

    function loadDriverIcons(data){
        deleteAllMarkers();

        if (!data || typeof data !== 'object') {
            return;
        }

        Object.entries(data).forEach(([key, val]) => {
            upsertDriverMarker(key, val);
        });
    }

    // Delete truck icons once map reloads
    function deleteAllMarkers() {
        for(var i=0;i<marker.length;i++){
            marker[i].setMap(null);
        }
        marker = [];
        markerById = {};
        markerStateById = {};
        refreshDriverCounts();
    }



    function initAutocomplete() {
    if (!document.getElementById('search-box') || !(window.google && google.maps && google.maps.places)) {
        return;
    }
    var autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('search-box'),
        { types: ['geocode'] }
    );
    autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng();
        var formatted_address = place.formatted_address;
        $('#lat').val(latitude);
        $('#lng').val(longitude);
        $('#formatted_address').val(formatted_address);
        // $('#search-box').trigger('input');
        $("#search-button").html('Data loading , Please wait...');
        ajaxrequest();
    });
}


$('#god_eye').on('submit',function (e){
        e.preventDefault();
        $("#search-button").html('Data loading , Please wait...');

     ajaxrequest();
    });


function ajaxrequest(){
        var formData = $("#god_eye").serialize();
        var lat = $("#lat").val();
        if(lat !== undefined)
        {
            $.ajax({
            url: '{{ route("fetchCity") }}',
            method: 'get',
            data: formData,
            success: function(results){
                 console.log(results.data);
                 console.log(typeof results);
                loadDriverIcons(results.data);
            }
        })
        }

    }
window.onload = function () {
    initAutocomplete();
};


</script>

















@elseif($value=="open_street")

<style>
    #map {
        height: 70vh;
        margin: 15px;
    }
    #legend {
        font-family: Arial, sans-serif;
        background: #fff;
        padding: 10px;
        margin: 10px;
        border: 3px solid #000;
    }
    #legend h3 {
        margin-top: 0;
    }
    #legend img {
        vertical-align: middle;
    }
</style>
<!-- Start Page content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">

                <div class="box-header with-border" style="display:flex;align-items:center;justify-content:space-between;">
                    <h3>{{ $page }}</h3>
                    <div>
                        <span style="display:inline-block;background:#28a745;color:#fff;border-radius:4px;padding:6px 12px;margin-right:8px;font-size:14px;">Available: <strong id="god-eye-available">0</strong></span>
                        <span style="display:inline-block;background:#fd7e14;color:#fff;border-radius:4px;padding:6px 12px;margin-right:8px;font-size:14px;">On Ride: <strong id="god-eye-onride">0</strong></span>
                        <span style="display:inline-block;background:#6c757d;color:#fff;border-radius:4px;padding:6px 12px;font-size:14px;">Offline: <strong id="god-eye-offline">0</strong></span>
                    </div>
                </div>

                <div id="map"></div>

                <div id="legend"><h3>@lang('view_pages.legend')</h3></div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>

<script type="text/javascript">
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
    var map = L.map('map').setView([{{$default_lat}}, {{$default_lng}}], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
    }).addTo(map);

    var iconBase = '{{ asset("map/icon/") }}';
    var icons = {
        car_available: iconBase + '/driver_available.png',
        car_ontrip: iconBase + '/driver_on_trip.png',
        car_offline: iconBase + '/driver_off_trip.png',
        bike_available: iconBase + '/available-bike.png',
        bike_ontrip: iconBase + '/ontrip-bike.png',
        bike_offline: iconBase + '/offline-bike.png',
        truck_available: iconBase + '/available-truck.png',
        truck_ontrip: iconBase + '/ontrip-truck.png',
        truck_offline: iconBase + '/offline-truck.png',
    };
    var legend = L.control({ position: 'bottomright' });

legend.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info legend');
    var labels = ['Available', 'OnTrip', 'Offline'];
    var fliter_icons = {
        available: {
            name: 'Available',
            icon: iconBase + '/available.png'
        },
        ontrip: {
            name: 'OnTrip',
            icon: iconBase + '/ontrip.png'
        },
        offline: {
            name: 'Offline',
            icon: iconBase + '/offline.png'
        }
    };

    for (var key in fliter_icons) {
        var type = fliter_icons[key];
        var name = type.name;
        var icon = type.icon;
        var divItem = document.createElement('div'); // Changed variable name to divItem
        divItem.innerHTML = '<img src="' + icon + '"> ' + name;
        divItem.style.marginBottom = '5px'; // Add some spacing between legend items
        div.appendChild(divItem); // Changed from legend.appendChild(divItem) to div.appendChild(divItem)
    }

    return div;
};

legend.addTo(map);

    var driversRef = firebase.database().ref('drivers');

    driversRef.on('value', async function(snapshot) {
        var data = snapshot.val();

        await loadDriverIcons(data);
    });

    var markers = [];

    function driverState(driver) {
        var conditionalTimestamp = new Date(Date.now() - 15 * 60000);
        if (!driver || conditionalTimestamp > driver.updated_at) {
            return 'offline';
        }
        if (driver.is_available == true && driver.is_active == true) {
            return 'available';
        }
        if (driver.is_active == true && driver.is_available == false) {
            return 'ontrip';
        }
        return 'offline';
    }

    function refreshDriverCounts(counts) {
        var availableEl = document.getElementById('god-eye-available');
        var onrideEl = document.getElementById('god-eye-onride');
        var offlineEl = document.getElementById('god-eye-offline');
        if (availableEl) availableEl.textContent = counts.available;
        if (onrideEl) onrideEl.textContent = counts.onride;
        if (offlineEl) offlineEl.textContent = counts.offline;
    }

    function loadDriverIcons(data) {
        markers.forEach(marker => {
            map.removeLayer(marker);
        });

        markers = [];
        var counts = { available: 0, onride: 0, offline: 0 };

        if (data && typeof data === 'object') {
            Object.values(data).forEach(val => {
                if (!val || typeof val.l === 'undefined' || val.l[0] == null || val.l[1] == null) {
                    return;
                }
                var state = driverState(val);
                if (state === 'available') {
                    counts.available++;
                } else if (state === 'ontrip') {
                    counts.onride++;
                } else {
                    counts.offline++;
                }

                var marker = L.marker([val.l[0], val.l[1]], { icon: getDriverIcon(val) })
                    .bindPopup(getPopupContent(val))
                    .addTo(map);

                markers.push(marker);
            });
        }

        refreshDriverCounts(counts);
    }

    function getDriverIcon(driver) {
        var state = driverState(driver);
        var typeKey = 'car';
        if (driver.vehicle_type_icon == 'motor_bike') {
            typeKey = 'bike';
        } else if (driver.vehicle_type_icon == 'truck') {
            typeKey = 'truck';
        }
        return L.icon({ iconUrl: icons[typeKey + '_' + state] });
    }

    function getPopupContent(driver) {
        return `
            <div class="p-2">
                <h6><i class="fa fa-id-badge"></i> : ${driver.name ?? '-'}</h6>
                <h6><i class="fa fa-phone-square"></i> : ${driver.mobile ?? '-'}</h6>
                <h6><i class="fa fa-id-card"></i> : ${driver.vehicle_number ?? '-'}</h6>
                <h6><i class="fa fa-truck"></i> : ${driver.vehicle_type_name ?? '-'}</h6>
            </div>`;
    }
</script>
@endif
@endsection
