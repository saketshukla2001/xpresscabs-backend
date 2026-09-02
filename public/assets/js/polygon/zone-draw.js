var isDrawing = false;
var drawPath = [];
var drawPolyline = null;
var drawMarkers = [];
var rubberLine = null;
var mapClickListener = null;
var mapDblClickListener = null;
var mapMoveListener = null;

function setToolbarActive(id) {
    ['select-button', 'add-button'].forEach(function (btnId) {
        var el = document.getElementById(btnId);
        if (!el) return;
        var icon = el.querySelector('.map_icons');
        if (icon) {
            icon.style.backgroundColor = (btnId === id) ? '#2b2b8a' : '#43439999';
        }
    });
}

function syncCoordinatesInput() {
    var info = document.getElementById('info');
    if (!info) return;
    var latLng = [];
    allShapes.forEach(function (shape, index) {
        latLng[index] = getCoordinates(shape);
    });
    info.value = latLng.length ? JSON.stringify(latLng) : '';
}

function cancelInProgressDrawing() {
    drawPath = [];
    if (drawPolyline) {
        drawPolyline.setMap(null);
        drawPolyline = null;
    }
    if (rubberLine) {
        rubberLine.setMap(null);
        rubberLine = null;
    }
    drawMarkers.forEach(function (marker) {
        marker.setMap(null);
    });
    drawMarkers = [];
}

function enableSelectTool() {
    isDrawing = false;
    cancelInProgressDrawing();
    if (map) {
        map.setOptions({
            draggableCursor: null,
            draggingCursor: null,
            disableDoubleClickZoom: false
        });
    }
    setToolbarActive('select-button');
}

function enablePolygonTool() {
    isDrawing = true;
    clearSelection();
    cancelInProgressDrawing();
    if (map) {
        map.setOptions({
            draggableCursor: 'crosshair',
            draggingCursor: 'crosshair',
            disableDoubleClickZoom: true
        });
    }
    setToolbarActive('add-button');
}

function attachShapeListeners(shape) {
    addNewPolys(shape);
    google.maps.event.addListener(shape, 'dragend', syncCoordinatesInput);
    google.maps.event.addListener(shape.getPath(), 'insert_at', syncCoordinatesInput);
    google.maps.event.addListener(shape.getPath(), 'remove_at', syncCoordinatesInput);
    google.maps.event.addListener(shape.getPath(), 'set_at', syncCoordinatesInput);
}

function completeDrawnPolygon() {
    if (drawPath.length < 3) {
        return false;
    }

    var shape = new google.maps.Polygon({
        paths: drawPath.slice(),
        strokeWeight: 2,
        strokeColor: shapeColor,
        fillColor: shapeColor,
        fillOpacity: 0.4,
        editable: true,
        draggable: true,
        clickable: true,
        map: map
    });

    allShapes.push(shape);
    attachShapeListeners(shape);
    syncCoordinatesInput();
    cancelInProgressDrawing();
    isDrawing = false;
    if (map) {
        map.setOptions({
            draggableCursor: null,
            draggingCursor: null,
            disableDoubleClickZoom: false
        });
    }
    setSelection(shape, 0);
    setToolbarActive('select-button');
    return true;
}

function addDrawVertex(latLng) {
    if (drawPath.length >= 3) {
        var first = drawPath[0];
        var firstPx = fromLatLngToPixel(first);
        var clickPx = fromLatLngToPixel(latLng);
        if (firstPx && clickPx) {
            var dx = firstPx.x - clickPx.x;
            var dy = firstPx.y - clickPx.y;
            if ((dx * dx + dy * dy) <= 100) {
                completeDrawnPolygon();
                return;
            }
        }
    }

    drawPath.push(latLng);

    if (!drawPolyline) {
        drawPolyline = new google.maps.Polyline({
            path: drawPath,
            strokeColor: shapeColor,
            strokeWeight: 2,
            map: map,
            clickable: false
        });
    } else {
        drawPolyline.setPath(drawPath);
    }

    var isFirst = drawPath.length === 1;
    var marker = null;
    try {
        marker = new google.maps.Marker({
            position: latLng,
            map: map,
            clickable: isFirst,
            icon: {
                path: google.maps.SymbolPath.CIRCLE,
                scale: isFirst ? 7 : 5,
                fillColor: '#ffffff',
                fillOpacity: 1,
                strokeColor: shapeColor,
                strokeWeight: 2
            }
        });
    } catch (e) {
        marker = new google.maps.Marker({
            position: latLng,
            map: map,
            clickable: isFirst
        });
    }

    if (isFirst && marker) {
        google.maps.event.addListener(marker, 'click', function () {
            if (isDrawing && drawPath.length >= 3) {
                completeDrawnPolygon();
            }
        });
    }

    if (marker) {
        drawMarkers.push(marker);
    }
}

