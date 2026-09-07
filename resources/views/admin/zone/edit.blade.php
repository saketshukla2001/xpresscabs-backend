@extends('admin.layouts.app')

@section('title', 'Main page')

@section('content')

@php

$value=web_map_settings();
@endphp
@if($value=="google")


<style>
#map {
height: 400px;
width: 80%;
left: 10px;
}
html, body {
padding: 0;
margin: 0;
height: 100%;
}

#panel {
width: 200px;
font-family: Arial, sans-serif;
font-size: 13px;
float: right;
margin: 10px;
margin-top: 100px;
}

#delete-button, #add-button, #delete-all-button, #save-button {
margin-top: 5px;
}
#search-box {
background-color: #f7f7f7;
font-size: 15px;
font-weight: 300;
margin-top: 10px;
margin-bottom: 10px;
margin-left: 10px;
padding: 0 11px 0 13px;
text-overflow: ellipsis;
height: 25px;
width: 80%;
border: 1px solid #c7c7c7;
}
.map_icons{
font-size: 24px;
color: white;
padding: 10px;
background-color: #43439999;
margin: 5px;
pointer-events: none;
}
.zone-add-btn, .zone-delete-btn, .zone-delete-all-btn {
cursor: pointer;
display: inline-block;
}
    .autocomplete-container {
      position: relative; /* Needed for absolute positioning of the results */
      font-family: sans-serif;
    }

    #autocomplete-input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box; /* Include padding and border in the element's total width and height */
    }

    .autocomplete-results {
      position: absolute; /* Position the results below the input */
      top: 100%; /* Place it just below the input */
      left: 0;
      width: 100%;
      background-color: #fff;
      border: 1px solid #ccc;
      border-top: none; /* Remove the top border to make it look connected */
      border-radius: 0 0 4px 4px; /* Round only the bottom corners */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
      z-index: 10; /* Ensure it's above other content */
      max-height: 200px; /* Limit the height of the dropdown */
      overflow-y: auto; /* Add a scrollbar if there are too many suggestions */
    }

    .autocomplete-results div {
      padding: 10px;
      cursor: pointer; /* Change the cursor to indicate it's clickable */
    }

    .autocomplete-results div:hover {
      background-color: #f0f0f0; /* Highlight on hover */
    }

    .autocomplete-results div + div {
      border-top: 1px solid #eee; /* Add a separator between suggestions */
    }
</style>

<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<div class="box">

<div class="box-header with-border">
<a href="{{ url('zone') }}">
<button class="btn btn-danger btn-sm pull-right" type="submit">
<i class="mdi mdi-keyboard-backspace mr-2"></i>
@lang('view_pages.back')
</button>
</a>
</div>
<div class="col-sm-12">
    <form  method="post" class="form-horizontal" action="{{url('zone/update',request()->id)}}" enctype="multipart/form-data" onsubmit="if(typeof syncCoordinatesInput==='function'){syncCoordinatesInput();}">
{{csrf_field()}}
<input type="hidden" id="info" name="coordinates" value="">

<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="zone_admin" class="">@lang('view_pages.select_area') <sup>*</sup></label>
<select name="admin_id" id="zone_admin" class="form-control" required>
<option value="" >@lang('view_pages.select_area')</option>
@foreach($services as $key=>$service)
 <option value="{{$service->id}}" {{ $service->id == $zone->service_location_id ? 'selected' : '' }}>{{$service->name}}</option>
@endforeach
</select>
</div>
</div>


<div class="col-sm-6">
<div class="form-group">
<label> @lang('view_pages.name') <sup>*</sup></label>
<input class="form-control" id="zone_name" type="text" name="zone_name" value="{{old('name',$zone->name)}}" placeholder="@lang('view_pages.enter_name')" required>
<span class="text-danger">{{ $errors->first('zone_name') }}</span>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label for="zone_admin" class="">@lang('view_pages.select_unit')<sup>*</sup></label>
<select name="unit" id="unit" class="form-control" required>
<option value="" selected disabled>@lang('view_pages.select_unit')</option>
<option value="1" {{ 1 == $zone->unit ? 'selected' : '' }}>Kilo-Meter</option>
<option value="2" {{ 2 == $zone->unit ? 'selected' : '' }}>Miles</option>
</select>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">


        <div class="autocomplete-container">

            <input id="autocomplete-input" class="form-control controls" onInput="handleInput()" type="text" placeholder="@lang('view_pages.search')" />
            <div id="autocomplete-results" class="autocomplete-results"></div>
        </div>

