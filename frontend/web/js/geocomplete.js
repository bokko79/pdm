var latRes  = $("input[name='Locations[lat]']").val(),
    lngRes  = $("input[name='Locations[lng]']").val();

var lat = $('#control_input_lat').val(),
  lng   = $('#control_input_lng').val();

latRes = latRes!='' ? latRes : lat;
lngRes = lngRes!='' ? lngRes : lng;

$(document).ready(function(){ 

    $("#projects-address").geocomplete({
      map: "#my_map_location",
      mapOptions: {
        scrollwheel: true,
        //zoomControl: false,
        streetViewControl: false,
        scaleControl: false,
        //panControl: false,
        overviewMapControl: false,
        //mapTypeControl: false,
        keyboardShortcuts: false,
        //fullscreenControl: false,
        //draggable: false,        
      },
      markerOptions: {
        draggable: true
      },
      details: "form",
      detailsAttribute: "data-geo",
      //types: ['(cities)'],
      location: latRes!='' ? [latRes,lngRes] : [lat,lng],


    }).bind("geocode:dragged", function(event, latLng){
    $("input[name='Locations[lat]']").val(latLng.lat());
    $("input[name='Locations[lng]']").val(latLng.lng());

    var map = $("#projects-address").geocomplete("map");
    map.panTo(latLng);
    var geocoder = new google.maps.Geocoder();
  });

});