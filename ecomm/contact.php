<html>
  <head>
    <title>HBRD</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  
        
    <?php
  include 'header.php';
  
  ?>
  </head>
  <body>
    <div id="map_canvas" style="margin-left: 40px; margin-top: 80px; width: 500px; height:400px">
      <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script>
      function initialize() {
        var map_canvas = document.getElementById('map_canvas');
        var map_options = {
          center: new google.maps.LatLng(19.0394463, 72.8598981),
          zoom: 17,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(map_canvas, map_options);
        var marker = new google.maps.Marker({
      position: new google.maps.LatLng(19.0393686, 72.8599712),
      animation: google.maps.Animation.DROP,
      map: map,
      title: 'Hello !'
        });
       google.maps.event.addListener(marker, 'click', toggleBounce);
       function toggleBounce() {

        if (marker.getAnimation() != null) {
        marker.setAnimation(null);
        } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    </div>
  </body>
</html>