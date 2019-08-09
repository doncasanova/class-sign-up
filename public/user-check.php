<?php
 session_start();
    require "../config.php";
    require "../common.php";

	$user = $_SESSION['stundentid'];
	$_SESSION['class'] = $_GET['id'];
	$class = $_GET['id'];
	$_SESSION['total'] = $_GET['total'];
	// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, firstname, lastname FROM students
WHERE classid = $class";
$result = $conn->query($sql);

if ($result->num_rows > 0) {



    // output data of each row
    while($row = $result->fetch_assoc()) {
        $_SESSION['class'] = $class;
		$firstname = $_SESSION['firstname'];
		$_SESSION['all-ready-signed-up'] = "Wow $firstname! We love your enthusiasm but it looks like your already signed up.";
		header("Location: student-sign-up.php");
					$connection = null;
    }
}elseif($result->num_rows == 0){ 
	$user = $_SESSION['stundentid'];
	$_SESSION['class'] = $_GET['id'];
	$class = $_GET['id'];
	$_SESSION['total'] = $_GET['total'];
header("Location: add-new-student.php");
			
}else {

    echo "0 results";
}
$conn->close();
	


?>