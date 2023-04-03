@extends('views.layouts.main')

@section('content')
    <main class="main">
        @include('views.location.header')
        <div class="container">
            @include('views.partials.breadcrumbs')
        </div>

        <section class="light-grey-bg ">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div id="map_canvas" style="width: 100%;; height: 330px"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="location-search">
                            <div class="location-search-label">
                                <span>Enter a City to find your National Service Office or Chapter</span>
                            </div>
                            <div class="location-search-box">
                                <input id="pac-input" class="controls" type="text" placeholder="Enter City">
                            </div>
                        </div>
                    </div>

                    <script>
                        var gmarkers = [];
var marker;
// create the map
var myOptions = {
    center: new google.maps.LatLng(38.9005326, -77.0436805),
    zoom: 6,
    mapTypeId: google.maps.MapTypeId.ROADMAP
};
var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);


function initialize() {
    // if (navigator.geolocation) {
    // navigator.geolocation.getCurrentPosition(function showPosition(position) {
    //x.innerHTML = "Latitude: " + position.coords.latitude +
    /// "<br>Longitude: " + position.coords.longitude;
    // });
    //}

    google.maps.event.addListener(map, 'click', function() {
        infowindow.close();
    });

    var isCreated = locationMarker();

    if(isCreated)
    {
        var markerCluster = new MarkerClusterer(map, gmarkers, {imagePath: '{{public_path('images')}}/m'});
    }

    initSearchBox(map, 'pac-input');
}
var infowindow = new google.maps.InfoWindow({
    size: new google.maps.Size(150, 50)
});

// This function picks up the click and opens the corresponding info window
function myclick(i) {
    google.maps.event.trigger(gmarkers[i], "click");

}

function initSearchBox(map, controlId) {
    // Create the search box and link it to the UI element.
    var input = (document.getElementById(controlId));

    var searchBox = new google.maps.places.SearchBox(input);

    // [START region_getplaces]
    // Listen for the event fired when the user selects an item from the
    // pick list. Retrieve the matching places for that item.
    google.maps.event.addListener(searchBox, 'places_changed', function() {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }
        //get first place
        var place = places[0];
        var infowindow = new google.maps.InfoWindow({
            size: new google.maps.Size(150, 50),
            content: place.info
        });
        map.fitBounds(place.geometry.viewport);

        //prevent postback
        return false;
    });
}



// A function to create the marker and set up the event window function
function createMarker(latlng, name, html) {
    contentString = html;
    var marker = new google.maps.Marker({
        title: name,
        summary: html,
        position: latlng,
        map: map
    });

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

    // save the info we need to use later for the side_bar
    gmarkers.push(marker);

}
google.maps.event.addListenerOnce(map, 'idle', initialize);

google.maps.event.addListener(map, 'idle', function() {
    var current_marker;
    var side_bar_html = '';
    document.getElementsByClassName("side_bar").innerHTML = '';
    google.maps.event.addListener(map, 'idle', function() {
        bounds = map.getBounds();
        var pinsFound = 0;
        for (i = 0, l = gmarkers.length; i < l; i++) {

            current_marker = gmarkers[i];
            if (bounds.contains(current_marker.getPosition())) {
                pinsFound++;
                /* Only add a list item if it doesnt already exist. This is so that
                 * if the browser is resized or the tablet or phone is rotated, we dont
                 * have multiple results.
                 */
                // if (0 === document.getElementById('map-marker-' + i).length) {
                side_bar_html += '<div class="col-md-4 location-column">' + current_marker.summary + '</div>';

                //  }

            }


        }
        if(pinsFound==0){
            var zoom = map.getZoom()-1;
            map.setZoom(zoom);
        }
        else{
            document.getElementById("side_bar").innerHTML = side_bar_html;
        }
    });
});