<div id="map" class="col-sm-10" style="float:left;"></div>

<div id="" class="col-sm-2" style="float:right;">
<div style="float:right;">
<p style="font-size:12px;color:#555;margin:0 0 8px;">Click + then tap the map to draw lines. Double-click to finish the zone.</p>
<ul style="list-style: none; padding-left: 0;">
<li>
<a id="select-button" href="javascript:void(0)" onclick="enableSelectTool(); return false;" class="btn-floating zone-add-btn btn-large waves-effect waves-light tooltipped" >
<i class="fa fa-hand-pointer-o map_icons"></i>
</a>
</li>

<li>
<a id="add-button" href="javascript:void(0)" onclick="enablePolygonTool(); return false;" class="btn-floating zone-add-btn btn-large waves-effect waves-light tooltipped" >
<i class="fa fa-plus-circle map_icons"></i>
</a>
</li>

<li>
<a id="delete-button" href="javascript:void(0)" onclick="deleteSelectedShape()" class="btn-floating zone-delete-btn btn-large waves-effect waves-light tooltipped" >
<i class="fa fa-times map_icons"></i>
</a>
</li>
<li>
<a id="delete-all-button" href="javascript:void(0)"  onclick="clearMap()" class="btn-floating zone-delete-all-btn btn-large waves-effect waves-light tooltipped" >
<i class="fa fa-trash-o map_icons"></i>
</a>
</li>

</ul>

</div>
</div>

</div>
</div>
<div class="form-group text-right m-b-0"><br>
<button id="save-button" class="btn btn-primary btn-sm m-5 pull-right" type="submit">
@lang('view_pages.update')
</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key={{get_settings('google_map_key')}}&libraries=geometry,places"></script>
<script src="{{asset('assets/js/polygon/zone-draw.js')}}?v=3"></script>

<script>
    function fetchAutocomplete() {

        const search = $('#autocomplete-input').val();
        if(search.length <= 3) {
            return;
        }
        const apiUrl = `https://places.googleapis.com/v1/places:autocomplete`;
        const headers = {
            "Content-Type": "application/json",
            "X-Goog-Api-Key": "{{get_settings('google_map_key')}}",
            "X-Goog-FieldMask": "suggestions.placePrediction.placeId,suggestions.placePrediction.place,suggestions.placePrediction.text",
        };
        const requestData = {
            input: search,
        };


        $.ajax({
            url: apiUrl,
            type:  'POST',
            headers: headers,
            data: JSON.stringify(requestData),
            success: function(result)
            {
                var HTML = '';
                result.suggestions
                    .filter(
                        (suggestion) => suggestion.placePrediction
                    )
                    .map((suggestion) => ({
                        placeId: suggestion.placePrediction.placeId,
                        formattedAddress: suggestion.placePrediction.text.text,
                    })).forEach((item)=> {

                        HTML+= `<div id=${item.placeId} class="autocomplete-item" onClick="selectSuggestion(this)">${item.formattedAddress}</div>`;
                    });
                $('#autocomplete-results').html(HTML);
            },
            error: function(error)
            {
                console.error(error);
                $('#autocomplete-results').html('');
            }
        });
    }
    function selectSuggestion(element) {
        const placeId = $(element).attr('id');

        const headers = {
            "X-Goog-Api-Key": "{{get_settings('google_map_key')}}",
            "X-Goog-FieldMask": "viewport,location",
        };

        $('#autocomplete-input').val('')
        $('#autocomplete-results').html('');
        $.ajax({
            url:  `https://places.googleapis.com/v1/places/${placeId}?fields=viewport,location`,
            headers: headers,
            success: function(data)
            {

                const position = new google.maps.LatLng(data.location.latitude, data.location.longitude );
                
                map.setCenter(position);

                if (data.viewport && data.viewport.high && data.viewport.low) {
                    const bounds = new google.maps.LatLngBounds(
                        new google.maps.LatLng(data.viewport.low.latitude, data.viewport.low.longitude),
                        new google.maps.LatLng(data.viewport.high.latitude, data.viewport.high.longitude),
                    );
                    
                    map.fitBounds(bounds);
                }else{
                    map.setZoom(15);
                }
            },
            error: function(error)
            {
                console.error(error);
            }
        });

    }
    var typing = false;
    function handleInput(){
        if (!typing) {
            setTimeout(function() {
                fetchAutocomplete();
                typing = false;
            }, 1000);
        }
        typing = true;
    }
