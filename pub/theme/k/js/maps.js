/**function initialize() {
    var loc = {};
    var geocoder = new google.maps.Geocoder();
    if(google.loader.ClientLocation) {
        loc.lat = google.loader.ClientLocation.latitude;
        loc.lng = google.loader.ClientLocation.longitude;

        var latlng = new google.maps.LatLng(loc.lat, loc.lng);
        geocoder.geocode({'latLng': latlng}, function(results, status) {
            if(status == google.maps.GeocoderStatus.OK) {
                alert(results[0]['formatted_address']);
            };
        });
    }
}*/

$(document).ready(function(){
  var loc = {};
  function showlocation(position){
    loc.lat = position.coords.latitude;
    loc.lng = position.coords.longitude;
        map = new GMaps({
          div: '#mapa',
          lat: loc.lat,
          lng: loc.lng,
          //mapTypeId:google.maps.MapTypeId.HYBRID
          //HYBRID, SATTELITE, ROADMAP, TERRAIN
        });

        map.addMarker({
          div: '#mapa',
          lat: loc.lat,
          lng: loc.lng,
          title:"AFramework",         
          infoWindow:{
            content:"AFramework"
          }
        });
  }
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showlocation);
  }
});