function locationMarker () {
    


  point = new google.maps.LatLng(32.3757256,-86.2456195);
  marker = createMarker(point,"Paralyzed Veterans of America Montgomery VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Montgomery VA Regional Office</span><span class='location-address'>345 Perry Hill Road, Rm. 1-123</span><span class='location-city'>Montgomery</span><span class='location-state'>AL,</span><span class='location-zip'>36109</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/32.3757256,-86.2456195' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3342133433'>334-213-3433</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:lakishaa@pva.org'>lakishaa@pva.org</a></div>");

  point = new google.maps.LatLng(33.4871595,-112.0732533);
  marker = createMarker(point,"Paralyzed Veterans of America Phoenix VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Phoenix VA Regional Office</span><span class='location-address'>3333 North Central Avenue, Suite 1055</span><span class='location-city'>Phoenix</span><span class='location-state'>AZ,</span><span class='location-zip'>85012-2402</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/33.4871595,-112.0732533' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:6026273311'>602-627-3311</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:michaelw@pva.org '>michaelw@pva.org </a></div>");

  point = new google.maps.LatLng(34.7743815,-92.2958307);
  marker = createMarker(point,"Paralyzed Veterans of America Little Rock VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Little Rock VA Regional Office</span><span class='location-address'>2200 Fort Roots Drive, Bldg. 65, Rm. 116</span><span class='location-city'>N. Little Rock</span><span class='location-state'>AR,</span><span class='location-zip'>72114</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/34.7743815,-92.2958307' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:5013703757'>501-370-3757</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:clyder@pva.org'>clyder@pva.org</a></div>");

  point = new google.maps.LatLng(33.777569,-118.1189428);
  marker = createMarker(point,"Long Beach SCI Paralyzed Veterans of America", "<span class='location-heading'>Long Beach SCI Paralyzed Veterans of America</span><span class='location-address'>Tibor Rubin VAMC, Bldg. 150 5901 E. 7th Street, Rm. T-133</span><span class='location-city'>Long Beach</span><span class='location-state'>CA,</span><span class='location-zip'>90822</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/33.777569,-118.1189428' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:5628268000,13774'>562-826-8000 Ext: 13774</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:enriquec@pva.org'>enriquec@pva.org</a></div>");

  point = new google.maps.LatLng(33.76792,-118.199845);
  marker = createMarker(point,"Paralyzed Veterans of America Voc Rehab Office", "<span class='location-heading'>Paralyzed Veterans of America Voc Rehab Office</span><span class='location-address'>1 World Trade Center, 8th Floo</span><span class='location-city'>Long Beach</span><span class='location-state'>CA,</span><span class='location-zip'>90831</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/33.76792,-118.199845' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:5626764347,860'>562-676-4347 Ext: 860</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:laurenl@pva.org'>laurenl@pva.org</a></div>");

  point = new google.maps.LatLng(34.0562625,-118.4484035);
  marker = createMarker(point,"Paralyzed Veterans of America Los Angeles VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Los Angeles VA Regional Office</span><span class='location-address'>Fed. Bldg, Rm. 508, 11000 Wilshire Blvd</span><span class='location-city'>Los Angeles</span><span class='location-state'>CA,</span><span class='location-zip'>90024</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/34.0562625,-118.4484035' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3102357796'>310-235-7796</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:sharonp@pva.org'>sharonp@pva.org</a></div>");

  point = new google.maps.LatLng(37.4054073,-122.1400089);
  marker = createMarker(point,"Paralyzed Veterans of America Palo Alto Va Medical Center, SCI Service (128)", "<span class='location-heading'>Paralyzed Veterans of America Palo Alto Va Medical Center, SCI Service (128)</span><span class='location-address'>3801 Miranda Avenue</span><span class='location-city'>Palo Alto</span><span class='location-state'>CA,</span><span class='location-zip'>94304-1290</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/37.4054073,-122.1400089' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:6504935000,65046'>650-493-5000 Ext: 65046</a></div>");

  point = new google.maps.LatLng(38.5916043,-121.2773894);
  marker = createMarker(point,"Sacramento Paralyzed Veterans of America (71)", "<span class='location-heading'>Sacramento Paralyzed Veterans of America (71)</span><span class='location-address'>3046 Prospect Park Drive Room 120</span><span class='location-city'>Rancho Cordova</span><span class='location-state'>CA,</span><span class='location-zip'>95670</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/38.5916043,-121.2773894' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:9163646791'>916-364-6791</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:aliceb@pva.org'>aliceb@pva.org</a></div>");

  point = new google.maps.LatLng(32.7768732,-117.1409518);
  marker = createMarker(point,"San Diego Paralyzed Veterans of America", "<span class='location-heading'>San Diego Paralyzed Veterans of America</span><span class='location-address'>8810 Rio San Diego Drive, Suite 1121</span><span class='location-city'>San Diego</span><span class='location-state'>CA,</span><span class='location-zip'>92108</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/32.7768732,-117.1409518' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:6194005320'>619-400-5320</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:robertk@pva.org'>robertk@pva.org</a></div>");

  point = new google.maps.LatLng(32.8746054,-117.2318344);
  marker = createMarker(point,"San Diego PVA SCI Office, VAMC", "<span class='location-heading'>San Diego PVA SCI Office, VAMC</span><span class='location-address'>Bldg. 11, Room 1-A-114 3350 LaJolla Village Drive</span><span class='location-city'>San Diego</span><span class='location-state'>CA,</span><span class='location-zip'>92161</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/32.8746054,-117.2318344' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:8585527519'>858-552-7519</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:demarlonp@pva.org'>demarlonp@pva.org</a></div>");

  point = new google.maps.LatLng(33.1265509,-117.0946694);
  marker = createMarker(point,"PVA San Diego Voc Rehab", "<span class='location-heading'>PVA San Diego Voc Rehab</span><span class='location-address'>649 W. Mission Avenue</span><span class='location-city'>Escondido</span><span class='location-state'>CA,</span><span class='location-zip'>92025</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/33.1265509,-117.0946694' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:(202) 7338807'>(202) 733-8807</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:taylors@pva.org'>taylors@pva.org</a></div>");

  point = new google.maps.LatLng(39.7167587,-105.1374278);
  marker = createMarker(point,"Paralyzed Veterans of America Denver VARO", "<span class='location-heading'>Paralyzed Veterans of America Denver VARO</span><span class='location-address'>155 Van Gordon, Suite 202</span><span class='location-city'>Lakewood</span><span class='location-state'>CO,</span><span class='location-zip'>80228</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/39.7167587,-105.1374278' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3039145590'>303-914-5590</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:marcor@pva.org'>marcor@pva.org</a></div>");

  point = new google.maps.LatLng(39.7428839,-104.8298345);
  marker = createMarker(point,"Denver SCI Paralyzed Veterans of America Eastern Colorado Health Care System", "<span class='location-heading'>Denver SCI Paralyzed Veterans of America Eastern Colorado Health Care System</span><span class='location-address'>1700 N Wheeling ST K1-1-11SC</span><span class='location-city'>Aurora</span><span class='location-state'>CO,</span><span class='location-zip'>80045</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/39.7428839,-104.8298345' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7207233127'>720-723-3127</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:jonis@pva.org'>jonis@pva.org</a></div>");

  point = new google.maps.LatLng(39.7402063,-75.6065325);
  marker = createMarker(point,"Paralyzed Veterans of America VAMRO", "<span class='location-heading'>Paralyzed Veterans of America VAMRO</span><span class='location-address'>Room 26 1601 Kirkwood Highway</span><span class='location-city'>Wilmington</span><span class='location-state'>DE,</span><span class='location-zip'>19805</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/39.7402063,-75.6065325' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2027095551'>202-709-5551</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:dawns@pva.org'>dawns@pva.org</a></div>");

  point = new google.maps.LatLng(38.901643,-77.0169534);
  marker = createMarker(point,"National Appeals OfficeParalyzed Veterans of America Appellate Services Office", "<span class='location-heading'>National Appeals OfficeParalyzed Veterans of America Appellate Services Office</span><span class='location-address'>425 Eye Street, N.W. - Room 2W210</span><span class='location-city'>Washington</span><span class='location-state'>DC,</span><span class='location-zip'>20001</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/38.901643,-77.0169534' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2026324746'>202-632-4746</a></div>");

  point = new google.maps.LatLng(30.1818772,-82.6357008);
  marker = createMarker(point,"Lake City Paralyzed Veterans of America North Florida/South Georgia Veterans Health Care System", "<span class='location-heading'>Lake City Paralyzed Veterans of America North Florida/South Georgia Veterans Health Care System</span><span class='location-address'>619 S. Marion Ave. (Room 115-62)</span><span class='location-city'>Lake City</span><span class='location-state'>FL,</span><span class='location-zip'>32025-5808</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/30.1818772,-82.6357008' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3867553016,392236'>386-755-3016 Ext: 392236</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:earnesth@pva.org'>earnesth@pva.org</a></div>");

  point = new google.maps.LatLng(25.7914998,-80.2162924);
  marker = createMarker(point,"Paralyzed Veterans of America Miami VAMC SCI Service 128", "<span class='location-heading'>Paralyzed Veterans of America Miami VAMC SCI Service 128</span><span class='location-address'>1201 N.W. 16th Street, Room 1C139</span><span class='location-city'>Miami</span><span class='location-state'>FL,</span><span class='location-zip'>33125</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/25.7914998,-80.2162924' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3055757180'>305-575-7180</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:raula@pva.org'>raula@pva.org</a></div>");

  point = new google.maps.LatLng(28.36525,-81.2749461);
  marker = createMarker(point,"Paralyzed Veterans of America Orlando VAMC", "<span class='location-heading'>Paralyzed Veterans of America Orlando VAMC</span><span class='location-address'>13800 Veterans Way, Room 1N402</span><span class='location-city'>Orlando</span><span class='location-state'>FL,</span><span class='location-zip'>32827</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/28.36525,-81.2749461' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:4076311835 '>407-631-1835 </a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:davidr@pva.org'>davidr@pva.org</a></div>");

  point = new google.maps.LatLng(27.8125168,-82.771961);
  marker = createMarker(point,"St. Petersburg Paralyzed Veterans of America VA Regional Office", "<span class='location-heading'>St. Petersburg Paralyzed Veterans of America VA Regional Office</span><span class='location-address'>9500 Bay Pines Blvd., Room 227</span><span class='location-city'>Bay Pines</span><span class='location-state'>FL,</span><span class='location-zip'>33744</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/27.8125168,-82.771961' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7273197470'>727-319-7470</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:williamk@pva.org'>williamk@pva.org</a></div>");

  point = new google.maps.LatLng(28.0654077,-82.4265111);
  marker = createMarker(point,"Tampa SCI Paralyzed Veterans of America Tampa VA Medical Center", "<span class='location-heading'>Tampa SCI Paralyzed Veterans of America Tampa VA Medical Center</span><span class='location-address'>13000 Bruce B. Downs Blvd, Rm. CO52-38</span><span class='location-city'>Tampa</span><span class='location-state'>FL,</span><span class='location-zip'>33612</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/28.0654077,-82.4265111' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:8139785841'>813-978-5841</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:gabriellem@pva.org'>gabriellem@pva.org</a></div>");

  point = new google.maps.LatLng(28.0654077,-82.4265111);
  marker = createMarker(point,"Tampa Voc RehabParalyzed Veterans of America", "<span class='location-heading'>Tampa Voc RehabParalyzed Veterans of America</span><span class='location-address'>13000 Bruce B. Downs Blvd, CO51-38</span><span class='location-city'>Tampa</span><span class='location-state'>FL,</span><span class='location-zip'>33612</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/28.0654077,-82.4265111' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:8139722000'>813-972-2000</a></div>");

  point = new google.maps.LatLng(33.8038625,-84.3113042);
  marker = createMarker(point,"Paralyzed Veterans of America Atlanta VARO", "<span class='location-heading'>Paralyzed Veterans of America Atlanta VARO</span><span class='location-address'>1700 Clairmont Road</span><span class='location-city'>Decatur</span><span class='location-state'>GA,</span><span class='location-zip'>30033-4032</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/33.8038625,-84.3113042' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:4049295333'>404-929-5333</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:mitchell@pva.org'>mitchell@pva.org</a></div>");

  point = new google.maps.LatLng(34.0207125,-84.4647849);
  marker = createMarker(point,"Atlanta, GA Voc Rehab Veterans Career Program Atlanta Voc Rehab", "<span class='location-heading'>Atlanta, GA Voc Rehab Veterans Career Program Atlanta Voc Rehab</span><span class='location-address'>2901 Barbara Lane Marietta</span><span class='location-city'>Atlanta</span><span class='location-state'>GA,</span><span class='location-zip'>30062</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/34.0207125,-84.4647849' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2023048544'>202-304-8544</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:geniah@pva.org'>geniah@pva.org</a></div>");

  point = new google.maps.LatLng(33.4733107,-81.9877395);
  marker = createMarker(point,"Augusta SCI Charles Norwood VAMC Downtown Division", "<span class='location-heading'>Augusta SCI Charles Norwood VAMC Downtown Division</span><span class='location-address'>950 15th Street, Room 2C-100</span><span class='location-city'>Augusta</span><span class='location-state'>GA,</span><span class='location-zip'>30901</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/33.4733107,-81.9877395' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7068232219'>706-823-2219</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:jennifera@pva.org'>jennifera@pva.org</a></div>");

  point = new google.maps.LatLng(41.8696874,-87.6794573);
  marker = createMarker(point,"Paralyzed Veterans of America Chicago VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Chicago VA Regional Office</span><span class='location-address'>2122 W. Taylor Street, Room 126</span><span class='location-city'>Chicago</span><span class='location-state'>IL,</span><span class='location-zip'>60612</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/41.8696874,-87.6794573' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3129804278'>312-980-4278</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:roberts@pva.org'>roberts@pva.org</a></div>");

  point = new google.maps.LatLng(41.8610512,-87.8411362);
  marker = createMarker(point,"Chicago Voc Rehab Paralyzed Veterans of America Voc Rehab Edwards Hines, Jr. VA Hospital", "<span class='location-heading'>Chicago Voc Rehab Paralyzed Veterans of America Voc Rehab Edwards Hines, Jr. VA Hospital</span><span class='location-address'>5000 South 5th Avenue, Building 128, Room C-147</span><span class='location-city'>Hines</span><span class='location-state'>IL,</span><span class='location-zip'>60141</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/41.8610512,-87.8411362' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7082025832'>708-202-5832</a></div>");

  point = new google.maps.LatLng(41.8610512,-87.8411362);
  marker = createMarker(point,"Hines SCI Paralyzed Veterans of America Edward J. Hines VA Hospital", "<span class='location-heading'>Hines SCI Paralyzed Veterans of America Edward J. Hines VA Hospital</span><span class='location-address'>5000 S. 5th Ave., Bldg. 1, Room F-214</span><span class='location-city'>Hines</span><span class='location-state'>IL,</span><span class='location-zip'>60141</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/41.8610512,-87.8411362' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7082025623'>708-202-5623</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:winstonw@pva.org'>winstonw@pva.org</a></div>");

  point = new google.maps.LatLng(39.7747274,-86.1552244);
  marker = createMarker(point,"Paralyzed Veterans of America Indianapolis VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Indianapolis VA Regional Office</span><span class='location-address'>575 N. Pennsylvania St., Room 313</span><span class='location-city'>Indianapolis</span><span class='location-state'>IN,</span><span class='location-zip'>46204</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/39.7747274,-86.1552244' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3179163626'>317-916-3626</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:jamip@pva.org'>jamip@pva.org</a></div>");

  point = new google.maps.LatLng(41.5863737,-93.620118);
  marker = createMarker(point,"Paralyzed Veterans of America Des Moines VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Des Moines VA Regional Office</span><span class='location-address'>210 Walnut St., Room 563</span><span class='location-city'>Des Moines</span><span class='location-state'>IA,</span><span class='location-zip'>50309</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/41.5863737,-93.620118' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:5153237544'>515-323-7544</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:gustavog@pva.org '>gustavog@pva.org </a></div>");

  point = new google.maps.LatLng(37.6812131,-97.2746735);
  marker = createMarker(point,"Wichita Paralyzed Veterans of America Robert J. Dole VAM&ROC", "<span class='location-heading'>Wichita Paralyzed Veterans of America Robert J. Dole VAM&ROC</span><span class='location-address'>5500 E. Kellogg, Building 61, Room 109</span><span class='location-city'>Wichita</span><span class='location-state'>KS,</span><span class='location-zip'>67218</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/37.6812131,-97.2746735' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3166886810'>316-688-6810</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:markst@pva.org'>markst@pva.org</a></div>");

  point = new google.maps.LatLng(38.2568864,-85.7553138);
  marker = createMarker(point,"Paralyzed Veterans of America Louisville VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Louisville VA Regional Office</span><span class='location-address'>321 W. Main St., Suite 390</span><span class='location-city'>Louisville</span><span class='location-state'>KY,</span><span class='location-zip'>40202</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/38.2568864,-85.7553138' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:5025664430'>502-566-4430</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:jessicad@pva.org'>jessicad@pva.org</a></div>");

  point = new google.maps.LatLng(29.9507683,-90.0767572);
  marker = createMarker(point,"New Orleans Paralyzed Veterans of America New Orleans VA Regional Office", "<span class='location-heading'>New Orleans Paralyzed Veterans of America New Orleans VA Regional Office</span><span class='location-address'>1250 Poydras St., Suite 607</span><span class='location-city'>New Orleans</span><span class='location-state'>LA,</span><span class='location-zip'>70113</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/29.9507683,-90.0767572' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:5046194380'>504-619-4380</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:shelindah@pva.org'>shelindah@pva.org</a></div>");

  point = new google.maps.LatLng(44.2798615,-69.7052015);
  marker = createMarker(point,"Togus Paralyzed Veterans of America", "<span class='location-heading'>Togus Paralyzed Veterans of America</span><span class='location-address'>1 VA Center, Bldg. 248, Room 112</span><span class='location-city'>Augusta</span><span class='location-state'>ME,</span><span class='location-zip'>4330</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/44.2798615,-69.7052015' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2076217394'>207-621-7394</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:sonjac@pva.org'>sonjac@pva.org</a></div>");

  point = new google.maps.LatLng(39.2880994,-76.6167868);
  marker = createMarker(point,"Paralyzed Veterans of America Baltimore VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Baltimore VA Regional Office</span><span class='location-address'>31 Hopkins Plaza, Room 1236</span><span class='location-city'>Baltimore</span><span class='location-state'>MD,</span><span class='location-zip'>21201</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/39.2880994,-76.6167868' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:4102304470,1020'>410-230-4470 Ext: 1020</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:timb@pva.org'>timb@pva.org</a></div>");

  point = new google.maps.LatLng(42.3614971,-71.0594103);
  marker = createMarker(point,"Paralyzed Veterans of America Boston VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Boston VA Regional Office</span><span class='location-address'>J.F.K. Federal Building, Rm. 1575-C</span><span class='location-city'>Boston</span><span class='location-state'>MA,</span><span class='location-zip'>21201</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/42.3614971,-71.0594103' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:6173031395'>617-303-1395</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:annmarie@pva.org'>annmarie@pva.org</a></div>");

  point = new google.maps.LatLng(42.0622084,-71.0542339);
  marker = createMarker(point,"Brockton VAMC", "<span class='location-heading'>Brockton VAMC</span><span class='location-address'>940 Belmont Street Building 3, Room 207</span><span class='location-city'>Brockton</span><span class='location-state'>MA,</span><span class='location-zip'>02203-0393</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/42.0622084,-71.0542339' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7748262219'>774-826-2219</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:peted@pva.org'>peted@pva.org</a></div>");

  point = new google.maps.LatLng(42.2750317,-71.1719807);
  marker = createMarker(point,"Paralyzed Veterans of America Vocational Rehabilitation Office, West Roxbury VAMC", "<span class='location-heading'>Paralyzed Veterans of America Vocational Rehabilitation Office, West Roxbury VAMC</span><span class='location-address'>1400 VFW Parkway, Rm. AG 60</span><span class='location-city'>West Roxbury</span><span class='location-state'>MA,</span><span class='location-zip'>2132</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/42.2750317,-71.1719807' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:8572036091'>857-203-6091</a></div>");

  point = new google.maps.LatLng(42.3311438,-83.0531696);
  marker = createMarker(point,"Paralyzed Veterans of America Detroit VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Detroit VA Regional Office</span><span class='location-address'>477 Michigan Ave., Room 1218</span><span class='location-city'>Detroit</span><span class='location-state'>MI,</span><span class='location-zip'>48226</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/42.3311438,-83.0531696' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3134713996'>313-471-3996</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:stephanies@pva.org'>stephanies@pva.org</a></div>");

  point = new google.maps.LatLng(44.8941285,-93.1948351);
  marker = createMarker(point,"Minneapolis Paralyzed Veterans of America Bishop Henry Whipple Federal Bldg.", "<span class='location-heading'>Minneapolis Paralyzed Veterans of America Bishop Henry Whipple Federal Bldg.</span><span class='location-address'>1 Federal Drive, Room G915</span><span class='location-city'>St Paul</span><span class='location-state'>MN,</span><span class='location-zip'>55111-4042</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/44.8941285,-93.1948351' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:6129705668'>612-970-5668</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:tamia@pva.org'>tamia@pva.org</a></div>");

  point = new google.maps.LatLng(44.9020631,-93.2045593);
  marker = createMarker(point,"PVA Minneapolis VA Medical Center", "<span class='location-heading'>PVA Minneapolis VA Medical Center</span><span class='location-address'>1 Veterans Drive, Bldg. 76, Room 141</span><span class='location-city'>Minneapolis</span><span class='location-state'>MN,</span><span class='location-zip'>55417</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/44.9020631,-93.2045593' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:6126297022'>612-629-7022</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:jasons@pva.org'>jasons@pva.org</a></div>");

  point = new google.maps.LatLng(44.8941285,-93.1948351);
  marker = createMarker(point,"Minneapolis Voc Rehab Paralyzed Veterans of America Vocational Rehabilitation Office", "<span class='location-heading'>Minneapolis Voc Rehab Paralyzed Veterans of America Vocational Rehabilitation Office</span><span class='location-address'>1 Federal Drive, Room G915</span><span class='location-city'>St Paul</span><span class='location-state'>MN,</span><span class='location-zip'>55111</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/44.8941285,-93.1948351' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:6129705987'>612-970-5987</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:jamesa@pva.org'>jamesa@pva.org</a></div>");

  point = new google.maps.LatLng(32.3277475,-90.1648401);
  marker = createMarker(point,"Paralyzed Veterans of America Jackson VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Jackson VA Regional Office</span><span class='location-address'>1600 E. Woodrow Wilson Ave., Rm. 112</span><span class='location-city'>Jackson</span><span class='location-state'>MS,</span><span class='location-zip'>39216</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/32.3277475,-90.1648401' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:6013647188'>601-364-7188</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:timh@pva.org'>timh@pva.org</a></div>");

  point = new google.maps.LatLng(39.0636209,-94.5267092);
  marker = createMarker(point,"Paralyzed Veterans of America Kansas City VAMC", "<span class='location-heading'>Paralyzed Veterans of America Kansas City VAMC</span><span class='location-address'>4801 Linwood Blvd., Rm. M1-566</span><span class='location-city'>Kansas City</span><span class='location-state'>MO,</span><span class='location-zip'>64128</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/39.0636209,-94.5267092' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:8169222882'>816-922-2882</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:brentf@pva.org'>brentf@pva.org</a></div>");

  point = new google.maps.LatLng(38.6853239,-90.370569);
  marker = createMarker(point,"St. Louis Paralyzed Veterans of America", "<span class='location-heading'>St. Louis Paralyzed Veterans of America</span><span class='location-address'>9700 Page Blvd, Room 1-114</span><span class='location-city'>St. Louis</span><span class='location-state'>MO,</span><span class='location-zip'>63132</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/38.6853239,-90.370569' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3142534480'>314-253-4480</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:susanw@pva.org'>susanw@pva.org</a></div>");

  point = new google.maps.LatLng(38.4938482,-90.2819615);
  marker = createMarker(point,"St. Louis SCI Paralyzed Veterans of America SCI Office VA Medical Center. SCI Office (128JB)", "<span class='location-heading'>St. Louis SCI Paralyzed Veterans of America SCI Office VA Medical Center. SCI Office (128JB)</span><span class='location-address'>1 Jefferson Barracks Dr, Bldg. 52, R, 2, South 25</span><span class='location-city'>St. Louis</span><span class='location-state'>MO,</span><span class='location-zip'>63125-4199</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/38.4938482,-90.2819615' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3148946467'>314-894-6467</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:rodneyh@pva.org'>rodneyh@pva.org</a></div>");

  point = new google.maps.LatLng(38.4938482,-90.2819615);
  marker = createMarker(point,"St. Louis, MO Voc Rehab", "<span class='location-heading'>St. Louis, MO Voc Rehab</span><span class='location-address'>#1 Jefferson Barracks Drive Bldg 52, Room 2, South 25</span><span class='location-city'>St. Louis</span><span class='location-state'>MO,</span><span class='location-zip'>63125</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/38.4938482,-90.2819615' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2027106437'>202-710-6437</a></div>");

  point = new google.maps.LatLng(40.7541857,-96.6657331);
  marker = createMarker(point,"Paralyzed Veterans of America Lincoln VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Lincoln VA Regional Office</span><span class='location-address'>3800 Village Drive</span><span class='location-city'>Lincoln</span><span class='location-state'>NE,</span><span class='location-zip'>68516</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/40.7541857,-96.6657331' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:4024204017'>402-420-4017</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:lauran@pva.org'>lauran@pva.org</a></div>");

  point = new google.maps.LatLng(36.2850991,-115.0944925);
  marker = createMarker(point,"Las Vegas Paralyzed Veterans of America", "<span class='location-heading'>Las Vegas Paralyzed Veterans of America</span><span class='location-address'>Room 1C248 6900 N. Pecos Road North</span><span class='location-city'>Las Vegas</span><span class='location-state'>NV,</span><span class='location-zip'>89086</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/36.2850991,-115.0944925' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7027919000,14458'>702-791-9000 Ext: 14458</a></div>");

  point = new google.maps.LatLng(39.4668873,-119.7644204);
  marker = createMarker(point,"Reno Paralyzed Veterans of America", "<span class='location-heading'>Reno Paralyzed Veterans of America</span><span class='location-address'>5460 Reno Corporate Dr Suite 1102</span><span class='location-city'>Reno</span><span class='location-state'>NV,</span><span class='location-zip'>89511</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/39.4668873,-119.7644204' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7753214789'>775-321-4789</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:jasonm@pva.org'>jasonm@pva.org</a></div>");

  point = new google.maps.LatLng(35.0835547,-106.6534317);
  marker = createMarker(point,"Albuquerque Paralyzed Veterans of America", "<span class='location-heading'>Albuquerque Paralyzed Veterans of America</span><span class='location-address'>500 Gold Ave, SW, Room 3111</span><span class='location-city'>Albuquerque</span><span class='location-state'>NM,</span><span class='location-zip'>87102</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/35.0835547,-106.6534317' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:5053464896'>505-346-4896</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:richardma@pva.org'>richardma@pva.org</a></div>");

  point = new google.maps.LatLng(35.0549196,-106.5823148);
  marker = createMarker(point,"Albuquerque SCI Paralyzed Veterans of America", "<span class='location-heading'>Albuquerque SCI Paralyzed Veterans of America</span><span class='location-address'>Raymond G. Murphy VA Medical Center,SCI Services(128) Bldg 45 RM#1065 1501 San Pedro Dr SE</span><span class='location-city'>Albuquerque</span><span class='location-state'>NM,</span><span class='location-zip'>87108</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/35.0549196,-106.5823148' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:5052651711,5046'>505-265-1711 Ext: 5046</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:jeand@pva.org'>jeand@pva.org</a></div>");

  point = new google.maps.LatLng(40.8674032,-73.9064046);
  marker = createMarker(point,"Bronx SCI Paralyzed Veterans of America", "<span class='location-heading'>Bronx SCI Paralyzed Veterans of America</span><span class='location-address'>130 West Kingsbridge Road, Room 1D-52A</span><span class='location-city'>Bronx</span><span class='location-state'>NY,</span><span class='location-zip'>10468</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/40.8674032,-73.9064046' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7185849000,6272'>718-584-9000 Ext: 6272</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:amaurisp@pva.org'>amaurisp@pva.org</a></div>");

  point = new google.maps.LatLng(42.8894772,-78.8802825);
  marker = createMarker(point,"Buffalo Paralyzed Veterans of America", "<span class='location-heading'>Buffalo Paralyzed Veterans of America</span><span class='location-address'>130 South Elmwood Ave, Suite 621</span><span class='location-city'>Buffalo</span><span class='location-state'>NY,</span><span class='location-zip'>14202</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/42.8894772,-78.8802825' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7168573353'>716-857-3353</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:rachaels@pva.org'>rachaels@pva.org</a></div>");

  point = new google.maps.LatLng(40.728633,-74.0067046);
  marker = createMarker(point,"Manhattan Paralyzed Veterans of America", "<span class='location-heading'>Manhattan Paralyzed Veterans of America</span><span class='location-address'>245 W. Houston Street Room 212A</span><span class='location-city'>New York</span><span class='location-state'>NY,</span><span class='location-zip'>10014</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/40.728633,-74.0067046' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2128073114'>212-807-3114</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:daisyl@pva.org'>daisyl@pva.org</a></div>");

  point = new google.maps.LatLng(40.728633,-74.0067046);
  marker = createMarker(point,"Newark Paralyzed Veterans of America", "<span class='location-heading'>Newark Paralyzed Veterans of America</span><span class='location-address'>245 West Houston Street Room 212 A</span><span class='location-city'>New York</span><span class='location-state'>NY,</span><span class='location-zip'>10014</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/40.728633,-74.0067046' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:9732973228'>973-297-3228</a></div>");

  point = new google.maps.LatLng(43.0382106,-76.1392584);
  marker = createMarker(point,"Paralyzed Veterans of America Syracuse VAMC", "<span class='location-heading'>Paralyzed Veterans of America Syracuse VAMC</span><span class='location-address'>800 Irving Ave, Room C419</span><span class='location-city'>Syracuse</span><span class='location-state'>NY,</span><span class='location-zip'>13210</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/43.0382106,-76.1392584' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3154254400,53317'>315-425-4400 Ext: 53317</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:charlesto@pva.org'>charlesto@pva.org</a></div>");

  point = new google.maps.LatLng(36.096945,-80.243311);
  marker = createMarker(point,"Winston-Salem Paralyzed Veterans of America", "<span class='location-heading'>Winston-Salem Paralyzed Veterans of America</span><span class='location-address'>Winston-Salem VARO, Room 430 251 North Main Street</span><span class='location-city'>Winston-Salem</span><span class='location-state'>NC,</span><span class='location-zip'>27155</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/36.096945,-80.243311' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3362510836'>336-251-0836</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:lindap@pva.org'>lindap@pva.org</a></div>");

  point = new google.maps.LatLng(41.5046806,-81.6917547);
  marker = createMarker(point,"Paralyzed Veterans of America Cleveland VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Cleveland VA Regional Office</span><span class='location-address'>1240 East 9th Street, Room 1027</span><span class='location-city'>Cleveland</span><span class='location-state'>OH,</span><span class='location-zip'>44199</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/41.5046806,-81.6917547' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2165223214'>216-522-3214</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:michaely@pva.org'>michaely@pva.org</a></div>");

  point = new google.maps.LatLng(41.5132714,-81.6136973);
  marker = createMarker(point,"Cleveland SCI Paralyzed Veterans of America Louis Stokes VA Medical Center", "<span class='location-heading'>Cleveland SCI Paralyzed Veterans of America Louis Stokes VA Medical Center</span><span class='location-address'>10701 East Blvd., Room 6A-117</span><span class='location-city'>Cleveland</span><span class='location-state'>OH,</span><span class='location-zip'>44106</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/41.5132714,-81.6136973' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2167913800,64159'>216-791-3800 Ext: 64159</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:aarons@pva.org'>aarons@pva.org</a></div>");

  point = new google.maps.LatLng(35.7476698,-95.3697359);
  marker = createMarker(point,"Muskogee Paralyzed Veterans of America Muskogee VARO", "<span class='location-heading'>Muskogee Paralyzed Veterans of America Muskogee VARO</span><span class='location-address'>Muskogee VARO, Room 1-B-26 125 South Main Street</span><span class='location-city'>Muskogee</span><span class='location-state'>OK,</span><span class='location-zip'>74401</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/35.7476698,-95.3697359' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:9187817768'>918-781-7768</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:melodym@pva.org'>melodym@pva.org</a></div>");

  point = new google.maps.LatLng(35.4829077,-97.4963849);
  marker = createMarker(point,"Oklahoma City Paralyzed Veterans of America VA Medical Center", "<span class='location-heading'>Oklahoma City Paralyzed Veterans of America VA Medical Center</span><span class='location-address'>921 N.E. 13th Street, Room 2A-147</span><span class='location-city'>Oklahoma City</span><span class='location-state'>OK,</span><span class='location-zip'>73104</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/35.4829077,-97.4963849' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:4054565483'>405-456-5483</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:reginap@pva.org'>reginap@pva.org</a></div>");

  point = new google.maps.LatLng(45.5148712,-122.6757095);
  marker = createMarker(point,"Portland Paralyzed Veterans of America Portland VA Regional Office", "<span class='location-heading'>Portland Paralyzed Veterans of America Portland VA Regional Office</span><span class='location-address'>100 SW Main Street, FL 2</span><span class='location-city'>Portland</span><span class='location-state'>OR,</span><span class='location-zip'>97204</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/45.5148712,-122.6757095' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:5034124762'>503-412-4762</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:margaretl@pva.org'>margaretl@pva.org</a></div>");

  point = new google.maps.LatLng(40.020118,-75.1762546);
  marker = createMarker(point,"Philadelphia Paralyzed Veterans of America", "<span class='location-heading'>Philadelphia Paralyzed Veterans of America</span><span class='location-address'>5000 Wissahickon Avenue 3rd Floor</span><span class='location-city'>Philadelphia</span><span class='location-state'>PA,</span><span class='location-zip'>19144</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/40.020118,-75.1762546' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2153813057'>215-381-3057</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:violetg@pva.org'>violetg@pva.org</a></div>");

  point = new google.maps.LatLng(40.137718,-75.398398);
  marker = createMarker(point,"Veterans Career Program Philadelphia, PA Voc Rehab", "<span class='location-heading'>Veterans Career Program Philadelphia, PA Voc Rehab</span><span class='location-address'>221 Clearfield Avenue</span><span class='location-city'>Eagleville</span><span class='location-state'>PA,</span><span class='location-zip'>19403</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/40.137718,-75.398398' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2022570144 '>202-257-0144 </a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:laurenl@pva.org'>laurenl@pva.org</a></div>");

  point = new google.maps.LatLng(40.4434308,-79.9943233);
  marker = createMarker(point,"Pittsburgh Paralyzed Veterans of America VARO", "<span class='location-heading'>Pittsburgh Paralyzed Veterans of America VARO</span><span class='location-address'>VARO, Room 1602 1000 Liberty Avenue</span><span class='location-city'>Pittsburgh</span><span class='location-state'>PA,</span><span class='location-zip'>15222</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/40.4434308,-79.9943233' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:4123956255'>412-395-6255</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:kurttr@pva.org'>kurttr@pva.org</a></div>");

  point = new google.maps.LatLng(18.4151941,-66.1081455);
  marker = createMarker(point,"San Juan Paralyzed Veterans of America Dept. of Veterans Affairs Regional Office (355)", "<span class='location-heading'>San Juan Paralyzed Veterans of America Dept. of Veterans Affairs Regional Office (355)</span><span class='location-address'>50 Carr 165, Room 113</span><span class='location-city'>Guaynabo</span><span class='location-state'>PR,</span><span class='location-zip'>00968-8024</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/18.4151941,-66.1081455' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7877727384'>787-772-7384</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:adrianl@pva.org'>adrianl@pva.org</a></div>");

  point = new google.maps.LatLng(18.3904534,-66.0793095);
  marker = createMarker(point,"San Juan SCI VA Caribbean Healthcare System", "<span class='location-heading'>San Juan SCI VA Caribbean Healthcare System</span><span class='location-address'>Mail Symbol 248 Room D-195A #10 Casia Street</span><span class='location-city'>San Juan</span><span class='location-state'>PR,</span><span class='location-zip'>00921-3201</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/18.3904534,-66.0793095' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7876417582,11564'>787-641-7582 Ext: 11564</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:jorgec@pva.org'>jorgec@pva.org</a></div>");

  point = new google.maps.LatLng(33.9788498,-80.964145);
  marker = createMarker(point,"Columbia VARO Paralyzed Veterans of America", "<span class='location-heading'>Columbia VARO Paralyzed Veterans of America</span><span class='location-address'>Columbia VARO, Room 1121 6437 Garners Ferry Road</span><span class='location-city'>Columbia</span><span class='location-state'>SC,</span><span class='location-zip'>29209</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/33.9788498,-80.964145' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:8036472432'>803-647-2432</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:charlest@pva.org'>charlest@pva.org</a></div>");

  point = new google.maps.LatLng(43.5319857,-96.7568015);
  marker = createMarker(point,"Sioux Falls Paralyzed Veterans of America VA Medical & Regional Office", "<span class='location-heading'>Sioux Falls Paralyzed Veterans of America VA Medical & Regional Office</span><span class='location-address'>2501 W. 22nd Street, Rm 100</span><span class='location-city'>Sioux Falls</span><span class='location-state'>SD,</span><span class='location-zip'>57105</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/43.5319857,-96.7568015' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:6053336801'>605-333-6801</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:bradleyf@pva.org'>bradleyf@pva.org</a></div>");

  point = new google.maps.LatLng(35.1430046,-90.0264023);
  marker = createMarker(point,"Memphis SCI Paralyzed Veterans of America Memphis VA Medical Center", "<span class='location-heading'>Memphis SCI Paralyzed Veterans of America Memphis VA Medical Center</span><span class='location-address'>1030 Jefferson Ave., Rm. 2B-143</span><span class='location-city'>Memphis</span><span class='location-state'>TN,</span><span class='location-zip'>38104</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/35.1430046,-90.0264023' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:9015238990,7795'>901-523-8990 Ext: 7795</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:feliciaf@pva.org'>feliciaf@pva.org</a></div>");

  point = new google.maps.LatLng(36.1577514,-86.7825982);
  marker = createMarker(point,"Paralyzed Veterans of America Nashville VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Nashville VA Regional Office</span><span class='location-address'>110 9th Avenue South, Rm. C 108</span><span class='location-city'>Nashville</span><span class='location-state'>TN,</span><span class='location-zip'>37203</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/36.1577514,-86.7825982' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:6156956383'>615-695-6383</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:nichellee@pva.org'>nichellee@pva.org</a></div>");

  point = new google.maps.LatLng(32.6966984,-96.7887623);
  marker = createMarker(point,"Paralyzed Veterans of America Dallas VA Medical Center", "<span class='location-heading'>Paralyzed Veterans of America Dallas VA Medical Center</span><span class='location-address'>4500 S. Lancaster Road, Room 1-A-102</span><span class='location-city'>Dallas</span><span class='location-state'>TX,</span><span class='location-zip'>75216</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/32.6966984,-96.7887623' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2148570106'>214-857-0106</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:zeldah@pva.org'>zeldah@pva.org</a></div>");

  point = new google.maps.LatLng(31.8214159,-106.4626734);
  marker = createMarker(point,"El Paso Paralyzed Veterans of America VA Health Care Center", "<span class='location-heading'>El Paso Paralyzed Veterans of America VA Health Care Center</span><span class='location-address'>5001 N. Piedras St, Room B-211</span><span class='location-city'>El Paso</span><span class='location-state'>TX,</span><span class='location-zip'>79930-4211</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/31.8214159,-106.4626734' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:9155646183'>915-564-6183</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:leticiaj@pva.org'>leticiaj@pva.org</a></div>");

    point = new google.maps.LatLng(29.7041601,-95.3868388);
    marker = createMarker(point,"Paralyzed Veterans of America Houston VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Houston VA Regional Office</span><span class='location-address'>6900 Almeda Road, Room 1028</span><span class='location-city'>Houston</span><span class='location-state'>TX,</span><span class='location-zip'>77030</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/29.7041601,-95.3868388' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7133832727'>713-383-2727</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:gregoryt@pva.org'>gregoryt@pva.org</a></div>");

  point = new google.maps.LatLng(29.7001034,-95.3889654);
  marker = createMarker(point,"Houston SCI Paralyzed Veterans of America Michael DeBakey VA Medical Center", "<span class='location-heading'>Houston SCI Paralyzed Veterans of America Michael DeBakey VA Medical Center</span><span class='location-address'>2002 Holcombe Blvd., Rm 1-B-164</span><span class='location-city'>Houston</span><span class='location-state'>TX,</span><span class='location-zip'>77030</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/29.7001034,-95.3889654' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7137947993'>713-794-7993</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:johna@pva.org'>johna@pva.org</a></div>");

  point = new google.maps.LatLng(29.5067294,-98.579854);
  marker = createMarker(point,"San Antonio SCI Paralyzed Veterans of America Audie Murphy VA Medical Center", "<span class='location-heading'>San Antonio SCI Paralyzed Veterans of America Audie Murphy VA Medical Center</span><span class='location-address'>7400 Merton Minter Blvd., Room C 012.1</span><span class='location-city'>San Antonio</span><span class='location-state'>TX,</span><span class='location-zip'>78229</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/29.5067294,-98.579854' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2106175300,15275'>210-617-5300 Ext: 15275</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:armandod@pva.org'>armandod@pva.org</a></div>");

  point = new google.maps.LatLng(29.5066119,-98.5797107);
  marker = createMarker(point,"San Antonio Voc Rehab Veterans Career Program San Antonio", "<span class='location-heading'>San Antonio Voc Rehab Veterans Career Program San Antonio</span><span class='location-address'>7400 Merton Minter Boulevard</span><span class='location-city'>San Antonio</span><span class='location-state'>TX,</span><span class='location-zip'>78229</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/29.5066119,-98.5797107' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2106175300,10148'>210-617-5300 Ext: 10148</a></div>");

  point = new google.maps.LatLng(29.5067294,-98.579854);
  marker = createMarker(point,"San Antonio Voc. Rehab OfficeParalyzed Veterans of America Voc Rehab Office", "<span class='location-heading'>San Antonio Voc. Rehab OfficeParalyzed Veterans of America Voc Rehab Office</span><span class='location-address'>Audie Murphy VAMC, SCI Ward, Room C012.2 7400 Merton Minter Blvd.</span><span class='location-city'>San Antonio</span><span class='location-state'>TX,</span><span class='location-zip'>78229</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/29.5067294,-98.579854' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2106175300,10148'>210-617-5300 Ext: 10148</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:joelh@pva.org'>joelh@pva.org</a></div>");

  point = new google.maps.LatLng(31.5517096,-97.1293759);
  marker = createMarker(point,"Paralyzed Veterans of America Waco VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Waco VA Regional Office</span><span class='location-address'>701 Clay Avenue, Room 115</span><span class='location-city'>Waco</span><span class='location-state'>TX,</span><span class='location-zip'>76799</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/31.5517096,-97.1293759' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2542999944'>254-299-9944</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:tym@pva.org'>tym@pva.org</a></div>");

  point = new google.maps.LatLng(37.0153723,-76.3323524);
  marker = createMarker(point,"Hampton SCI Paralyzed Veterans of America VA Medical Center", "<span class='location-heading'>Hampton SCI Paralyzed Veterans of America VA Medical Center</span><span class='location-address'>100 Emancipation Drive, Bldg. 137, Rm. D-100-C</span><span class='location-city'>Hampton</span><span class='location-state'>VA,</span><span class='location-zip'>23667</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/37.0153723,-76.3323524' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7577229961,2943'>757-722-9961 Ext: 2943</a></div>");

  point = new google.maps.LatLng(37.4977653,-77.4683259);
  marker = createMarker(point,"Richmond Veterans Career Program Office Paralyzed Veterans of America", "<span class='location-heading'>Richmond Veterans Career Program Office Paralyzed Veterans of America</span><span class='location-address'>VA Medical Center, Room 1-T-126 1201 Broad Rock Blvd.</span><span class='location-city'>Richmond</span><span class='location-state'>VA,</span><span class='location-zip'>23249</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/37.4977653,-77.4683259' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:8046755316'>804-675-5316</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:alexs@pva.org'>alexs@pva.org</a></div>");

  point = new google.maps.LatLng(37.4977653,-77.4683259);
  marker = createMarker(point,"Richmond SCI Paralyzed Veterans of America", "<span class='location-heading'>Richmond SCI Paralyzed Veterans of America</span><span class='location-address'>VA Medical Center, Room 1-U-148</span><span class='location-city'>1201 Broad Rock Boulevard</span><span class='location-state'>VA,</span><span class='location-zip'>23249</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/37.4977653,-77.4683259' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:8046755316'>804-675-5316</a></div><div class='location-fax'><span class='location-label'>Fax:</span>804-675-6561</div>");

  point = new google.maps.LatLng(37.2686271,-79.9443367);
  marker = createMarker(point,"Paralyzed Veterans of America Roanoke VARO", "<span class='location-heading'>Paralyzed Veterans of America Roanoke VARO</span><span class='location-address'>210 Franklin Road SW Rm 804</span><span class='location-city'>Roanoke</span><span class='location-state'>VA,</span><span class='location-zip'>24011</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/37.2686271,-79.9443367' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:5405971707'>540-597-1707</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:mikek@pva.org'>mikek@pva.org</a></div>");

  point = new google.maps.LatLng(47.6046101,-122.3356195);
  marker = createMarker(point,"Seattle Paralyzed Veterans of America", "<span class='location-heading'>Seattle Paralyzed Veterans of America</span><span class='location-address'>Henry Jackson Federal Building (71) Room 1054 915 Second Avenue</span><span class='location-city'>Seattle</span><span class='location-state'>WA,</span><span class='location-zip'>98174</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/47.6046101,-122.3356195' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2063418210'>206-341-8210</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:reneeb@pva.org'>reneeb@pva.org</a></div>");

  point = new google.maps.LatLng(47.5624976,-122.3077496);
  marker = createMarker(point,"Seattle SCI Paralyzed Veterans of America", "<span class='location-heading'>Seattle SCI Paralyzed Veterans of America</span><span class='location-address'>1660 S. Columbian Way, Room 1-B-163</span><span class='location-city'>Seattle</span><span class='location-state'>WA,</span><span class='location-zip'>98108</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/47.5624976,-122.3077496' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2067685415'>206-768-5415</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:michaelk@pva.org'>michaelk@pva.org</a></div>");

  point = new google.maps.LatLng(38.4203059,-82.447869);
  marker = createMarker(point,"Paralyzed Veterans of America West Virginia VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America West Virginia VA Regional Office</span><span class='location-address'>640 4th Ave., Room 137</span><span class='location-city'>Huntington</span><span class='location-state'>WV,</span><span class='location-zip'>25701</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/38.4203059,-82.447869' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3043999393'>304-399-9393</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:brendaa@pva.org'>brendaa@pva.org</a></div>");

  point = new google.maps.LatLng(43.019277,-87.9811751);
  marker = createMarker(point,"Paralyzed Veterans of America Milwaukee VA Regional Office", "<span class='location-heading'>Paralyzed Veterans of America Milwaukee VA Regional Office</span><span class='location-address'>5400 W. National Avenue, Rm. 168</span><span class='location-city'>Milwaukee</span><span class='location-state'>WI,</span><span class='location-zip'>53214</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/43.019277,-87.9811751' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:4149025655'>414-902-5655</a></div><div class='location-fax'><span class='location-label'>Fax:</span>414-902-9432</div><div class='location-phone'><span class='location-label'>Toll Free:</span><a href='tel:8007953580'>800-795-3580</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:lindaro@pva.org'>lindaro@pva.org</a></div>");
  
  point = new google.maps.LatLng(33.492593,-112.0607479);
	marker = createMarker(point,"Arizona Chapter PVA", "<span class='location-heading'>Arizona Chapter PVA</span><span class='location-address'>1001 E Fairmount Ave</span><span class='location-city'>Phoenix</span><span class='location-state'>Arizona,</span><span class='location-zip'>85014</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/33.492593,-112.0607479' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:6022449168'>602-244-9168</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:AZPVA@AZPVA.ORG'>AZPVA@AZPVA.ORG</a></div>");

	point = new google.maps.LatLng(37.4054073,-122.1400089);
	marker = createMarker(point,"Bay Area & Western Chapter PVA", "<span class='location-heading'>Bay Area & Western Chapter PVA</span><span class='location-address'>3801 Miranda Ave. Bldg. 7 Room E-118</span><span class='location-city'>Palo Alto</span><span class='location-state'>California,</span><span class='location-zip'>94304-1207</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/37.4054073,-122.1400089' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:6508583936'>650-858-3936</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:amaral@bawpva.org'>amaral@bawpva.org</a></div>");

	point = new google.maps.LatLng(30.4148783,-88.9450439);
	marker = createMarker(point,"Bayou Gulf States Chapter PVA", "<span class='location-heading'>Bayou Gulf States Chapter PVA</span><span class='location-address'>400 Veterans Ave Bldg 1 Room 1B-114</span><span class='location-city'>Biloxi</span><span class='location-state'>Mississippi,</span><span class='location-zip'>39531</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/30.4148783,-88.9450439' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2282061515'>228-206-1515</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:bayougulfstates@cableone.net'>bayougulfstates@cableone.net</a></div>");

	point = new google.maps.LatLng(41.5867566,-81.4957738);
	marker = createMarker(point,"Buckeye Chapter PVA", "<span class='location-heading'>Buckeye Chapter PVA</span><span class='location-address'>26250 Euclid Avenue Suite 115</span><span class='location-city'>Euclid</span><span class='location-state'>Ohio,</span><span class='location-zip'>44132</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/41.5867566,-81.4957738' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2167311017'>216-731-1017</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:info@buckeyepva.org'>info@buckeyepva.org</a></div>");

	point = new google.maps.LatLng(32.8751298,-117.2323881);
	marker = createMarker(point,"Cal-Diego PVA", "<span class='location-heading'>Cal-Diego PVA</span><span class='location-address'>3350 La Jolla Village Drive 1A-118</span><span class='location-city'>San Diego</span><span class='location-state'>California,</span><span class='location-zip'>92161</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/32.8751298,-117.2323881' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:8584501443'>858-450-1443</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:info@caldiegopva.org'>info@caldiegopva.org</a></div>");

	point = new google.maps.LatLng(33.777569,-118.1189428);
	marker = createMarker(point,"California PVA", "<span class='location-heading'>California PVA</span><span class='location-address'>5901 E. 7th Street Building 150. Room R-204</span><span class='location-city'>Long Beach</span><span class='location-state'>,</span><span class='location-zip'>90822-5201</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/33.777569,-118.1189428' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:5628265713'>562-826-5713</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:info@pvacc.org'>info@pvacc.org</a></div>");

	point = new google.maps.LatLng(28.7276549,-81.2981178);
	marker = createMarker(point,"Central Florida Chapter PVA", "<span class='location-heading'>Central Florida Chapter PVA</span><span class='location-address'>2711 South Design Court</span><span class='location-city'>Sanford</span><span class='location-state'>Florida,</span><span class='location-zip'>32773-8120</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/28.7276549,-81.2981178' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:4073287041'>407-328-7041</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:joannep@pvacf.org'>joannep@pvacf.org</a></div>");

	point = new google.maps.LatLng(39.679565,-75.7659872);
	marker = createMarker(point,"Colonial Chapter PVA", "<span class='location-heading'>Colonial Chapter PVA</span><span class='location-address'>700 Barksdale Rd. Unit 2</span><span class='location-city'>Newark</span><span class='location-state'>Delaware,</span><span class='location-zip'>19711</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/39.679565,-75.7659872' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3028616671'>302-861-6671</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:jbedsworth@colonialpva.org'>jbedsworth@colonialpva.org</a></div>");

	point = new google.maps.LatLng(26.1736466,-80.1471105);
	marker = createMarker(point,"Florida PVA Chapter", "<span class='location-heading'>Florida PVA Chapter</span><span class='location-address'>3799 N. Andrews Avenue</span><span class='location-city'>Fort Lauderdale</span><span class='location-state'>Florida,</span><span class='location-zip'>33309-5261</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/26.1736466,-80.1471105' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:9545658885'>954-565-8885</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:pvaf@aol.com'>pvaf@aol.com</a></div>");

	point = new google.maps.LatLng(28.0934063,-82.4601075);
	marker = createMarker(point,"Florida Gulf Coast PVA, Association", "<span class='location-heading'>Florida Gulf Coast PVA, Association</span><span class='location-address'>15435 North Florida Avenue</span><span class='location-city'>Tampa</span><span class='location-state'>Florida,</span><span class='location-zip'>33613</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/28.0934063,-82.4601075' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:8132641111'>813-264-1111</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:info@floridagulfcoastpva.org'>info@floridagulfcoastpva.org</a></div>");

	point = new google.maps.LatLng(38.6861146,-90.4039038);
	marker = createMarker(point,"Gateway Chapter PVA", "<span class='location-heading'>Gateway Chapter PVA</span><span class='location-address'>1311 Lindbergh Plaza Center</span><span class='location-city'>St. Louis</span><span class='location-state'>Missouri,</span><span class='location-zip'>63132</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/38.6861146,-90.4039038' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3144270393'>314-427-0393</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:info@gatewaypva.org'>info@gatewaypva.org</a></div>");

	point = new google.maps.LatLng(41.2855824,-96.0321057);
	marker = createMarker(point,"Great Plains Chapter PVA", "<span class='location-heading'>Great Plains Chapter PVA</span><span class='location-address'>7612 Maple Street</span><span class='location-city'>Omaha</span><span class='location-state'>Nebraska,</span><span class='location-zip'>68134-6502</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/41.2855824,-96.0321057' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:4023981422'>402-398-1422</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:pva@greatplainspva.org'>pva@greatplainspva.org</a></div>");

	point = new google.maps.LatLng(41.6155688,-93.7145957);
	marker = createMarker(point,"PVA - Iowa Chapter", "<span class='location-heading'>PVA - Iowa Chapter</span><span class='location-address'>7025 Hickman Rd. Suite 1</span><span class='location-city'>Urbandale</span><span class='location-state'>Iowa,</span><span class='location-zip'>50322</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/41.6155688,-93.7145957' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:5152774782'>515-277-4782</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:iowapvakim@yahoo.com'>iowapvakim@yahoo.com</a></div>");

	point = new google.maps.LatLng(38.3243267,-85.7154956);
	marker = createMarker(point,"Kentucky - Indiana Chapter of PVA", "<span class='location-heading'>Kentucky - Indiana Chapter of PVA</span><span class='location-address'>2835 Holmans Lane</span><span class='location-city'>Jeffersonville</span><span class='location-state'>Indiana,</span><span class='location-zip'>47130</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/38.3243267,-85.7154956' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:5026356539'>502-635-6539</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:info@kipva.org'>info@kipva.org</a></div>");

	point = new google.maps.LatLng(40.4941203,-79.9305122);
	marker = createMarker(point,"Keystone PVA", "<span class='location-heading'>Keystone PVA</span><span class='location-address'>1113 Main Street</span><span class='location-city'>Pittsburgh</span><span class='location-state'>Pennsylvania,</span><span class='location-zip'>15215-2407</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/40.4941203,-79.9305122' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:4127812474'>412-781-2474</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:keystoneparavets@gmail.com'>keystoneparavets@gmail.com</a></div>");

	point = new google.maps.LatLng(32.9097321,-96.6881644);
	marker = createMarker(point,"Lone Star Chapter PVA", "<span class='location-heading'>Lone Star Chapter PVA</span><span class='location-address'>3925 Forest Lane</span><span class='location-city'>Garland</span><span class='location-state'>Texas,</span><span class='location-zip'>75042-6932</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/32.9097321,-96.6881644' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:9722765252'>972-276-5252</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:lspva@lspva.net'>lspva@lspva.net</a></div>");

	point = new google.maps.LatLng(42.3839215,-83.5051876);
	marker = createMarker(point,"Michigan Chapter PVA", "<span class='location-heading'>Michigan Chapter PVA</span><span class='location-address'>46701 Commerce Center Drive</span><span class='location-city'>Plymouth</span><span class='location-state'>Michigan,</span><span class='location-zip'>48170</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/42.3839215,-83.5051876' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2484769000'>248-476-9000</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:chapterhq@michiganpva.org'>chapterhq@michiganpva.org</a></div>");

	point = new google.maps.LatLng(35.5360332,-97.6237493);
	marker = createMarker(point,"Mid-America Chapter PVA", "<span class='location-heading'>Mid-America Chapter PVA</span><span class='location-address'>6108 NW 63rd Street Suite A</span><span class='location-city'>Oklahoma City</span><span class='location-state'>Oklahoma,</span><span class='location-zip'>73132-7526</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/35.5360332,-97.6237493' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:4057217168'>405-721-7168</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:midamericapva@yahoo.com'>midamericapva@yahoo.com</a></div>");

	point = new google.maps.LatLng(37.5018699,-77.611947);
	marker = createMarker(point,"Mid-Atlantic Chapter PVA", "<span class='location-heading'>Mid-Atlantic Chapter PVA</span><span class='location-address'>11620 Busy Street</span><span class='location-city'>North Chesterfield</span><span class='location-state'>Virginia,</span><span class='location-zip'>23236-4060</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/37.5018699,-77.611947' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:8043780017'>804-378-0017</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:vapva@aol.com'>vapva@aol.com</a></div>");

	point = new google.maps.LatLng(35.1430046,-90.0264023);
	marker = createMarker(point,"Mid-South Chapter PVA", "<span class='location-heading'>Mid-South Chapter PVA</span><span class='location-address'>1030 Jefferson Ave., Rm 2D100 Memphis VAMC 817</span><span class='location-city'>Memphis</span><span class='location-state'>Tennessee,</span><span class='location-zip'>38104-2127</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/35.1430046,-90.0264023' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:901527 3018'>901-527 3018</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:mspva@aol.com'>mspva@aol.com</a></div>");

	point = new google.maps.LatLng(44.9027091,-93.2054644);
	marker = createMarker(point,"Minnesota PVA", "<span class='location-heading'>Minnesota PVA</span><span class='location-address'>1 Veterans Drive SCI - 238</span><span class='location-city'>Minneapolis</span><span class='location-state'>Minnesota,</span><span class='location-zip'>55417-2309</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/44.9027091,-93.2054644' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:6124672263'>612-467-2263</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:office@mnpva.org'>office@mnpva.org</a></div>");

	point = new google.maps.LatLng(39.6739293,-104.845612);
	marker = createMarker(point,"Mountain States Chapter PVA", "<span class='location-heading'>Mountain States Chapter PVA</span><span class='location-address'>12200 E. Iliff Ave. Suite107</span><span class='location-city'>Aurora</span><span class='location-state'>Colorado,</span><span class='location-zip'>80014-5376</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/39.6739293,-104.845612' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3035970038'>303-597-0038</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:info@mscpva.org'>info@mscpva.org</a></div>");

	point = new google.maps.LatLng(36.1640006,-115.2234896);
	marker = createMarker(point,"Nevada Chapter PVA", "<span class='location-heading'>Nevada Chapter PVA</span><span class='location-address'>704 South Jones Blvd.</span><span class='location-city'>Las Vegas</span><span class='location-state'>Nevada,</span><span class='location-zip'>89107-3614</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/36.1640006,-115.2234896' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7026460040'>702-646-0040</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:pvanevada@gmail.com'>pvanevada@gmail.com</a></div>");

	point = new google.maps.LatLng(42.279117,-71.1694621);
	marker = createMarker(point,"New England Chapter PVA", "<span class='location-heading'>New England Chapter PVA</span><span class='location-address'>1208 VFW Parkway Suite 301</span><span class='location-city'>West Roxbury</span><span class='location-state'>Massachusetts,</span><span class='location-zip'>2132</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/42.279117,-71.1694621' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:6179428678'>617-942-8678</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:info@newenglandpva.org'>info@newenglandpva.org</a></div>");

	point = new google.maps.LatLng(43.5491349,-96.7589764);
	marker = createMarker(point,"North Central Chapter PVA", "<span class='location-heading'>North Central Chapter PVA</span><span class='location-address'>209 North Garfield Ave</span><span class='location-city'>Sioux Falls</span><span class='location-state'>South Dakota,</span><span class='location-zip'>57104-5601</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/43.5491349,-96.7589764' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:6053360494'>605-336-0494</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:info@ncpva.org'>info@ncpva.org</a></div>");

	point = new google.maps.LatLng(47.467123,-122.3426764);
	marker = createMarker(point,"Northwest Chapter PVA", "<span class='location-heading'>Northwest Chapter PVA</span><span class='location-address'>616 SW 152nd St Suite B</span><span class='location-city'>Burien</span><span class='location-state'>Washington,</span><span class='location-zip'>98166-2225</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/47.467123,-122.3426764' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:2062411843'>206-241-1843</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:pvachnw@mindspring.com'>pvachnw@mindspring.com</a></div>");

	point = new google.maps.LatLng(44.9683901,-122.9873557);
	marker = createMarker(point,"Oregon PVA", "<span class='location-heading'>Oregon PVA</span><span class='location-address'>3700 Silverton Road NE</span><span class='location-city'>Salem</span><span class='location-state'>Oregon,</span><span class='location-zip'>97305-1472</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/44.9683901,-122.9873557' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:5033627998'>503-362-7998</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:oregonpva@oregonpva.org'>oregonpva@oregonpva.org</a></div>");

	point = new google.maps.LatLng(18.4125795,-66.0089725);
	marker = createMarker(point,"Puerto Rico Chapter PVA", "<span class='location-heading'>Puerto Rico Chapter PVA</span><span class='location-address'>PO BOX 366571 ( physical address :812 Iturregui)</span><span class='location-city'>San Juan</span><span class='location-state'>Puerto Rico,</span><span class='location-zip'>00936-6571</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/18.4125795,-66.0089725' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7877766055'>787-776-6055</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:pvapuertorico@gmail.com'>pvapuertorico@gmail.com</a></div>");

	point = new google.maps.LatLng(33.3778772,-82.1317938);
	marker = createMarker(point,"Southeastern PVA", "<span class='location-heading'>Southeastern PVA</span><span class='location-address'>4010 Deans Bridge Road</span><span class='location-city'>Hephzibah</span><span class='location-state'>Georgia,</span><span class='location-zip'>30815-5616</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/33.3778772,-82.1317938' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7067966301'>706-796-6301</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:paravet@comcast.net'>paravet@comcast.net</a></div>");

	point = new google.maps.LatLng(29.9194256,-95.0698523);
	marker = createMarker(point,"Texas Chapter PVA", "<span class='location-heading'>Texas Chapter PVA</span><span class='location-address'>6418 FM 2100</span><span class='location-city'>Crosby</span><span class='location-state'>Texas,</span><span class='location-zip'>77532-5604</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/29.9194256,-95.0698523' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7135208782'>713-520-8782</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:info@texaspva.org'>info@texaspva.org</a></div>");

	point = new google.maps.LatLng(41.8462066,-87.9106445);
	marker = createMarker(point,"Vaughan PVA", "<span class='location-heading'>Vaughan PVA</span><span class='location-address'>2235 Enterprise Drive Suite 3501</span><span class='location-city'>Westchester</span><span class='location-state'>Illinois,</span><span class='location-zip'>60154-5806</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/41.8462066,-87.9106445' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:7089479790'>708-947-9790</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:vpva@vaughanpva.org'>vpva@vaughanpva.org</a></div>");

	point = new google.maps.LatLng(38.3135467,-81.5358368);
	marker = createMarker(point,"West Virginia PVA", "<span class='location-heading'>West Virginia PVA</span><span class='location-address'>336 Campbells Creek Drive</span><span class='location-city'>Charleston</span><span class='location-state'>West Virginia,</span><span class='location-zip'>25306-6806</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/38.3135467,-81.5358368' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:3049259352'>304-925-9352</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:info@wvpva.org'>info@wvpva.org</a></div>");

	point = new google.maps.LatLng(43.040461,-87.8969582);
	marker = createMarker(point,"PVA Wisconsin Chapter, Inc", "<span class='location-heading'>PVA Wisconsin Chapter, Inc</span><span class='location-address'>750 N. Lincoln Memorial Drive Suite 306</span><span class='location-city'>Milwaukee</span><span class='location-state'>Wisconsin,</span><span class='location-zip'>53202-4018</span><span class='location-direction'><a class='btn' href='https://www.google.com/maps/dir/Current+Location/43.040461,-87.8969582' target='_blank'>Get Directions</a></span><div class='location-phone'><span class='location-label'>Phone:</span><a href='tel:4143288910'>414-328-8910</a></div><div class='location-email'><span class='location-label'>Email:</span><a href='mailto:info@wisconsinpva.org'>info@wisconsinpva.org</a></div>");



    return true;    
}
                    </script>

                </div>
            </div>
        </section>

        <!-- Office Listing -->
        <section>
            <div class="container">
                <div class="row inner-top-xs">
                    <div class="col-md-12">
                        <h2>National Service Offices and Chapters</h2>
                        <div id="side_bar" class="location-listing"></div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAaIevV2cl2JjJwZUEmuRIxoF2JqLOnnbc"></script>
<script src="https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js"></script>