</script>
    <script type="text/javascript">
        // cod jQuery

// activare tooltips
$('[data-toggle="tooltip"]').each(function() {
    var options = {
        html: true
    };
    // setari colorare tooltips
    if ($(this)[0].hasAttribute('data-type')) {
        options['template'] =
            '<div class="tooltip ' + $(this).attr('data-type') + '" role="tooltip">' +
            ' <div class="tooltip-arrow"></div>' +
            ' <div class="tooltip-inner"></div>' +
            '</div>';
    }

    $(this).tooltip(options);
});



//final cod JQuery



// inceput Javascript

// variabile globale
var map; // harta Google
var drawingManager; // obiectul care cuprinde majoritatea metodelor si proprietatilor necesare pentru desenare
var selectedShape; // ajuta la identificarea formei selectate
var selectedKernel; // ajuta la identificarea nucleului selectat
var gmarkers = []; // lista cu markerele care vor fi pozitionate in varfurile nucleului
var coordinates = []; // lista cu coordonatele varfurilor poligonului selectat
var infowindow = (typeof google !== 'undefined' && google.maps)
    ? new google.maps.InfoWindow()
    : null; // infowindow care apare cand se da click pe markere
var allShapes = []; // lista cu toate formele desenate pe harta - ajuta pentru stergerea lor in acelasi timp
var sendable_coordinates = []; // lista cu toate formele desenate pe harta - ajuta pentru stergerea lor in acelasi timp
var shapeColor = "#007cff"; // culoare forma desenata
var kernelColor = "#000"; // culoare nucleu
var default_lat = '{{$default_lat}}';
var default_lng = '{{$default_lng}}';
var data= '{{$zone_coordinates}}';
let zones = JSON.parse(data.replace(/&quot;/g,'"'));
// functie care copiaza textul primit ca parametru in clipboard
// Primeste ca parametri:
// text - document.getElementById('id-element').innerHTML,
// copymsg - document.getElementById('id-element')
function copyToClipboard(text, copymsg) {
    var temp = document.createElement('input');
    temp.type = 'input';
    temp.setAttribute('value', text);
    document.body.appendChild(temp);
    temp.select();
    document.execCommand("copy");
    temp.remove();
    copymsg.innerHTML = "Copiat în clipboard!"; // mesaj care se va afisa la executarea functiei
    setTimeout(function() { copymsg.innerHTML = "" }, 1000); // timp afisare mesaj
}


// schimba opacitatea containerului "opcard" atunci cand utilizatorul trece cursorul peste acest element
function changeOpacityHover() {
    var element = document.getElementById("opcard");
    element.classList.remove("ccard");
    element.classList.add("vcard");
}

// schimba opacitatea containerului "opcard" la forma initiala dupa ce cursorul nu se mai afla peste elementul "opcard"
function changeOpacityOut() {
    var element = document.getElementById("opcard");
    element.classList.remove("vcard");
    element.classList.add("ccard");
}

// Atribuie fiecarui marcator o harta
// parametrul "map" va fi trimis cu valoarea hartii Google sau cu "null"
function setMapOnAll(map) {
    for (var i = 0; i < gmarkers.length; i++) {
        gmarkers[i].setMap(map);
    }
}

// Ascunde toti marcatorii de pe harta
function clearMarkers() {
    setMapOnAll(null);
}


// Sterge toti marcatorii
function deleteMarkers() {
    clearMarkers();
    gmarkers = [];
}


