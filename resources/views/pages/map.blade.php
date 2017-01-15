@extends('layouts.app')

<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>World Flare View | Crisis Guard</title>
  <style>
	/* Always set the map height explicitly to define the size of the div
	 * element that contains the map. */
	#map {
	  height: 100%;
	}
	/* Optional: Makes the sample page fill the window. */
	html, body {
	  height: 100%;
	  margin: 0;
	  padding: 0;
	}
  </style>
</head>
<body>
  <div id="map"></div>
  <script language="javascript" type="text/javascript" src="/js/flares.js"></script>
  <script src="/js/markerclusterer.js">
  </script>
  <script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwrnsJ4FHLRLfZjdQLzZpvuKlToCybm-0&callback=initMap">
  </script>
</body>
