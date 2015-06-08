<html>
<head>
    <meta charset="utf-8">
    <title>Marker animations with <code>setTimeout()</code></title>
    <style>
        #panel {
            position: absolute;
            top: 5px;
            left: 50%;
            margin-left: -180px;
            z-index: 5;
            background-color: transparent;
            padding: 5px;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>
        // If you're adding a number of markers, you may want to drop them on the map
        // consecutively rather than all at once. This example shows how to use
        // window.setTimeout() to space your markers' animation.



        var berlin = new google.maps.LatLng(52.520816, 13.410186);

        var neighborhoods = [
            new google.maps.LatLng(52.511467, 13.447179),
            new google.maps.LatLng(52.549061, 13.422975),
            new google.maps.LatLng(52.497622, 13.396110),
            new google.maps.LatLng(52.517683, 13.394393)
        ];

        var markers = [];
        var map;

        function initialize() {
            var mapOptions = {
                zoom: 12,
                center: berlin
            };

            map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);
        }

        function drop() {
            clearMarkers();
            for (var i = 0; i < neighborhoods.length; i++) {
                addMarkerWithTimeout(neighborhoods[i], i * 200);
            }
        }

        function addMarkerWithTimeout(position, timeout) {
            window.setTimeout(function() {
                markers.push(new google.maps.Marker({
                    position: position,
                    map: map,
                    animation: google.maps.Animation.DROP
                }));
            }, timeout);
        }

        function clearMarkers() {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            markers = [];
        }

        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
</head>
<body>
<div id="panel" style="margin-left: -52px">
    <button id="drop" onclick="drop()">Drop Markers</button>
</div>
<div style="width: 900px;height: 600px;" id="map-canvas"></div>
</body>
</html>