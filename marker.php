<?php
    $user = 'root';
    $password = '';
    $database = 'markers';
    $servername='localhost:3306';
    $mysqli = new mysqli($servername, $user, $password, $database);

    $title = $_POST['mtitle'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];

    if (!$mysqli){
      echo "no Connection";
    }

    $results = array();

    $q = "INSERT INTO markers(lat, lng, description) VALUES($lat, $lng, '$title')";
    if(!$mysqli->query($q)){
        echo "sad". $q . "<br>" . $mysqli->error;
    }
    else{
        echo 'nice';
    }

    $mysqli->close();
  ?>