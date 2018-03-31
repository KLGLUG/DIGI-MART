

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
  


 $json    =  file_get_contents("php://input");
 $obj   =  json_decode($json);
var_dump($obj);
 //echo json_decode($json);
 

$key='create';

 switch($key)
   {

      // Add a new record to the technologies table
      case "create":

 $EMAILS		     =    filter_var($obj->EMAILS, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);


   // Attempt to query database table and retrieve dat
   try {
 //$EMAILS		     =    filter_var($obj->EMAILS, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
     
      $sql 	= "SELECT EMAIL FROM itemregister WHERE emailf= '$EMAILS'";
   
//EMAIL, weighta,piecesa,costa,weightb,piecesb,costb,weightc,piecesc,costc,weightd,piecesd,costd,weighte,piecese,coste,weightf,piecesf,costf
           $stmt 	= $pdo->prepare($sql);
           
            $stmt->execute();


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
}

?>