// functie care sterge forma selectata
function deleteSelectedShape() {
    if (selectedShape) {
        selectedShape.setMap(null);
        var index = allShapes.indexOf(selectedShape);
        if (index > -1) {
            allShapes.splice(index, 1);
        }
        selectedShape = null;
        if (typeof syncCoordinatesInput === 'function') {
            syncCoordinatesInput();
        }
    }

    if (selectedKernel) {
        selectedKernel.setMap(null);
        selectedKernel = null;
    }
}



// functie care sterge toate formele de pe harta
function clearMap() {
    if (allShapes.length > 0) { // verific daca exista forme desenate

        for (var i = 0; i < allShapes.length; i++) // sterge toate formele
        {
            allShapes[i].setMap(null);
        }
        allShapes = [];
        deleteMarkers();
        document.getElementById('info').value = null;
        // document.getElementById('info').innerHTML = "Desenează un poligon. Aici vor apărea coordonatele vârfurilor sale și vor fi actualizate în timp real."; // actualizează lista de coordonate afisata

    }
}


// functie care seteaza culoarea formei selectate ca fiind cea aleasa de utilizator prin Color Picker

function update(picker) {
    shapeColor = picker.toHEXString();
    if (selectedShape) {
        selectedShape.setOptions({ fillColor: shapeColor });
    }
}



// a function that sets the color of the core selected as the one chosen by the user through the Color Picker
// function that cancels the current selection
function clearSelection() {
    if (selectedShape) { //check that the selected shape is a polygon
        if (selectedShape.type !== 'marker') {
            selectedShape.setEditable(false);
        }
        selectedShape = null;
    }

    if (selectedKernel) { // check to see if the selected shape is a core
        if (selectedKernel.type !== 'marker') {
            selectedKernel.setEditable(false);
        }
        selectedKernel = null;
    }
}

// function that selects a form and receives as parameters:
// shape - the form to be selected
// check - 0 = polygon, 1 = core
function setSelection(shape, check) {
    clearSelection();
    try {
        if (shape.setEditable) shape.setEditable(true);
        if (shape.setDraggable) shape.setDraggable(true);
    } catch (e) {}
    if (check) {
        selectedKernel = shape;
    } else { selectedShape = shape; }
}



//display function that saves in the list "coordinates" the coordinates of the points of the polygon given as parameter coordinates coordonatele varfurilor poligonului dat ca parametru
function getCoordinates(polygon) {
    var path = polygon.getPath();
    coordinates = [];
    for (var i = 0; i < path.length; i++) {
        coordinates.push({
            lat: path.getAt(i).lat(),
            lng: path.getAt(i).lng()
        });
    }
    return coordinates;
    // document.getElementById('info').value = coordinates;
}



// functie care creeaza un marker si primeste ca parametri
// coord = coordonatele unde va fi creat marker-ul
// nr = numarul marker-ului
// map = harta Google Maps
function createMarker(coord, nr, map) {
    var mesaj = "<h6>Vârf " + nr + "</h6><br>" + "Lat: " + coord.lat + "<br>" + "Lng: " + coord.lng;
    var marker = new google.maps.Marker({
        position: coord,
        map: map,
        //zIndex: Math.round(coord.lat * -100000) << 5
    });
    // displaying marker information at "click"
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(mesaj);
        infowindow.open(map, marker);
    });
    google.maps.event.addListener(marker, 'dblclick', function() { // delete marker at "double click"

        marker.setMap(null);
    });
    return marker;
}

