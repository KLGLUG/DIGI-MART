
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
         $EMAIL 		     = filter_var($obj->EMAIL, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $weighta	  = filter_var($obj->weighta, FILTER_SANITIZE_NUMBER_INT);
          $piecesa    = filter_var($obj->piecesa,FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
          $costa    = filter_var($obj->costa,FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
         $weightb	  = filter_var($obj->weightb,FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
          $piecesb		     = filter_var($obj->piecesb, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
         $costb	  = filter_var($obj->costb, FILTER_SANITIZE_NUMBER_INT);
         $weightc    = filter_var($obj->weightc,FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
         $piecesc	  = filter_var($obj->piecesc, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
          $costc		     = filter_var($obj->costc, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
         $weightd	  = filter_var($obj->weightd, FILTER_SANITIZE_NUMBER_INT);
        $piecesd	  = filter_var($obj->piecesd, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
          $costd		     = filter_var($obj->costd,FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
        $weighte  = filter_var($obj->weighte, FILTER_SANITIZE_NUMBER_INT);
        $piecese	  = filter_var($obj->piecese, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
          $coste		     = filter_var($obj->coste, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
         $weightf  = filter_var($obj->weightf, FILTER_SANITIZE_NUMBER_INT);
        $piecesf	  = filter_var($obj->piecesf,FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
          $costf		     = filter_var($obj->costf, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
         $emailf		     = filter_var($obj->emailf, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);



         // Attempt to run PDO prepared statement
         try {
            $sql 	= "INSERT INTO itemregister(EMAIL,weighta,piecesa,costa,weightb,piecesb,costb,weightc,piecesc,costc,weightd,piecesd,costd,weighte,piecese,coste,weightf,piecesf,costf,emailf) VALUES(:EMAIL,:weighta,:piecesa,:costa,:weightb,:piecesb,:costb,:weightc,:piecesc,:costc,:weightd,:piecesd,:costd,:weighte,:piecese,:coste,:weightf,:piecesf,:costf,:emailf )";
            $stmt 	= $pdo->prepare($sql);
            $stmt->bindParam(':EMAIL', $EMAIL, PDO::PARAM_STR);
            $stmt->bindParam(':weighta', $weighta, PDO::PARAM_INT);
            $stmt->bindParam(':piecesa', $piecesa, PDO::PARAM_INT);
            $stmt->bindParam(':costa', $costa, PDO::PARAM_INT);
            $stmt->bindParam(':weightb', $weightb, PDO::PARAM_INT);
            $stmt->bindParam(':piecesb', $piecesb, PDO::PARAM_INT);
            $stmt->bindParam(':costb', $costb, PDO::PARAM_INT);
            $stmt->bindParam(':weightc', $weightc, PDO::PARAM_INT);
            $stmt->bindParam(':piecesc', $piecesc, PDO::PARAM_INT);
            $stmt->bindParam(':costc', $costc, PDO::PARAM_INT);
            $stmt->bindParam(':weightd', $weightd, PDO::PARAM_INT);
            $stmt->bindParam(':piecesd', $piecesd, PDO::PARAM_INT);
            $stmt->bindParam(':costd', $costd, PDO::PARAM_INT);
            $stmt->bindParam(':weighte', $weighte, PDO::PARAM_INT);
            $stmt->bindParam(':piecese', $piecese, PDO::PARAM_INT);
            $stmt->bindParam(':coste', $coste, PDO::PARAM_INT);
            $stmt->bindParam(':weightf', $weightf, PDO::PARAM_INT);
            $stmt->bindParam(':piecesf', $piecesf, PDO::PARAM_INT);
            $stmt->bindParam(':costf', $costf, PDO::PARAM_INT);
            $stmt->bindParam(':emailf', $emailf, PDO::PARAM_STR);
            $stmt->execute();

            echo json_encode(array('message' => 'Congratulations the record ' . $weighta . ' was added to the database'));
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
