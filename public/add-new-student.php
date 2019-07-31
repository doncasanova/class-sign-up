<?php
 session_start();
    require "../config.php";
    require "../common.php";
	$user = $_SESSION['stundentid'];
	$class = $_SESSION['class'];
	
 //---------------------------------------------------------------------------
 // add student
 
  try {
    
    $connection = new PDO($dsn, $username, $password, $options);
	
    $new_student = array(
      "firstname" => $_SESSION['firstname'],
      "lastname"  => $_SESSION['lastname'],
      "email"     => $_SESSION['email'],
	  "company"   => $_SESSION['company'],
	  "classid"	  => $_SESSION['class'],
	  "userid"    => $_SESSION['stundentid'],
	  "completed" => 0
    );
    $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"students", 
implode(", ", array_keys($new_student)),
":" . implode(", :", array_keys($new_student))
    );
    $statement = $connection->prepare($sql);
    $statement->execute($new_student);
	
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  
  }
//--------------------------------------------------------------
//update seats left in class
	 try {	
		$remaining =  $_SESSION['total'] - 1;
     $sql = "UPDATE classes SET classsize= $remaining WHERE id=$class ";
	
    // Prepare statement
    $stmt = $connection->prepare($sql);
    // execute the query
    $stmt->execute();
    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED successfully";
	header("Location: thank-you.php");
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	

?>
