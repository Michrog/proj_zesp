<?php
    $user = 'root';
    $password = '';
    $database = 'markers';
    $servername='localhost:3306';
    $mysqli = new mysqli($servername, $user, $password, $database);
    if (!$mysqli){
      echo "no Connection";
    }

    $results = array();

    $q = "SELECT * FROM markers";
    if($res = $mysqli->query($q)){
      while($row = $res->fetch_assoc()){
        $r = array("lat" => $row['lat'], "lng" => $row['lng']);
        array_push($results, $row);
      }
      $R = json_encode($results, JSON_FORCE_OBJECT);
    }
    else{
        echo 'sad';
    }

    $mysqli->close();
  ?>