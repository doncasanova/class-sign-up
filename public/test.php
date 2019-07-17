<?php
 session_start();
    require "../config.php";
    require "../common.php";


 
 if (isset($_GET['size'])) {
 
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $new_student = array(
      "firstname" => $_SESSION['firstname'],
      "lastname"  => $_SESSION['lastname'],
      "email"     => $_SESSION['email'],
	  "company"   => $_SESSION['company'],
	  "classid"	  => $_GET['id'],
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

try {
  $test = 1;
  $test2 = $_GET['size'];
    // set the PDO error mode to exception
    // $connection = new PDO($dsn, $username, $password, $options);

     $sql = "UPDATE classes SET classsize= $test2 WHERE id=$test ";
	
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

$connection = null;

}

?>