function fromLatLngToPixel(latLng) {
    if (!map || !map.getProjection) {
        return null;
    }
    var projection = map.getProjection();
    if (!projection) {
        return null;
    }
    var bounds = map.getBounds();
    if (!bounds) {
        return null;
    }
    var topRight = projection.fromLatLngToPoint(bounds.getNorthEast());
    var bottomLeft = projection.fromLatLngToPoint(bounds.getSouthWest());
    var scale = Math.pow(2, map.getZoom());
    var worldPoint = projection.fromLatLngToPoint(latLng);
    return {
        x: (worldPoint.x - bottomLeft.x) * scale,
        y: (worldPoint.y - topRight.y) * scale
    };
}

function onMapClickForZone(e) {
    if (isDrawing) {
        addDrawVertex(e.latLng);
        return;
    }
    clearSelection();
}

function onMapDblClickForZone(e) {
    if (!isDrawing) {
        return;
    }
    if (e && typeof e.stop === 'function') {
        e.stop();
    }
    completeDrawnPolygon();
}

function onMapMouseMoveForZone(e) {
    if (!isDrawing || drawPath.length === 0) {
        if (rubberLine) {
            rubberLine.setMap(null);
            rubberLine = null;
        }
        return;
    }
    var preview = drawPath.concat([e.latLng]);
    if (!rubberLine) {
        rubberLine = new google.maps.Polyline({
            path: preview,
            strokeColor: shapeColor,
            strokeOpacity: 0.55,
            strokeWeight: 2,
            map: map,
            clickable: false
        });
    } else {
        rubberLine.setPath(preview);
    }
}

function bindZoneToolbarButtons() {
    var selectButton = document.getElementById('select-button');
    var addButton = document.getElementById('add-button');
    var deleteButton = document.getElementById('delete-button');
    var deleteAllButton = document.getElementById('delete-all-button');

    if (selectButton) {
        selectButton.onclick = function (e) {
            e.preventDefault();
            enableSelectTool();
            return false;
        };
    }
    if (addButton) {
        addButton.onclick = function (e) {
            e.preventDefault();
            enablePolygonTool();
            return false;
        };
    }
    if (deleteButton) {
        deleteButton.onclick = function (e) {
            e.preventDefault();
            deleteSelectedShape();
            syncCoordinatesInput();
            return false;
        };
    }
    if (deleteAllButton) {
        deleteAllButton.onclick = function (e) {
            e.preventDefault();
            cancelInProgressDrawing();
            isDrawing = false;
            clearMap();
            syncCoordinatesInput();
            return false;
        };
    }
}

function setupCustomDrawing() {
    if (mapClickListener) {
        google.maps.event.removeListener(mapClickListener);
    }
    if (mapDblClickListener) {
        google.maps.event.removeListener(mapDblClickListener);
    }
    if (mapMoveListener) {
        google.maps.event.removeListener(mapMoveListener);
    }

    mapClickListener = google.maps.event.addListener(map, 'click', onMapClickForZone);
    mapDblClickListener = google.maps.event.addListener(map, 'dblclick', onMapDblClickForZone);
    mapMoveListener = google.maps.event.addListener(map, 'mousemove', onMapMouseMoveForZone);
    bindZoneToolbarButtons();
    setToolbarActive('select-button');
}