// function that initializes the Google Maps, sets its options and calls other functions
function initMap() {
    var mapOptions = {
        zoom: 8,
        center: new google.maps.LatLng(default_lat, default_lng),
        mapTypeControl: false, // disabled
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            position: google.maps.ControlPosition.LEFT_CENTER
        },
        zoomControl: true,
        zoomControlOptions: {
            position: google.maps.ControlPosition.RIGHT_CENTER
        },
        scaleControl: false, // disabled
        scaleControlOptions: {
            position: google.maps.ControlPosition.RIGHT_CENTER
        },
        streetViewControl: false, // disabled
        fullscreenControl: false, // disabled
        clickableIcons: false,
        gestureHandling: 'greedy'
    };
    if (google.maps.RenderingType) {
        mapOptions.renderingType = google.maps.RenderingType.RASTER;
    }
    map = new google.maps.Map(document.getElementById('map'), mapOptions);

     var i;
    var polygon;
    for (i = 0; i < zones.length; i++) {
    polygon = new google.maps.Polygon({
        paths: zones[i],
        strokeWeight: 1,
        strokeColor:'#007cf',
        fillColor: '#007cff',
        fillOpacity: 0.4,
    });
      polygon.setMap(map);
    addNewPolys(polygon);
    allShapes.push(polygon); // save the form to the allShapes list
         google.maps.event.addListener(polygon, 'click', function(e) { getCoordinates(polygon); });
        google.maps.event.addListener(polygon, "dragend", function(e) {
            // console.log(polygon);
         console.log(getCoordinates(polygon));
            for (i=0; i < allShapes.length; i++) {   // Clear out the old allShapes entry
            if (polygon.getPath() == allShapes[i].getPath()) {
                allShapes.splice(i, 1);
            }
          }
          allShapes.push(polygon);
            let lat_lng = [];
    allShapes.forEach(function(data, index) {
        lat_lng[index] = getCoordinates(data);
    });

    console.log(lat_lng);
    document.getElementById('info').value = JSON.stringify(lat_lng);
    });
        google.maps.event.addListener(polygon.getPath(), "insert_at", function(e) {

            for (i=0; i < allShapes.length; i++) {   // Clear out the old allShapes entry
            if (polygon.getPath() == allShapes[i].getPath()) {
                allShapes.splice(i, 1);
            }
          }
          allShapes.push(polygon);
            let lat_lng = [];
    allShapes.forEach(function(data, index) {
        lat_lng[index] = getCoordinates(data);
    });

    document.getElementById('info').value = JSON.stringify(lat_lng);
          });
        google.maps.event.addListener(polygon.getPath(), "remove_at", function(e) { getCoordinates(polygon); });
        google.maps.event.addListener(polygon.getPath(), "set_at", function(e) { getCoordinates(polygon); });

    }

    let lat_lng = [];
    allShapes.forEach(function(data, index) {
        lat_lng[index] = getCoordinates(data);
    });

document.getElementById('info').value = JSON.stringify(lat_lng);

console.log("lat_lng");
console.log(lat_lng);
// console.log(allShapes);

    if (typeof setupCustomDrawing === 'function') {
        setupCustomDrawing();
    }
}

   function addNewPolys(newPoly) {
        google.maps.event.addListener(newPoly, 'click', function(e) {
            if (e && typeof e.stop === 'function') {
                e.stop();
            }
            setSelection(newPoly, 0);
        });
    }
// start application
function startZoneMap() {
    if (typeof google === 'undefined' || !google.maps || typeof initMap !== 'function') {
        return;
    }
    initMap();
}

if (document.readyState === 'complete') {
    startZoneMap();
} else if (typeof google !== 'undefined' && google.maps && google.maps.event) {
    google.maps.event.addDomListener(window, 'load', startZoneMap);
} else {
    window.addEventListener('load', startZoneMap);
}

    </script>

@elseif($value=="open_street")
<style>
    #map {
        height: 400px;
        width: 80%;
        left: 10px;
    }

    html, body {
        padding: 0;
        margin: 0;
        height: 100%;
    }

    #panel {
        width: 200px;
        font-family: Arial, sans-serif;
        font-size: 13px;
        float: right;
        margin: 10px;
        margin-top: 100px;
    }

    #delete-button, #add-button, #delete-all-button, #save-button {
        margin-top: 5px;
    }

    #search-box {
        background-color: #f7f7f7;
        font-size: 15px;
        font-weight: 300;
        margin-top: 10px;
        margin-bottom: 10px;
        margin-left: 10px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        height: 25px;
        width: 80%;
        border: 1px solid #c7c7c7;
    }

    .map_icons {
        font-size: 24px;
        color: white;
        padding: 10px;
        background-color: #43439999;
        margin: 5px;
    }
</style>


<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<div class="box">

