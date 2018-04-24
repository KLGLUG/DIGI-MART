

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
 
   $pdo 	= new PDO($dsn, $un, $pwd, $opt);
   $data    = array();
   $datak=array();
  


 $json    =  file_get_contents("php://input");
 $obj   =  json_decode($json);
 $key     =  strip_tags($obj->key);
switch($key)
   {
      case "create":

 $EMAIL		     =    filter_var($obj->piece, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);


   try {
     
    
          $stmt1= $pdo->query("INSERT INTO productpurchase(SELECT EMAIL,emailf FROM itemregister WHERE emailf IN (SELECT NAME FROM register WHERE LATITUDE BETWEEN (select minlat FROM locate WHERE sno IN (SELECT MAX(sno) FROM locate)) AND (select maxlat FROM locate WHERE sno IN (SELECT MAX(sno) FROM locate)) AND LONGITUDE BETWEEN (select minlon FROM locate WHERE sno IN (SELECT MAX(sno) FROM locate)) AND (select maxlon FROM locate WHERE sno IN (SELECT MAX(sno) FROM locate)) ))"); 

   $stmt 	= $pdo->query("SELECT itemname FROM productpurchase WHERE itemname= '$EMAIL'");

 if ($row  = $stmt->fetch(PDO::FETCH_OBJ))
   {
         
       // $stmt2=$pdo->query("INSERT INTO productbuying(item) SELECT EMAIL FROM itemregister WHERE EMAIL= '$EMAIL' AND emailf IN (SELECT mailid FROM productpurchase) "); 
     
         //$stmt3=$pdo->query("INSERT INTO productbuying(shopname) SELECT SHOPNAME FROM register WHERE NAME IN (select mailid FROM productpurchase) "); 
 

       $stmt3=$pdo->query(" INSERT INTO productbuying(item,shopname) SELECT EMAIL,SHOPNAME from itemregister,register WHERE EMAIL='$EMAIL' AND emailf in(select mailid from productpurchase) AND NAME in(select mailid from productpurchase)");

    $stmt4=$pdo->query("TRUNCATE TABLE productpurchase");
     $stmt5=$pdo->query("TRUNCATE TABLE locate");
   }

    else
   {
      
        echo json_encode($data);

    }


     
   }
   catch(PDOException $e)
   {
      echo $e->getMessage();
   }
}

?>
