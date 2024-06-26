<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OpenWeather Forecast</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital@1&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./main.css">
  <script src="./script.js" defer></script>
  <script src="./jquery-3.6.0.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
</head>

<body>
  <div class="vcontainer">  <div class="container">
    <div class="card">
      <div class="search">
        <input type="text" class="search-bar" placeholder="Search">
        <button name="button1"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1.5em"
            width="1.5em" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M909.6 854.5L649.9 594.8C690.2 542.7 712 479 712 412c0-80.2-31.3-155.4-87.9-212.1-56.6-56.7-132-87.9-212.1-87.9s-155.5 31.3-212.1 87.9C143.2 256.5 112 331.8 112 412c0 80.1 31.3 155.5 87.9 212.1C256.5 680.8 331.8 712 412 712c67 0 130.6-21.8 182.7-62l259.7 259.6a8.2 8.2 0 0 0 11.6 0l43.6-43.5a8.2 8.2 0 0 0 0-11.6zM570.4 570.4C528 612.7 471.8 636 412 636s-116-23.3-158.4-65.6C211.3 528 188 471.8 188 412s23.3-116.1 65.6-158.4C296 211.3 352.2 188 412 188s116.1 23.2 158.4 65.6S636 352.2 636 412s-23.3 116.1-65.6 158.4z">
            </path>
          </svg></button>
          
      </div>
      <div class="weather.loading">
        <h1 class="city">Awaiting input</h1>
        <h2 class="temp">Temperature</h2>
        <div class="flex">
          <img src="https://openweathermap.org/img/wn/04n.png" alt="" class="icon" />
          <div class="description">Description</div>
        </div>
        <div class="humidity">Humidity</div>
        <div class="pressure">Pressure</div>
        <div class="wind">Wind speed</div>
      </div>
    </div>
    <div class="card">
      <div class="toggle">
        <spanp>Put markers: </span>
        <input type="checkbox" id="toggle"/>
      </div>
      <div id="map"></div>
  
      <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMjPyP65G3XZd6g-kUGF2iAGpZNJSu_g0&callback=initMap&v=weekly"
      defer
      ></script>
    </div>
  </div>
  <div class="container" id="fcont">
    <div class="card marker-form">
      <form method="post" action="marker.php" target="dummy">
          Latitude: <input type="number" name="lat" id="lat" step="any">
          Longitude: <input type="number" name="lng" id="lng" step="any">
          Description: <input type="text" name="mtitle" id="mtitle" placeholder="Marker description">
        <div style="text-align:center">
          <input type="submit" value="Send" id="submitbtn" style="padding:1em;margin-top:1.5em">
        </div>
      </form>
  </div>
</div>
</div>
<?php 
  require_once 'database.php';
?>
<script type="text/javascript">
  let markers = <?php echo $R; ?>;
</script>
<iframe name="dummy" id="dummy" style="display:none"></iframe>
</body>
</html>