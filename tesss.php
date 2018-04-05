
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


   // Retrieve the posted data
   $json    =  file_get_contents('php://input');
   $obj     =  json_decode($json);
   $key     =  strip_tags($obj->key);


   // Determine which mode is being requested
   switch($key)
   {

      // Add a new record to the technologies table
      case "create":

         // Sanitise URL supplied values
         $rad = 1; // radius of bounding circle in kilometers

    $R = 6371;
        
         $latitude=filter_var($obj->latitude, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
          $longitude=filter_var($obj->longitude, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
           $maxLat = $latitude + rad2deg($rad/$R);
           $minLat = $latitude - rad2deg($rad/$R);
           $maxLon = $longitude + rad2deg(asin($rad/$R) / cos(deg2rad($latitude)));
           $minLon = $longitude - rad2deg(asin($rad/$R) / cos(deg2rad($latitude)));


         // Attempt to run PDO prepared statement
         try {
            $sql 	= "INSERT INTO locate(maxlat,minlat,maxlon,minlon) VALUES(:LATITUDE,:LONGITUDE,:maxlon,:minlon)";
            $stmt 	= $pdo->prepare($sql);
        
           
            $stmt->bindParam(':LATITUDE', $maxLat);
            $stmt->bindParam(':LONGITUDE', $minLat);
            $stmt->bindParam(':maxlon', $maxLon);
            $stmt->bindParam(':minlon', $minLon);
            $stmt->execute();

            echo json_encode(array('message' => 'Congratulations the record  was added to the database'));
         }
         // Catch any errors in running the prepared statement
         catch(PDOException $e)
         {
            echo $e->getMessage();
         }

      break;



      // Update an existing record in the technologies table
      case "update":
         $NAME 		     = filter_var($obj->NAME, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $MOBILE	  = filter_var($obj->MOBILE, FILTER_SANITIZE_NUMBER_INT);
          $PASSWORD    = filter_var($obj->PASSWORD, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $SHOPNAME	  = filter_var($obj->SHOPNAME, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
          $CATEGORY		     = filter_var($obj->CATEGORY, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $LOCATION	  = filter_var($obj->LOCATION, FILTER_SANITIZE_NUMBER_INT);

         
         $recordID	     = filter_var($obj->recordID, FILTER_SANITIZE_NUMBER_INT);

         // Attempt to run PDO prepared statement
         try {
            $sql 	= "UPDATE register SET NAME = :NAME, MOBILE = :MOBILE,PASSWORD=:PASSWORD,SHOPNAME=:SHOPNAME,CATEGORY=:CATEGORY,LOCATION=:LOCATION WHERE sno = :recordID";
            $stmt 	=	$pdo->prepare($sql);
             $stmt->bindParam(':NAME', $NAME, PDO::PARAM_STR);
            $stmt->bindParam(':MOBILE', $MOBILE, PDO::PARAM_INT);
            $stmt->bindParam(':PASSWORD', $PASSWORD, PDO::PARAM_STR);
            $stmt->bindParam(':SHOPNAME', $SHOPNAME, PDO::PARAM_STR);
            $stmt->bindParam(':CATEGORY', $CATEGORY, PDO::PARAM_STR);
            $stmt->bindParam(':LOCATION', $LOCATION, PDO::PARAM_INT); 
            $stmt->bindParam(':recordID', $recordID, PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode('Congratulations the record ' . $NAME . ' was updated');
         }
         // Catch any errors in running the prepared statement
         catch(PDOException $e)
         {
            echo $e->getMessage();
         }

      break;



      // Remove an existing record in the technologies table
      case "delete":

         // Sanitise supplied record ID for matching to table record
         $recordID	=	filter_var($obj->recordID, FILTER_SANITIZE_NUMBER_INT);

         // Attempt to run PDO prepared statement
         try {
            $pdo 	= new PDO($dsn, $un, $pwd);
            $sql 	= "DELETE FROM technologies WHERE id = :recordID";
            $stmt 	= $pdo->prepare($sql);
            $stmt->bindParam(':recordID', $recordID, PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode('Congratulations the record ' . $NAME . ' was removed');
         }
         // Catch any errors in running the prepared statement
         catch(PDOException $e)
         {
            echo $e->getMessage();
         }

      break;
   }

?>
