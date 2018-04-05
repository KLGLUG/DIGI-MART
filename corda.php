<?php
    header('Access-Control-Allow-Origin:*');
   // Define database connection parameters
   $hn      = 'localhost';
   $un      = 'root';
   $pwd     = '';
   $db      = 'digimart';
   $cs      = 'utf8';

   // Set up the PDO parameters
   $dsn 	= "mysql:host=" . $hn . ";port=3306;dbname=" . $db . ";charset=" . $cs;
   $opt 	= array(
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                       );
   // Create a PDO instance (connect to the database)
   $pdo 	= new PDO($dsn, $un, $pwd, $opt);
   $data    = array();


   //$json    =  file_get_contents('php://input');
   //$obj     =  json_decode($json);


   //$latitudes=filter_var($obj->latitudes, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
     //$latitudes='16.3018';
    //$longitudes=filter_var($obj->longitudes, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
//$longitudes='80.4335';
   //$rad = 1; // radius of bounding circle in kilometers

    //$R = 6371;  // earth's mean radius, km

    // first-cut bounding box (in degrees)
    //$maxLat = $latitudes + rad2deg($rad/$R);
    //$minLat = $latitudes - rad2deg($rad/$R);
    //$maxLon = $longitudes + rad2deg(asin($rad/$R) / cos(deg2rad($latitudes)));
    //$minLon = $longitudes- rad2deg(asin($rad/$R) / cos(deg2rad($latitudes)));

   try {
     // $stmt 	= $pdo->query('SELECT item FROM searchbar WHERE email IN (SELECT NAME FROM register WHERE LATITUDE BETWEEN :minLat AND :maxLat AND LONGITUDE BETWEEN :minLon AND :maxLon  )');
 $stmt 	= $pdo->query('SELECT item FROM searchbar WHERE email IN (SELECT NAME FROM register WHERE LATITUDE BETWEEN (select minlat FROM locate WHERE sno IN (SELECT MAX(sno) FROM locate)) AND (select maxlat FROM locate WHERE sno IN (SELECT MAX(sno) FROM locate)) AND LONGITUDE BETWEEN (select minlon FROM locate WHERE sno IN (SELECT MAX(sno) FROM locate)) AND (select maxlon FROM locate WHERE sno IN (SELECT MAX(sno) FROM locate)) )');
//      $stmt 	= $pdo->prepare($sql);
  //    $stmt->bindParam(':minLat', $minLat);
    //  $stmt->bindParam(':maxLat', $maxLat);
      //$stmt->bindParam(':minLon', $minLon);
      //$stmt->bindParam(':maxLon', $maxLon);
      //$stmt->execute();


      while($row  = $stmt->fetch(PDO::FETCH_OBJ))
      {
         // Assign each row of data to associative array
         $data[] = $row;
      }

      // Return data as JSON
      echo json_encode($data);
   }
   catch(PDOException $e)
   {
      echo $e->getMessage();
   }


?>
