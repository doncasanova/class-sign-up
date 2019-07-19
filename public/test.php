<?php
 session_start();
    require "../config.php";
    require "../common.php";
	$user = $_SESSION['stundentid'];
	$class = $_GET['id'];

//----------------------------------------------------------------------------
//check for student
try {
	
$connection = new PDO($dsn, $username, $password, $options);

     $sql = "SELECT *
    FROM students
    WHERE completed = 0
	AND classid = $class 
	AND userid = $user";

    $completed = $_POST['completed'];
	
    $statement = $connection->prepare($sql);
    $statement->bindParam(':completed', $location, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
	$rows = mysqli_num_rows($result);
		if($rows<0){
			
				// Redirect user to index.php
			header("Location: lathe-classes.php");
			$connection = null;
			}
			
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }







 //---------------------------------------------------------------------------
 // add student
 if (isset($_GET['id'])) {


  try {
    
    
	
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

$connection = null;

}

?>