<div class="box-header with-border">
    <a href="{{ url('zone') }}">
        <button class="btn btn-danger btn-sm pull-right" type="submit">
            <i class="mdi mdi-keyboard-backspace mr-2"></i>
            @lang('view_pages.back')
        </button>
    </a>
</div>

<div class="col-sm-12">
    <form method="post" class="form-horizontal" action="{{url('zone/update',request()->id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" id="coordinates" name="coordinates" value="{{$zone_coordinates}}">

        <input type="hidden" id="city_polygon" name="city_polygon" value="{{ old('city_polygon') }}">

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="zone_admin" class="">@lang('view_pages.select_area') <sup>*</sup></label>
                    <select name="admin_id" id="zone_admin" class="form-control" required>
                        <option value="">@lang('view_pages.select_area')</option>
                        @foreach($services as $key=>$service)
                        <option value="{{$service->id}}" {{ $zone->service_location_id == $service->id ? "selected" : "" }}>{{$service->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Other form fields -->

            <div class="col-sm-6">
                <div class="form-group">
                    <label> @lang('view_pages.name') <sup>*</sup></label>
                    <input class="form-control" id="zone_name" type="text" name="zone_name" value="{{ old('zone_name',$zone->name) }}" placeholder="@lang('view_pages.enter_name')" required>
                    <span class="text-danger">{{ $errors->first('zone_name') }}</span>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                <label for="zone_admin" class="">@lang('view_pages.select_unit') <sup>*</sup></label>
                <select name="unit" id="unit" class="form-control" required>
                <option value="" selected disabled>@lang('view_pages.select_unit')</option>
                <option value="1" {{ $zone->unit == 1 ? "selected" : "" }}>@lang('view_pages.kilo_meter')</option>
                <option value="2" {{ $zone->unit == 2 ? "selected" : "" }}>@lang('view_pages.miles')</option>
                </select>
                </div>
                </div>

            </div>
        </div>
        <div class="col-lg-12">
            <div id="map" class="col-sm-10" style="float:left;"></div>
        </div>
        <div class="col-lg-12">
            <span id="zoneErr" class="text-danger"></span>
        </div>

        <div class="form-group text-right m-b-0"><br>
            <button id="save-button" class="btn btn-primary btn-sm m-5 pull-right" type="submit">
                @lang('view_pages.save')
            </button>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>
</div>


<!-- Include Leaflet and Leaflet Draw JavaScript libraries -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

<script>
    function fetchAutocomplete() {

        const search = $('#autocomplete-input').val();
        if(search.length <= 3) {
            return;
        }
        const apiUrl = `https://places.googleapis.com/v1/places:autocomplete`;
        const headers = {
            "Content-Type": "application/json",
            "X-Goog-Api-Key": "{{get_settings('google_map_key')}}",
            "X-Goog-FieldMask": "suggestions.placePrediction.placeId,suggestions.placePrediction.place,suggestions.placePrediction.text",
        };
        const requestData = {
            input: search,
        };


        $.ajax({
            url: apiUrl,
            type:  'POST',
            headers: headers,
            data: JSON.stringify(requestData),
            success: function(result)
            {
                var HTML = '';
                result.suggestions
                    .filter(
                        (suggestion) => suggestion.placePrediction
                    )
                    .map((suggestion) => ({
                        placeId: suggestion.placePrediction.placeId,
                        formattedAddress: suggestion.placePrediction.text.text,
                    })).forEach((item)=> {

                        HTML+= `<div id=${item.placeId} class="autocomplete-item" onClick="selectSuggestion(this)">${item.formattedAddress}</div>`;
                    });
                $('#autocomplete-results').html(HTML);
            },
            error: function(error)
            {
                console.error(error);
                $('#autocomplete-results').html(HTML);
            }
        });
    }
    function selectSuggestion(element) {
        const placeId = $(element).attr('id');

        const headers = {
            "X-Goog-Api-Key": "{{get_settings('google_map_key')}}",
            "X-Goog-FieldMask": "viewport,location",
        };

        $('#autocomplete-input').val('')
        $('#autocomplete-results').html('');
        $.ajax({
            url:  `https://places.googleapis.com/v1/places/${placeId}?fields=viewport,location`,
            headers: headers,
            success: function(data)
            {

                const position = new google.maps.LatLng(data.location.latitude, data.location.longitude );
                
                map.setCenter(position);

                if (data.viewport && data.viewport.high && data.viewport.low) {
                    const bounds = new google.maps.LatLngBounds(
                        new google.maps.LatLng(data.viewport.low.latitude, data.viewport.low.longitude),
                        new google.maps.LatLng(data.viewport.high.latitude, data.viewport.high.longitude),
                    );
                    
                    map.fitBounds(bounds);
                }else{
                    map.setZoom(15);
                }
            },
            error: function(error)
            {
                console.error(error);
            }
        });

    }
    var typing = false;
    function handleInput(){
        if (!typing) {
            setTimeout(function() {
                fetchAutocomplete();
                typing = false;
            }, 1000);
        }
        typing = true;
    }
</script>
<script type="text/javascript">
  var default_lat = {{$default_lat}};
    var default_lng = {{$default_lng}};
    var zoneCoordinates= JSON.parse(document.getElementById('coordinates').value);
    var map = L.map('map').setView([default_lat, default_lng], 8); // Default view, will be updated with user's location
    var zoneErr = document.getElementById('zoneErr');

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Initialize Leaflet Draw plugin
    var drawnItems = new L.FeatureGroup();
    var polygons = [];

    zoneCoordinates.forEach((item) => {
        var polygon = L.polygon([item]).addTo(map);
        drawnItems.addLayer(polygon);
        map.fitBounds(polygon.getBounds());
        polygons.push(polygon);
    });

    // Fit the map to the polygon's bounds

    // Add a marker at the center of the polygon
    var polygonCenter = polygons[0].getCenter();


    map.addLayer(drawnItems);
    var drawControl = new L.Control.Draw({
        draw: {
            polygon: true,
            polyline: false,
            circle: false,
            marker: false,
            circlemarker: false
        },
        edit: {
            featureGroup: drawnItems,
            edit: true,
            remove: true
        }
    });
    map.addControl(drawControl);

    map.on('draw:created', function (e) {
        var layer = e.layer;
        overlaps = false;
        var overlaps = is_overlap(layer);

        if (!overlaps) {
            drawnItems.addLayer(layer);
            updateCoordinates();
            zoneErr.innerHTML =  '';
        } else {
            zoneErr.innerHTML =  'Zone overlaps with existing zone.';
        }
    });
    function is_overlap(layer) {
        var overlaps = false;

        var layerGeoJson = layer.toGeoJSON();


        drawnItems.eachLayer(function (existingLayer) {
            if (layer.getBounds().intersects(existingLayer.getBounds())) {
                overlaps = true;
                return false; // Stop iterating if overlap found
            }
        });

        return overlaps;
    }

    map.on('draw:edited', function (e) {
        var overlaps = false;

        e.layers.eachLayer(function (layer) {
          if (is_overlap(layer)) {
            overlaps = is_overlap(layer);
          }
        });
        if (!overlaps) {
            updateCoordinates();
            zoneErr.innerHTML = '';
        } else {
            zoneErr.innerHTML = 'Zone overlaps with existing zone.';
        }
    });


    // Get user's location and update the map view
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            map.setView([lat, lng], 8); // Set the map view to user's location
        }, function (error) {
            console.error('Error getting user location:', error);
            alert('Error getting your location. Please allow location access.');
        });
    } else {
        alert('Geolocation is not supported by your browser.');
    }

      map.on('draw:deleted', function (e) {
          updateCoordinates(); // Call to update coordinates when polygons are removed
      });

    // Function to update coordinates input field
    function updateCoordinates() {
        var coordinates = [];
        var all_coordinates = [];
        drawnItems.eachLayer(function (layer) {
            var latLngs = layer.getLatLngs();
            coordinates = coordinates.concat(latLngs.flat());
        });
        all_coordinates = [coordinates];
        var coordinatesInput = document.getElementById('coordinates');
        coordinatesInput.value = JSON.stringify(all_coordinates);
    }
    updateCoordinates();
</script>


@endif




@endsection

