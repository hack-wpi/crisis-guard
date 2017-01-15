function initMap() {

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: {lat: 40.371659, lng: -97.734375}
  });

  // Create an array of alphabetical characters used to label the markers.
  var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

  // Add some markers to the map.
  // Note: The code uses the JavaScript Array.prototype.map() method to
  // create an array of markers based on a given "locations" array.
  // The map() method here has nothing to do with the Google Maps API.
  var markers = locations.map(function(location, i) {
    return new google.maps.Marker({
      position: location,
      label: labels[i % labels.length]
    });
  });

  for (var i = 0; i < markers.length; i++) {
      marker = markers[i];
      google.maps.event.addListener(marker, "click", function (event) {
                            alert(this.position);
      });
  }

  // Add a marker clusterer to manage the markers.
  var markerCluster = new MarkerClusterer(map, markers,
      {imagePath: '/images/m'});

}

var locations = [
  {lat: 37.774929, lng: -122.34216},
  {lat: 37.774929, lng: -122.41423416},
  {lat: 37.774929, lng: -122.213},
  {lat: 42.407211, lng: -71.382437},
  {lat: 42.407211, lng: -71.312},
  {lat: 41.977287, lng: -70.038185},
  {lat: 41.976287, lng: -70.037185},
  {lat: 41.975287, lng: -70.036185},
]
